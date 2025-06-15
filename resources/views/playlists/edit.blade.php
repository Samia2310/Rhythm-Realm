<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    {{-- Add your new links here --}}
    <x-nav-link :href="route('artists.index')" :active="request()->routeIs('artists.index')">
        {{ __('Artists') }}
    </x-nav-link>
    <x-nav-link :href="route('albums.index')" :active="request()->routeIs('albums.index')">
        {{ __('Albums') }}
    </x-nav-link>
    <x-nav-link :href="route('songs.index')" :active="request()->routeIs('songs.index')">
        {{ __('Songs') }}
    </x-nav-link>
    <x-nav-link :href="route('playlists.index')" :active="request()->routeIs('playlists.index')">
        {{ __('Playlists') }}
    </x-nav-link>
</div>