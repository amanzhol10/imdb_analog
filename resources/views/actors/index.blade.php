<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">🎭 {{ __('messages.actors') }}</h1>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-5">
            @forelse($actors as $actor)
            <a href="{{ route('actors.show', $actor) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-md transition p-4 text-center">
                @if($actor->photo_path)
                    <img src="{{ Storage::url($actor->photo_path) }}" class="w-20 h-20 rounded-full mx-auto object-cover mb-3">
                @else
                    <div class="w-20 h-20 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-3xl mx-auto mb-3">👤</div>
                @endif
                <p class="font-semibold text-gray-800 dark:text-white text-sm">{{ $actor->name }}</p>
                <p class="text-xs text-gray-400">{{ $actor->movies_count + $actor->tv_series_count }} {{ __('messages.titles') }}</p>
            </a>
            @empty
            <p class="col-span-5 text-gray-500">{{ __('messages.no_actors') }}</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $actors->links() }}</div>
    </div>
</x-app-layout>