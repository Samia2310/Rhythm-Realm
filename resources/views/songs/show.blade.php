<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $song->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center mb-6">
                        @if ($song->album && $song->album->cover_image_path)
                            <img src="{{ Storage::url($song->album->cover_image_path) }}" alt="{{ $song->album->title }} Cover" class="w-32 h-32 object-cover mr-6 rounded border border-gray-300 dark:border-gray-600">
                        @else
                            <div class="w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded mr-6 flex items-center justify-center text-gray-500 dark:text-gray-400 text-lg">
                                Music
                            </div>
                        @endif
                        <div>
                            <h3 class="text-3xl font-bold">{{ $song->title }}</h3>
                            <p class="text-indigo-600 dark:text-indigo-400 text-lg">
                                by <a href="{{ route('artists.show', $song->artist->id) }}" class="hover:underline">{{ $song->artist->name }}</a>
                            </p>
                            @if($song->album)
                                <p class="text-gray-600 dark:text-gray-400 text-md">
                                    on <a href="{{ route('albums.show', $song->album->id) }}" class="hover:underline">{{ $song->album->title }}</a> ({{ $song->album->release_year }})
                                </p>
                            @endif
                            <p class="text-gray-600 dark:text-gray-400 text-md">
                                Duration: {{ gmdate("i:s", $song->duration_seconds) }} | Plays: {{ $song->play_count }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-2">Play Song</h4>
                        <audio controls class="w-full">
                            <source src="{{ Storage::url($song->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">Lyrics</h4>
                        <div class="text-gray-600 dark:text-gray-400 whitespace-pre-wrap">
                            {{ $song->lyrics ?? 'No lyrics available for this song yet.' }}
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('songs.edit', $song->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            Edit Song
                        </a>
                        <a href="{{ route('songs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Back to Songs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
