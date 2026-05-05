<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">📺 {{ __('messages.tv_series') }}</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($series as $s)
            <a href="{{ route('tv-series.show', $s) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition overflow-hidden group">
                @if($s->poster_path)
                    <img src="{{ Storage::url($s->poster_path) }}" class="w-full h-56 object-cover group-hover:scale-105 transition">
                @else
                    <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-5xl">📺</div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 dark:text-white truncate">{{ $s->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $s->year }} • {{ $s->seasons }} {{ __('messages.season') }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-yellow-500 text-sm">⭐ {{ number_format($s->reviews_avg_rating ?? 0, 1) }}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $s->status === 'ongoing' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $s->status === 'ongoing' ? __('messages.status_ongoing') : __('messages.status_ended') }}
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <p class="col-span-4 text-gray-500">{{ __('messages.no_tv_series') }}</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $series->links() }}</div>
    </div>
</x-app-layout>