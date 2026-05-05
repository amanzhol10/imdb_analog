<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Редактировать отзыв
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Фильм: <span class="font-medium text-gray-700 dark:text-gray-200">{{ $review->movie->title }}</span>
            </p>

            <form action="{{ route('reviews.update', $review) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Оценка</label>
                    <select name="rating" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm px-3 py-2">
                        @for($i = 10; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>
                                {{ $i }} / 10
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Текст отзыва</label>
                    <textarea name="content" rows="5"
                              class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm px-3 py-2">{{ old('content', $review->content) }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded">
                        Сохранить
                    </button>
                    <a href="{{ route('movies.show', $review->movie_id) }}"
                       class="bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium px-5 py-2 rounded">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>