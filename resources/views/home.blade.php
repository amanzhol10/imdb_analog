<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-gray-900 to-gray-700 rounded-2xl p-10 mb-10 text-white text-center">
            <h1 class="text-4xl font-bold mb-3">🎬 CineReview</h1>
            <p class="text-gray-300 mb-6">{{ __('messages.discover') }}</p>
            <form action="{{ route('search') }}" method="GET" class="flex max-w-xl mx-auto">
                <input type="text" name="q" placeholder="{{ __('messages.search_placeholder') }}"
                    class="flex-1 rounded-l-lg px-4 py-3 text-gray-900 focus:outline-none text-base">
                <button class="bg-indigo-500 hover:bg-indigo-600 px-6 rounded-r-lg font-semibold">{{ __('messages.search_btn') }}</button>
            </form>
        </div>

        <section class="mb-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">⭐ {{ __('messages.top_rated_movies') }}</h2>
                <a href="{{ route('movies.index') }}" class="text-indigo-500 hover:underline text-sm">{{ __('messages.view_all') }}</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($topMovies as $movie)
                <a href="{{ route('movies.show', $movie) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition overflow-hidden group">
                    @if($movie->poster_path)
                        <img src="{{ Storage::url($movie->poster_path) }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
                    @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-4xl">🎬</div>
                    @endif
                    <div class="p-3">
                        <p class="font-semibold text-gray-800 dark:text-white text-sm truncate">{{ $movie->title }}</p>
                        <p class="text-xs text-gray-500">{{ $movie->year }} • ⭐ {{ number_format($movie->reviews_avg_rating ?? 0, 1) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        <section class="mb-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">🔥 {{ __('messages.popular_movies') }}</h2>
                <a href="{{ route('movies.index') }}" class="text-indigo-500 hover:underline text-sm">{{ __('messages.view_all') }}</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($popularMovies as $movie)
                <a href="{{ route('movies.show', $movie) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition overflow-hidden group">
                    @if($movie->poster_path)
                        <img src="{{ Storage::url($movie->poster_path) }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
                    @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-4xl">🎬</div>
                    @endif
                    <div class="p-3">
                        <p class="font-semibold text-gray-800 dark:text-white text-sm truncate">{{ $movie->title }}</p>
                        <p class="text-xs text-gray-500">{{ $movie->year }} • {{ $movie->reviews_count }} {{ __('messages.reviews_count') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        <section class="mb-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">⭐ {{ __('messages.top_rated_series') }}</h2>
                <a href="{{ route('tv-series.index') }}" class="text-indigo-500 hover:underline text-sm">{{ __('messages.view_all') }}</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($topSeries as $series)
                <a href="{{ route('tv-series.show', $series) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition overflow-hidden group">
                    @if($series->poster_path)
                        <img src="{{ Storage::url($series->poster_path) }}" class="w-full h-48 object-cover group-hover:scale-105 transition">
                    @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-4xl">📺</div>
                    @endif
                    <div class="p-3">
                        <p class="font-semibold text-gray-800 dark:text-white text-sm truncate">{{ $series->title }}</p>
                        <p class="text-xs text-gray-500">{{ $series->year }} • {{ $series->seasons }}s • ⭐ {{ number_format($series->reviews_avg_rating ?? 0, 1) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>