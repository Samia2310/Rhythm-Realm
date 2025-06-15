<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center mb-6">
                        @if ($album->cover_image_path)
                            <img src="{{ Storage::url($album->cover_image_path) }}" alt="{{ $album->title }} Cover" class="w-48 h-48 object-cover mr-6 rounded border border-gray-300 dark:border-gray-600">
                        @else
                            <div class="w-48 h-48 bg-gray-200 dark:bg-gray-700 rounded mr-6 flex items-center justify-center text-gray-500 dark:text-gray-400 text-xl">No Cover</div>
                        @endif
                        <div>
                            <h3 class="text-3xl font-bold">{{ $album->title }}</h3>
                            <p class="text-indigo-600 dark:text-indigo-400 text-lg">by <a href="{{ route('artists.show', $album->artist->id) }}" class="hover:underline">{{ $album->artist->name }}</a></p>
                            <p class="text-gray-600 dark:text-gray-400 text-md">Released: {{ $album->release_year }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">Songs in this Album</h4>
                        @forelse ($album->songs as $song)
                            <div class="mb-3 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm flex justify-between items-center">
                                <div>
                                    <h5 class="text-lg font-medium">{{ $song->title }}</h5>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Duration: {{ gmdate("i:s", $song->duration_seconds) }}</p>
                                </div>
                                <a href="{{ route('songs.show', $song->id) }}" class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Listen
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">No songs found in this album yet.</p>
                        @endforelse
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('albums.edit', $album->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            Edit Album
                        </a>
                        <a href="{{ route('albums.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Back to Albums
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
