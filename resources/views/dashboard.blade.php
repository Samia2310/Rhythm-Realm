<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light-gray-text leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-medium-gray overflow-hidden shadow-xl sm:rounded-lg"> <!-- Main card background -->
                <div class="p-6 text-light-gray-text"> <!-- Text color -->
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
