<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Playlists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">My Playlists</h3>
                        <a href="{{ route('playlists.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Create New Playlist
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

                    @forelse ($playlists as $playlist)
                        <div class="border-b border-gray-200 dark:border-gray-700 py-4 flex justify-between items-center">
                            <div>
                                <a href="{{ route('playlists.show', $playlist->id) }}" class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                    {{ $playlist->name }}
                                </a>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                                    {{ Str::limit($playlist->description, 100) }}
                                    @if (!$playlist->is_public) (Private) @endif
                                </p>
                                <p class="text-gray-600 dark:text-gray-400 text-xs mt-1">{{ $playlist->songs->count() }} songs</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('playlists.edit', $playlist->id) }}" class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Edit
                                </a>
                                <form action="{{ route('playlists.destroy', $playlist->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this playlist?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">You haven't created any playlists yet.</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $playlists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
