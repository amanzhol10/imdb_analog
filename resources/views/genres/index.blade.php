<x-app-layout>
    <div class="py-8 max-w-5xl mx-auto px-4">
        <h1 class="text-3xl font-bold dark:text-white mb-6">🎭 {{ __('messages.genres') }}</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @forelse($genres as $genre)
            <a href="{{ route('genres.show', $genre) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition p-6 group">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white group-hover:text-indigo-500">{{ $genre->name }}</h3>
                @if($genre->description)
                <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $genre->description }}</p>
                @endif
                <p class="text-xs text-gray-400 mt-3">{{ $genre->movies_count + $genre->tv_series_count }} {{ __('messages.titles') }}</p>
            </a>
            @empty
            <p class="col-span-3 text-gray-500">{{ __('messages.no_genres') }}</p>
            @endforelse
        </div>
    </div>
</x-app-layout>