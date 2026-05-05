<x-app-layout>
    <div class="py-8 max-w-5xl mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-72 shrink-0">
                    @if($tvSeries->poster_path)
                        <img src="{{ Storage::url($tvSeries->poster_path) }}" class="w-full h-full object-cover max-h-96">
                    @else
                        <div class="w-full h-72 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-6xl">📺</div>
                    @endif
                </div>
                <div class="p-8 flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $tvSeries->title }}</h1>
                    <div class="flex flex-wrap gap-3 text-sm text-gray-500 mb-4">
                        <span>📅 {{ $tvSeries->year }}</span>
                        <span>📺 {{ $tvSeries->seasons }} {{ __('messages.season') }}</span>
                        <span class="{{ $tvSeries->status === 'ongoing' ? 'text-green-600' : 'text-gray-400' }}">
                            ● {{ $tvSeries->status === 'ongoing' ? __('messages.status_ongoing') : __('messages.status_ended') }}
                        </span>
                        @if($tvSeries->director)<span>🎬 {{ $tvSeries->director }}</span>@endif
                    </div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-3xl font-bold text-yellow-500">{{ number_format($avgRating ?? 0, 1) }}</span>
                        <span class="text-gray-400 text-sm">/ 10 ({{ $tvSeries->reviews->count() }} {{ __('messages.reviews') }})</span>
                    </div>
                    @if($tvSeries->genres->count())
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($tvSeries->genres as $genre)
                        <a href="{{ route('genres.show', $genre) }}" class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full">{{ $genre->name }}</a>
                        @endforeach
                    </div>
                    @endif
                    <p class="text-gray-600 dark:text-gray-300">{{ $tvSeries->description }}</p>
                </div>
            </div>
        </div>

        @if($tvSeries->actors->count())
        <div class="mt-8">
            <h2 class="text-xl font-bold dark:text-white mb-4">🎭 {{ __('messages.cast') }}</h2>
            <div class="grid grid-cols-3 sm:grid-cols-5 gap-4">
                @foreach($tvSeries->actors as $actor)
                <a href="{{ route('actors.show', $actor) }}" class="text-center">
                    @if($actor->photo_path)
                        <img src="{{ Storage::url($actor->photo_path) }}" class="w-16 h-16 rounded-full mx-auto object-cover">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-2xl mx-auto">👤</div>
                    @endif
                    <p class="text-xs font-medium dark:text-white mt-1">{{ $actor->name }}</p>
                    <p class="text-xs text-gray-400">{{ $actor->pivot->character }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-8">
            <h2 class="text-xl font-bold dark:text-white mb-4">💬 {{ __('messages.reviews') }}</h2>
            @auth
                @if(!$userReview)
                <form action="{{ route('reviews.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow mb-6">
                    @csrf
                    <input type="hidden" name="tv_series_id" value="{{ $tvSeries->id }}">
                    <div class="mb-3">
                        <label class="block text-sm font-medium dark:text-white mb-1">{{ __('messages.rating_hint') }}</label>
                        <input type="number" name="rating" min="1" max="10" required class="w-24 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2">
                    </div>
                    <textarea name="body" rows="3" placeholder="{{ __('messages.write_review') }}" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 mb-3"></textarea>
                    <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">{{ __('messages.submit_review') }}</button>
                </form>
                @endif
            @endauth

            @forelse($tvSeries->reviews as $review)
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow mb-4">
                <div class="flex justify-between items-center mb-2">
                    <a href="{{ route('profile.show', $review->user) }}" class="font-semibold text-gray-800 dark:text-white hover:underline">{{ $review->user->name }}</a>
                    <span class="text-yellow-500 font-bold">⭐ {{ $review->rating }}/10</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300">{{ $review->content }}</p>
            </div>
            @empty
            <p class="text-gray-500">{{ __('messages.no_reviews') }}</p>
            @endforelse
        </div>
    </div>
</x-app-layout>