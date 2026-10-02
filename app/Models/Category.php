<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represents a blog post category (e.g. Techniques, Updates).
 *
 * Each category can contain multiple posts.
 * The color field maps to Tailwind CSS border/text color classes.
 */
class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    /**
     * Get all posts belonging to this category.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
