<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

/**
 * Class Post
 *
 * OOP Eloquent Model for blog posts.
 * Represents a single blog post with relations to Author and Category.
 * Implements intelligent query caching using MySQL database cache.
 */
class Post extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'author_id',
        'category_id',
        'slug',
        'title',
        'excerpt',
        'body',
        'image',
        'published_at',
    ];

    /**
     * Attribute type casting.
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Relationship: An author writes the post.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Relationship: The post belongs to a category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope: Filter only published posts.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * Scope: Filter posts by category slug.
     */
    public function scopeByCategory(Builder $query, string $categorySlug): Builder
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Scope: Search posts by title or body.
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    /**
     * Get all published posts with caching.
     * Caches matching IDs to optimize query execution and avoid serialization issues.
     */
    public static function getAllCached(?string $search = null, ?string $category = null): Collection
    {
        $cacheKey = 'posts.query_ids.' . md5($search . '|' . $category);

        $postIds = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($search, $category) {
            return static::published()
                ->search($search)
                ->when($category, fn($q) => $q->byCategory($category))
                ->latest('published_at')
                ->pluck('id')
                ->all();
        });

        if (empty($postIds)) {
            return new Collection();
        }

        // Return eager-loaded models ordered by the cached ID sequence
        $orderedIds = implode(',', $postIds);

        return static::with(['author', 'category'])
            ->whereIn('id', $postIds)
            ->orderByRaw("FIELD(id, {$orderedIds})")
            ->get();
    }

    /**
     * Find a published post by slug with caching.
     */
    public static function findBySlugCached(string $slug): self
    {
        $postId = Cache::remember("posts.slug_id.{$slug}", now()->addHours(24), function () use ($slug) {
            return static::published()
                ->where('slug', $slug)
                ->value('id');
        });

        if (! $postId) {
            abort(404);
        }

        return static::with(['author', 'category'])->findOrFail($postId);
    }

    /**
     * Clear post and category cache tags/keys.
     */
    public static function clearCache(): void
    {
        Cache::flush();
    }

    /**
     * Model boot events: Automatically invalidate cache on mutations.
     */
    protected static function booted(): void
    {
        static::created(fn() => static::clearCache());
        static::updated(fn() => static::clearCache());
        static::deleted(fn() => static::clearCache());
    }
}
