<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Artist: ') . $artist->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('artists.update', $artist->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH') {{-- Use PATCH method for updates --}}

                        <!-- Artist Name -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Artist Name</label>
                            <input id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="name" value="{{ old('name', $artist->name) }}" required autofocus />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="mb-4">
                            <label for="bio" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Biography</label>
                            <textarea id="bio" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" name="bio">{{ old('bio', $artist->bio) }}</textarea>
                            @error('bio')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Genre -->
                        <div class="mb-4">
                            <label for="genre" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Main Genre</label>
                            <input id="genre" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="text" name="genre" value="{{ old('genre', $artist->genre) }}" />
                            @error('genre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Profile Picture (optional display) -->
                        @if ($artist->image_path)
                            <div class="mb-4">
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Current Profile Picture</label>
                                <img src="{{ Storage::url($artist->image_path) }}" alt="{{ $artist->name }}'s profile picture" class="w-24 h-24 rounded-full object-cover mt-2 border border-gray-300 dark:border-gray-600">
                            </div>
                        @endif

                        <!-- New Profile Picture -->
                        <div class="mb-4">
                            <label for="image_path" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Upload New Profile Picture (optional)</label>
                            <input id="image_path" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="file" name="image_path" accept="image/*" />
                            @error('image_path')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('artists.show', $artist->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-800 transition ease-in-out duration-150 mr-2">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-800 transition ease-in-out duration-150">
                                Update Artist
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>