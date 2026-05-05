<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="responsive-container max-w-4xl mx-auto px-4 py-8">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if($errors->has('review'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ $errors->first('review') }}</div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
            <div class="movie-detail-grid">

                <div class="poster-wrapper">
                    @if($movie->poster_path)
                        <img src="{{ asset('storage/' . $movie->poster_path) }}"
                             alt="{{ $movie->title }}"
                             class="w-full h-auto rounded shadow-lg object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-gray-500">
                            {{ __('messages.no_image') }}
                        </div>
                    @endif
                </div>

                <div>
                    <div class="flex items-start justify-between">
                        <div>
                            <h1 class="responsive-title font-bold text-gray-900 dark:text-white">
                                {{ $movie->title }} <span class="text-gray-400 font-normal">({{ $movie->year }})</span>
                            </h1>
                            <p class="responsive-subtitle text-gray-500 dark:text-gray-400 mt-1">
                                {{ __('messages.director') }}: {{ $movie->director }}
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-yellow-500">
                                {{ $avgRating ? number_format($avgRating, 1) : '—' }}
                                <span class="text-base text-gray-400">/10</span>
                            </div>
                            <div class="text-sm text-gray-400">{{ $movie->reviews->count() }} {{ __('messages.reviews_count') }}</div>
                        </div>
                    </div>

                    <p class="mt-4 text-gray-700 dark:text-gray-300 leading-relaxed">{{ $movie->description }}</p>

                    <div class="mt-6 flex gap-2">
                        @can('edit movies')
                            <a href="{{ route('movies.edit', $movie) }}"
                               class="text-sm bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded px-4 py-2">
                                {{ __('messages.edit_movie') }}
                            </a>
                        @endcan
                        @role('admin|super-admin')
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                                  onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">
                                @csrf @method('DELETE')
                                <button class="text-sm bg-red-100 hover:bg-red-200 text-red-700 rounded px-4 py-2">
                                    {{ __('messages.delete_movie') }}
                                </button>
                            </form>
                        @endrole
                    </div>
                </div>
            </div>
        </div>

        @auth
            @if(!$userReview)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ __('messages.leave_review') }}</h2>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('messages.rating') }}</label>
                            <select name="rating" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm text-sm px-3 py-2">
                                @for($i = 10; $i >= 1; $i--)
                                    <option value="{{ $i }}">{{ $i }} / 10</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('messages.your_review') }}</label>
                            <textarea name="content" rows="4"
                                      class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm text-sm px-3 py-2"
                                      placeholder="{{ __('messages.share_impressions') }}">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded">
                            {{ __('messages.publish') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="mb-6 p-3 bg-blue-50 dark:bg-gray-700 text-blue-700 dark:text-blue-300 rounded text-sm">
                    {{ __('messages.already_reviewed') }}
                    <a href="{{ route('reviews.edit', $userReview) }}" class="underline ml-1">{{ __('messages.edit_review') }}</a>
                </div>
            @endif
        @else
            <div class="mb-6 p-3 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded text-sm">
                <a href="{{ route('login') }}" class="underline">{{ __('messages.login') }}</a>, {{ __('messages.login_to_review') }}
            </div>
        @endauth

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">{{ __('messages.reviews') }}</h2>

        @forelse($movie->reviews as $review)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 mb-4">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-3">
                        <span class="font-medium text-gray-900 dark:text-white">{{ $review->user->name }}</span>
                        <span class="text-yellow-500 font-semibold text-sm">★ {{ $review->rating }}/10</span>
                    </div>
                    <span class="text-xs text-gray-400">{{ $review->created_at->format('d.m.Y') }}</span>
                </div>
                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">{{ $review->content }}</p>

                @if(auth()->id() === $review->user_id || auth()->user()?->hasRole(['admin', 'super-admin']))
                    <div class="mt-3 flex gap-2">
                        @if(auth()->id() === $review->user_id)
                            <a href="{{ route('reviews.edit', $review) }}"
                               class="text-xs bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded px-3 py-1">
                                {{ __('messages.edit_review') }}
                            </a>
                        @endif
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                              onsubmit="return confirm('{{ __('messages.delete_review_confirm') }}')">
                            @csrf @method('DELETE')
                            <button class="text-xs bg-red-100 hover:bg-red-200 text-red-700 rounded px-3 py-1">
                                {{ __('messages.delete_review') }}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-400 text-sm">{{ __('messages.no_reviews') }}</p>
        @endforelse

        <div class="mt-6">
            <a href="{{ route('movies.index') }}" class="text-sm text-blue-600 hover:underline">{{ __('messages.back_to_list') }}</a>
        </div>
    </div>
</x-app-layout>