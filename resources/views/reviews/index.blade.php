<x-app-layout>
    <div class="py-8 max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold dark:text-white mb-6">💬 {{ __('messages.all_reviews') }}</h1>
        @forelse($reviews as $review)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <a href="{{ route('profile.show', $review->user) }}" class="font-semibold text-gray-800 dark:text-white hover:underline">{{ $review->user->name }}</a>
                    <span class="text-gray-400 text-sm ml-2">{{ __('messages.reviewed') }}</span>
                    @if($review->movie)
                        <a href="{{ route('movies.show', $review->movie) }}" class="text-indigo-500 hover:underline ml-1">{{ $review->movie->title }}</a>
                    @elseif($review->tvSeries)
                        <a href="{{ route('tv-series.show', $review->tvSeries) }}" class="text-indigo-500 hover:underline ml-1">{{ $review->tvSeries->title }}</a>
                    @endif
                </div>
                <span class="text-yellow-500 font-bold">⭐ {{ $review->rating }}/10</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">{{ $review->content }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ $review->created_at->diffForHumans() }}</p>
        </div>
        @empty
        <p class="text-gray-500">{{ __('messages.no_reviews_yet') }}</p>
        @endforelse
        <div class="mt-4">{{ $reviews->links() }}</div>
    </div>
</x-app-layout>