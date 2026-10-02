<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class PostCard
 *
 * OOP Blade component for rendering standard post cards in the grid.
 */
class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Post $post
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-card');
    }
}
