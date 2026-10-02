<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represents a blog post author.
 *
 * Each author can have multiple posts.
 * Uses slug for clean URL identification.
 */
class Author extends Model
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
        'bio',
        'image',
    ];

    /**
     * Get all posts written by this author.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
