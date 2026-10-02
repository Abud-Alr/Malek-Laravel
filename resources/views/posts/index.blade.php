<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Laravel From Scratch</span> News
        </h1>

        <h2 class="inline-flex mt-2">By Lary Laracore <img src="/images/lary-head.svg"
                                                            alt="Head of Lary the mascot"></h2>

        <p class="text-sm mt-14">
            Another year. Another update. We're refreshing the popular Laravel series with new content.
            I'm going to keep you guys up to speed with what's going on!
        </p>

        <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8 flex flex-col lg:flex-row items-center justify-center">
            <!-- Dynamische Categorie Dropdown via Blade OOP Component -->
            <x-category-dropdown :currentCategory="$currentCategory" />

            <!-- Zoeken via Database Query -->
            <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
                <form method="GET" action="/">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text"
                           name="search"
                           placeholder="Find something"
                           value="{{ request('search') }}"
                           class="bg-transparent placeholder-black font-semibold text-sm focus:outline-none">
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count() > 0)
            <!-- Featured Post Component -->
            <x-post-featured-card :post="$posts->first()" />

            <!-- Post Grid Components -->
            @if($posts->count() > 1)
                <div class="lg:grid lg:grid-cols-6 gap-6">
                    @foreach($posts->skip(1)->take(2) as $post)
                        <x-post-card :post="$post" class="col-span-3" />
                    @endforeach
                </div>
            @endif

            @if($posts->count() > 3)
                <div class="lg:grid lg:grid-cols-6 gap-6">
                    @foreach($posts->skip(3) as $post)
                        <x-post-card :post="$post" class="col-span-2" />
                    @endforeach
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No posts yet. Please check back later or try another search.</p>
                <a href="/" class="mt-4 inline-block bg-blue-500 text-white text-xs font-semibold py-2 px-6 rounded-full">
                    View All Posts
                </a>
            </div>
        @endif
    </main>
</x-layout>
