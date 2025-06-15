<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light-gray-text leading-tight">
            {{ __('Artists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark-gray overflow-hidden shadow-lg rounded-lg"> <!-- Fixed dark bg, added shadow and rounded corners -->
                <div class="p-6 text-light-gray-text"> <!-- Fixed text color -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-light-gray-text">All Artists</h3> <!-- Fixed text color -->
                        <a href="{{ route('artists.create') }}" class="inline-flex items-center px-4 py-2 bg-accent-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent-blue-700 focus:bg-accent-blue-700 active:bg-accent-blue-900 focus:outline-none focus:ring-2 focus:ring-accent-blue-500 focus:ring-offset-2 ring-offset-dark-gray transition ease-in-out duration-150">
                            Add New Artist
                        </a>
                    </div>

                    {{-- Display success/error messages --}}
                    @if (session('success'))
                        <div class="bg-green-700 border border-green-600 text-white px-4 py-3 rounded relative mb-4 shadow-md" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-700 border border-red-600 text-white px-4 py-3 rounded relative mb-4 shadow-md" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    {{-- Artist List (will be populated by the controller) --}}
                    @forelse ($artists as $artist)
                        <div class="border-b border-medium-gray py-4 flex justify-between items-center"> <!-- Fixed border color -->
                            <div>
                                <a href="{{ route('artists.show', $artist->id) }}" class="text-xl font-semibold text-accent-blue-400 hover:underline"> <!-- Fixed text-indigo -->
                                    {{ $artist->name }}
                                </a>
                                <p class="text-faded-gray-text text-sm mt-1">{{ Str::limit($artist->bio, 100) }}</p> <!-- Fixed text color -->
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('artists.edit', $artist->id) }}" class="inline-flex items-center px-3 py-1 bg-accent-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent-blue-700 focus:bg-accent-blue-700 active:bg-accent-blue-900 focus:outline-none focus:ring-2 focus:ring-accent-blue-500 focus:ring-offset-2 ring-offset-dark-gray transition ease-in-out duration-150">
                                    Edit
                                </a>
                                <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this artist?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 ring-offset-dark-gray transition ease-in-out duration-150">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-faded-gray-text">No artists found. Start by adding a new one!</p> <!-- Fixed text color -->
                    @endforelse

                    {{-- Pagination Links --}}
                    <div class="mt-4 text-faded-gray-text"> <!-- Ensure pagination text is visible -->
                        {{ $artists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
