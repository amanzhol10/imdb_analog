<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">🎬 {{ __('messages.all_movies') }}</h1>
            @can('create movies')
                <a href="{{ route('movies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded">
                    {{ __('messages.add_movie') }}
                </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($movies as $movie)
            <a href="{{ route('movies.show', $movie) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition overflow-hidden group">
                @if($movie->poster_path)
                    <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="{{ $movie->title }}" class="w-full h-56 object-cover group-hover:scale-105 transition">
                @else
                    <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-5xl">🎬</div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 dark:text-white truncate">{{ $movie->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $movie->director }} · {{ $movie->year }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-yellow-500 text-sm">⭐ {{ number_format($movie->reviews_avg_rating ?? 0, 1) }}</span>
                        <span class="text-xs text-gray-400">{{ $movie->reviews_count ?? 0 }} {{ __('messages.reviews') }}</span>
                    </div>
                </div>
            </a>
            @empty
            <p class="col-span-4 text-gray-500">{{ __('messages.no_movies') }}</p>
            @endforelse
        </div>

        <div class="mt-6">{{ $movies->links() }}</div>
    </div>
</x-app-layout>