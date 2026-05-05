<x-app-layout>
    <div class="py-8 max-w-4xl mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 flex gap-8 mb-8">
            <div>
                @if($actor->photo_path)
                    <img src="{{ Storage::url($actor->photo_path) }}" class="w-40 h-40 rounded-full object-cover">
                @else
                    <div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center text-5xl">👤</div>
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold dark:text-white mb-2">{{ $actor->name }}</h1>
                @if($actor->birth_date)
                    <p class="text-gray-500 text-sm mb-2">🎂 {{ $actor->birth_date->format('d M Y') }}</p>
                @endif
                @if($actor->bio)
                    <p class="text-gray-600 dark:text-gray-300">{{ $actor->bio }}</p>
                @endif
            </div>
        </div>

        @if($actor->movies->count())
        <h2 class="text-xl font-bold dark:text-white mb-4">🎬 {{ __('messages.filmography') }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            @foreach($actor->movies as $movie)
            <a href="{{ route('movies.show', $movie) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-3 hover:shadow-md transition">
                <p class="font-semibold text-gray-800 dark:text-white text-sm truncate">{{ $movie->title }}</p>
                <p class="text-xs text-gray-400">{{ $movie->year }}</p>
                @if($movie->pivot->character)<p class="text-xs text-indigo-500 italic">as {{ $movie->pivot->character }}</p>@endif
            </a>
            @endforeach
        </div>
        @endif

        @if($actor->tvSeries->count())
        <h2 class="text-xl font-bold dark:text-white mb-4">📺 {{ __('messages.tv_series') }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($actor->tvSeries as $series)
            <a href="{{ route('tv-series.show', $series) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-3 hover:shadow-md transition">
                <p class="font-semibold text-gray-800 dark:text-white text-sm truncate">{{ $series->title }}</p>
                <p class="text-xs text-gray-400">{{ $series->year }}</p>
                @if($series->pivot->character)<p class="text-xs text-indigo-500 italic">as {{ $series->pivot->character }}</p>@endif
            </a>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>