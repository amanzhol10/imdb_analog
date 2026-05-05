<x-app-layout>
    <div class="py-8 max-w-5xl mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">{{ __('messages.search_results') }} "{{ $q }}"</h1>

        @if($movies->count())
        <h2 class="text-xl font-semibold mb-3 dark:text-white">🎬 {{ __('messages.movies_section') }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            @foreach($movies as $movie)
            <a href="{{ route('movies.show', $movie) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-3 hover:shadow-lg transition">
                <p class="font-semibold text-gray-800 dark:text-white text-sm">{{ $movie->title }}</p>
                <p class="text-xs text-gray-500">{{ $movie->year }}</p>
            </a>
            @endforeach
        </div>
        @endif

        @if($series->count())
        <h2 class="text-xl font-semibold mb-3 dark:text-white">📺 {{ __('messages.tv_series') }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($series as $s)
            <a href="{{ route('tv-series.show', $s) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-3 hover:shadow-lg transition">
                <p class="font-semibold text-gray-800 dark:text-white text-sm">{{ $s->title }}</p>
                <p class="text-xs text-gray-500">{{ $s->year }} • {{ $s->seasons }} {{ __('messages.seasons') }}</p>
            </a>
            @endforeach
        </div>
        @endif

        @if(!$movies->count() && !$series->count())
            <p class="text-gray-500">{{ __('messages.nothing_found') }} "{{ $q }}".</p>
        @endif
    </div>
</x-app-layout>