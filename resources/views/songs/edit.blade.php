<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Song: ') . $song->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('songs.update', $song->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Song Title -->
                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Song Title</label>
                            <input id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="title" value="{{ old('title', $song->title) }}" required autofocus />
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
                                    <option value="{{ $artist->id }}" @selected(old('artist_id', $song->artist_id) == $artist->id)>{{ $artist->name }}</option>
                                @endforeach
                            </select>
                            @error('artist_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Album Selection (Optional) -->
                        <div class="mb-4">
                            <label for="album_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Album (Optional)</label>
                            <select id="album_id" name="album_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">None</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}" @selected(old('album_id', $song->album_id) == $album->id)>{{ $album->title }} ({{ $album->artist->name }})</option>
                                @endforeach
                            </select>
                            @error('album_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Audio File Display (optional) -->
                        @if ($song->file_path)
                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Current Audio File</label>
                                <audio controls class="w-full mt-2">
                                    <source src="{{ Storage::url($song->file_path) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <p class="text-gray-600 dark:text-gray-400 text-xs mt-1">Path: {{ $song->file_path }}</p>
                            </div>
                        @endif

                        <!-- New Audio File -->
                        <div class="mb-4">
                            <label for="file_path" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Upload New Audio File (optional)</label>
                            <input id="file_path" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="file" name="file_path" accept="audio/mp3,audio/wav" />
                            @error('file_path')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Duration in Seconds -->
                        <div class="mb-4">
                            <label for="duration_seconds" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Duration (seconds)</label>
                            <input id="duration_seconds" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="number" name="duration_seconds" value="{{ old('duration_seconds', $song->duration_seconds) }}" min="0" required />
                            @error('duration_seconds')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="lyrics" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Lyrics</label>
                            <textarea id="lyrics" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" name="lyrics">{{ old('lyrics', $song->lyrics) }}</textarea>
                            @error('lyrics')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('songs.show', $song->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Update Song
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
