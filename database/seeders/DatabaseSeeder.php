<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Auteurs aanmaken
        $lary = Author::firstOrCreate(
            ['slug' => 'lary-laracore'],
            [
                'name' => 'Lary Laracore',
                'bio' => 'Mascot at Laracasts and passionate Laravel developer.',
                'image' => 'lary-avatar.svg',
            ]
        );

        $john = Author::firstOrCreate(
            ['slug' => 'john-doe'],
            [
                'name' => 'John Doe',
                'bio' => 'Fullstack engineer & open-source enthusiast.',
                'image' => 'lary-avatar.svg',
            ]
        );

        // 2. Categorieën aanmaken
        $techniques = Category::firstOrCreate(
            ['slug' => 'techniques'],
            ['name' => 'Techniques', 'color' => 'blue-300']
        );

        $updates = Category::firstOrCreate(
            ['slug' => 'updates'],
            ['name' => 'Updates', 'color' => 'red-300']
        );

        $personal = Category::firstOrCreate(
            ['slug' => 'personal'],
            ['name' => 'Personal', 'color' => 'green-300']
        );

        $business = Category::firstOrCreate(
            ['slug' => 'business'],
            ['name' => 'Business', 'color' => 'yellow-300']
        );

        // 3. Blog posts aanmaken met rijke content
        $postsData = [
            [
                'author_id' => $lary->id,
                'category_id' => $techniques->id,
                'slug' => 'this-is-a-big-title',
                'title' => 'This is a big title and it will look great on two or even three lines. Wooohoo!',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                           <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                           <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>
                           <h2 class="font-bold text-lg">Sed quia consequuntur</h2>
                           <p>Magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                           <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>',
                'image' => 'illustration-1.png',
                'published_at' => now()->subDay(),
            ],
            [
                'author_id' => $lary->id,
                'category_id' => $updates->id,
                'slug' => 'working-with-eloquent',
                'title' => 'Working with Eloquent models is a breeze. Let me show you how!',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                           <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                           <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>',
                'image' => 'illustration-1.png',
                'published_at' => now()->subDays(2),
            ],
            [
                'author_id' => $john->id,
                'category_id' => $techniques->id,
                'slug' => 'blade-templating-101',
                'title' => 'Blade Templating 101: Everything you need to know about Blade',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                           <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                           <h2 class="font-bold text-lg">Getting started with Blade</h2>
                           <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>',
                'image' => 'illustration-2.png',
                'published_at' => now()->subDays(3),
            ],
            [
                'author_id' => $lary->id,
                'category_id' => $business->id,
                'slug' => 'routing-and-controllers',
                'title' => 'Routing and Controllers: The backbone of every Laravel app',
                'excerpt' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                           <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                           <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
                'image' => 'illustration-3.png',
                'published_at' => now()->subDays(4),
            ],
            [
                'author_id' => $john->id,
                'category_id' => $personal->id,
                'slug' => 'middleware-in-depth',
                'title' => 'Middleware in Depth: Protecting your routes like a pro',
                'excerpt' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                           <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                           <h2 class="font-bold text-lg">Why middleware matters</h2>
                           <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>',
                'image' => 'illustration-4.png',
                'published_at' => now()->subDays(5),
            ],
            [
                'author_id' => $lary->id,
                'category_id' => $updates->id,
                'slug' => 'database-migrations',
                'title' => 'Database Migrations: Version control for your database schema',
                'excerpt' => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.',
                'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                           <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                           <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>',
                'image' => 'illustration-5.png',
                'published_at' => now()->subDays(6),
            ],
        ];

        foreach ($postsData as $data) {
            Post::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
