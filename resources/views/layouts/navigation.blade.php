<nav x-data="{ open: false }" class="bg-dark-gray border-b border-medium-gray shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-accent-blue-500 text-2xl font-bold"> <!-- Added text styles for placeholder -->
                        <!-- Laravel logo removed, placeholder text/div can go here -->
                        Rhythm Realm
                        <!-- Or simply an empty div if you prefer no text placeholder: -->
                        {{-- <div class="w-9 h-9 flex items-center justify-center text-accent-blue-500">
                             <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">...</svg> <!-- You can replace with an SVG icon here later -->
                        </div> --}}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-light-gray-text hover:text-accent-blue-400 hover:border-accent-blue-400">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('artists.index')" :active="request()->routeIs('artists.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:border-accent-blue-400">
                        {{ __('Artists') }}
                    </x-nav-link>
                    <x-nav-link :href="route('albums.index')" :active="request()->routeIs('albums.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:border-accent-blue-400">
                        {{ __('Albums') }}
                    </x-nav-link>
                    <x-nav-link :href="route('songs.index')" :active="request()->routeIs('songs.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:border-accent-blue-400">
                        {{ __('Songs') }}
                    </x-nav-link>
                    <x-nav-link :href="route('playlists.index')" :active="request()->routeIs('playlists.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:border-accent-blue-400">
                        {{ __('Playlists') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-faded-gray-text bg-medium-gray hover:text-light-gray-text focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-light-gray-text hover:bg-secondary-accent-blue-950">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                class="text-light-gray-text hover:bg-secondary-accent-blue-950">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-faded-gray-text hover:text-light-gray-text hover:bg-medium-gray focus:outline-none focus:bg-medium-gray focus:text-light-gray-text transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-light-gray-text hover:text-accent-blue-400 hover:bg-medium-gray">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('artists.index')" :active="request()->routeIs('artists.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:bg-medium-gray">
                {{ __('Artists') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('albums.index')" :active="request()->routeIs('albums.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:bg-medium-gray">
                {{ __('Albums') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('songs.index')" :active="request()->routeIs('songs.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:bg-medium-gray">
                {{ __('Songs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('playlists.index')" :active="request()->routeIs('playlists.index')" class="text-light-gray-text hover:text-accent-blue-400 hover:bg-medium-gray">
                {{ __('Playlists') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-medium-gray">
            <div class="px-4">
                <div class="font-medium text-base text-light-gray-text">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-faded-gray-text">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-light-gray-text hover:bg-medium-gray">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                        class="text-light-gray-text hover:bg-medium-gray">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
