<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">All Albums</h3>
                        <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Add New Album
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @forelse ($albums as $album)
                        <div class="border-b border-gray-200 dark:border-gray-700 py-4 flex justify-between items-center">
                            <div class="flex items-center">
                                @if ($album->cover_image_path)
                                    <img src="{{ Storage::url($album->cover_image_path) }}" alt="{{ $album->title }} Cover" class="w-16 h-16 object-cover rounded mr-4">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded mr-4 flex items-center justify-center text-gray-500 dark:text-gray-400 text-xs">No Cover</div>
                                @endif
                                <div>
                                    <a href="{{ route('albums.show', $album->id) }}" class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                        {{ $album->title }}
                                    </a>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                                        by <a href="{{ route('artists.show', $album->artist->id) }}" class="hover:underline">{{ $album->artist->name }}</a>
                                        ({{ $album->release_year }})
                                    </p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('albums.edit', $album->id) }}" class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Edit
                                </a>
                                <form action="{{ route('albums.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this album? This will also delete associated songs!');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No albums found. Start by adding a new one!</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $albums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
