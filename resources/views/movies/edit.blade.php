<x-app-layout>
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">{{ __('messages.edit_movie_title') }}</h1>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('messages.title') }}</label>
                <input type="text" name="title" value="{{ old('title', $movie->title) }}"
                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm px-3 py-2">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('messages.description') }}</label>
                <textarea name="description" rows="4"
                          class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm px-3 py-2">{{ old('description', $movie->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('messages.year') }}</label>
                <input type="number" name="year" value="{{ old('year', $movie->year) }}"
                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm px-3 py-2">
                @error('year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('messages.director') }}</label>
                <input type="text" name="director" value="{{ old('director', $movie->director) }}"
                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded shadow-sm px-3 py-2">
                @error('director') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            @if($movie->poster_path)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.current_poster') }}</label>
                    <img src="{{ asset('storage/' . $movie->poster_path) }}" alt="Постер" class="w-32 h-auto rounded shadow">
                </div>
            @endif

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('messages.replace_poster') }}</label>
                <input type="file" name="poster" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('poster') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded">
                    {{ __('messages.save') }}
                </button>
                <a href="{{ route('movies.show', $movie) }}"
                   class="bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium px-5 py-2 rounded">
                    {{ __('messages.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>