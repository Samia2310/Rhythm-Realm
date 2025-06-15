<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $playlist->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold">{{ $playlist->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">by {{ $playlist->user->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">{{ $playlist->description ?? 'No description provided.' }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            Status: {{ $playlist->is_public ? 'Public' : 'Private' }}
                        </p>
                    </div>

                    {{-- Add Song to Playlist Section --}}
                    @if (Auth::check() && Auth::id() === $playlist->user_id)
                        <div class="mb-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="text-xl font-semibold mb-3">Add Songs to this Playlist</h4>
                            <form action="{{ route('playlists.add_song', $playlist->id) }}" method="POST">
                                @csrf
                                <div class="flex items-center space-x-2">
                                    <select name="song_id" class="block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <option value="">Search or Select a Song</option>
                                        {{-- You might need to load songs dynamically with JS or a search bar for many songs --}}
                                        @foreach ($allSongs as $songOption)
                                            <option value="{{ $songOption->id }}">{{ $songOption->title }} by {{ $songOption->artist->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        Add Song
                                    </button>
                                </div>
                                @error('song_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </form>
                        </div>
                    @endif

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">{{ $playlist->songs->count() }} Songs in this Playlist</h4>
                        @forelse ($playlist->songs as $song)
                            <div class="mb-3 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm flex justify-between items-center">
                                <div>
                                    <h5 class="text-lg font-medium">
                                        <a href="{{ route('songs.show', $song->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ $song->title }}</a>
                                    </h5>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        by <a href="{{ route('artists.show', $song->artist->id) }}" class="hover:underline">{{ $song->artist->name }}</a>
                                        @if($song->album) on {{ $song->album->title }} @endif
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Duration: {{ gmdate("i:s", $song->duration_seconds) }}</p>
                                </div>
                                @if (Auth::check() && Auth::id() === $playlist->user_id)
                                    <form action="{{ route('playlists.remove_song', ['playlist' => $playlist->id, 'song' => $song->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this song from the playlist?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Remove
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">This playlist is currently empty.</p>
                        @endforelse
                    </div>

                    <div class="mt-6 flex justify-end">
                        @if (Auth::check() && Auth::id() === $playlist->user_id)
                            <a href="{{ route('playlists.edit', $playlist->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                Edit Playlist
                            </a>
                        @endif
                        <a href="{{ route('playlists.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Back to Playlists
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
