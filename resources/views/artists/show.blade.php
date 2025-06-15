<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $artist->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center mb-6">
                        @if ($artist->image_path)
                            <img src="{{ Storage::url($artist->image_path) }}" alt="{{ $artist->name }}'s profile picture" class="w-32 h-32 rounded-full object-cover mr-6 border border-gray-300 dark:border-gray-600">
                        @else
                            {{-- Placeholder image if no image --}}
                            <div class="w-32 h-32 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 text-lg mr-6">
                                No Image
                            </div>
                        @endif
                        <div>
                            <h3 class="text-3xl font-bold">{{ $artist->name }}</h3>
                            <p class="text-indigo-600 dark:text-indigo-400">{{ $artist->genre }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-2">Biography</h4>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $artist->bio ?? 'No biography provided yet.' }}</p>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">Albums by {{ $artist->name }}</h4>
                        @forelse ($artist->albums as $album)
                            <div class="mb-3 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm">
                                <h5 class="text-lg font-medium">{{ $album->title }} ({{ $album->release_year }})</h5>
                                {{-- Link to album show page later: <a href="{{ route('albums.show', $album->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">View Album</a> --}}
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">No albums uploaded by this artist yet.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">Songs by {{ $artist->name }}</h4>
                        @forelse ($artist->songs as $song)
                            <div class="mb-3 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-sm">
                                <h5 class="text-lg font-medium">{{ $song->title }}</h5>
                                {{-- Link to song show page later: <a href="{{ route('songs.show', $song->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Listen</a> --}}
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">No songs uploaded by this artist yet.</p>
                        @endforelse
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('artists.edit', $artist->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            Edit Artist
                        </a>
                        <a href="{{ route('artists.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Back to Artists
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>