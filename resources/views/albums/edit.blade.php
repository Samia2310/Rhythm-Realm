<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Album: ') . $album->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('albums.update', $album->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Album Title -->
                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Album Title</label>
                            <input id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="title" value="{{ old('title', $album->title) }}" required autofocus />
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Artist Selection -->
                        <div class="mb-4">
                            <label for="artist_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Artist</label>
                            <select id="artist_id" name="artist_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" required>
                                <option value="">Select an Artist</option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}" @selected(old('artist_id', $album->artist_id) == $artist->id)>{{ $artist->name }}</option>
                                @endforeach
                            </select>
                            @error('artist_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Release Year -->
                        <div class="mb-4">
                            <label for="release_year" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Release Year</label>
                            <input id="release_year" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="number" name="release_year" value="{{ old('release_year', $album->release_year) }}" min="1900" max="{{ date('Y') }}" />
                            @error('release_year')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Cover Image (optional display) -->
                        @if ($album->cover_image_path)
                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Current Cover Image</label>
                                <img src="{{ Storage::url($album->cover_image_path) }}" alt="{{ $album->title }} Cover" class="w-24 h-24 object-cover mt-2 rounded border border-gray-300 dark:border-gray-600">
                            </div>
                        @endif

                        <!-- New Cover Image -->
                        <div class="mb-4">
                            <label for="cover_image_path" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Upload New Cover Image (optional)</label>
                            <input id="cover_image_path" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="file" name="cover_image_path" accept="image/*" />
                            @error('cover_image_path')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('albums.show', $album->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Update Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>