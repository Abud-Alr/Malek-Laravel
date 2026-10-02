<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Factory for generating Post test data.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(8);

        return [
            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
            'slug' => Str::slug($title),
            'title' => $title,
            'excerpt' => fake()->paragraph(2),
            'body' => '<p>' . implode('</p><p>', fake()->paragraphs(5)) . '</p>',
            'image' => 'illustration-' . fake()->numberBetween(1, 5) . '.png',
            'published_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * State: unpublished post (draft).
     */
    public function unpublished(): static
    {
        return $this->state(fn(array $attributes) => [
            'published_at' => null,
        ]);
    }
}
