<x-app-layout>
    <div class="py-8 max-w-4xl mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8 mb-8 flex items-center gap-6">
            <div class="w-20 h-20 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-3xl font-bold text-indigo-600 dark:text-indigo-300">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold dark:text-white">{{ $user->name }}</h1>
                <p class="text-gray-400 text-sm">{{ __('messages.member_since') }} {{ $user->created_at->format('M Y') }}</p>
                <p class="text-gray-500 text-sm mt-1">{{ $reviews->total() }} {{ __('messages.reviews_written') }}</p>
            </div>
            @auth
                @if(auth()->id() === $user->id)
                <a href="{{ route('profile.edit') }}" class="ml-auto bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                    {{ __('messages.edit_profile') }}
                </a>
                @endif
            @endauth
        </div>

        <h2 class="text-xl font-bold dark:text-white mb-4">💬 {{ __('messages.reviews_by') }} {{ $user->name }}</h2>
        @forelse($reviews as $review)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 mb-4">
            <div class="flex justify-between items-center mb-2">
                <div>
                    @if($review->movie)
                        <a href="{{ route('movies.show', $review->movie) }}" class="font-semibold text-indigo-500 hover:underline">{{ $review->movie->title }}</a>
                        <span class="text-xs text-gray-400 ml-1">🎬 {{ __('messages.movie_label') }}</span>
                    @elseif($review->tvSeries)
                        <a href="{{ route('tv-series.show', $review->tvSeries) }}" class="font-semibold text-indigo-500 hover:underline">{{ $review->tvSeries->title }}</a>
                        <span class="text-xs text-gray-400 ml-1">📺 {{ __('messages.tv_series') }}</span>
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