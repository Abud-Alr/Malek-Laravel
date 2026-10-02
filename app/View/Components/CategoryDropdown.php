<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

/**
 * Class CategoryDropdown
 *
 * OOP Blade component for rendering the category filter dropdown.
 * Retrieves category IDs with caching and hydrates fresh models.
 */
class CategoryDropdown extends Component
{
    /**
     * All available categories from the database.
     */
    public Collection $categories;

    /**
     * Currently active category slug (if any).
     */
    public ?string $currentCategory;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $currentCategory = null)
    {
        $this->currentCategory = $currentCategory;

        $categoryIds = Cache::remember('categories.all_ids', now()->addHours(24), function () {
            return Category::pluck('id')->all();
        });

        $this->categories = Category::whereIn('id', $categoryIds)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-dropdown');
    }
}
