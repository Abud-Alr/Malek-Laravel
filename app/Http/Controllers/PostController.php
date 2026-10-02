<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Handles all blog post related HTTP requests.
 *
 * Uses the Post model's caching methods for optimized database queries.
 * Supports filtering by category and searching by keyword.
 */
class PostController extends Controller
{
    /**
     * Display the homepage with all published blog posts.
     *
     * Supports optional filtering:
     * - ?search=keyword  → search in title/body
     * - ?category=slug   → filter by category
     */
    public function index(Request $request): View
    {
        $posts = Post::getAllCached(
            search: $request->query('search'),
            category: $request->query('category'),
        );

        $categories = Category::all();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'currentCategory' => $request->query('category'),
        ]);
    }

    /**
     * Display a single blog post by its slug.
     *
     * Uses cached query to avoid repeated database hits for the same post.
     */
    public function show(string $slug): View
    {
        $post = Post::findBySlugCached($slug);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
