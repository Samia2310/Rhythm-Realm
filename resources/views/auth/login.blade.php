<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-accent-blue-500" />
            </a>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-faded-gray-text" />
                <x-text-input id="email" class="block mt-1 w-full bg-dark-gray border-medium-gray text-light-gray-text" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-faded-gray-text" />
                <x-text-input id="password" class="block mt-1 w-full bg-dark-gray border-medium-gray text-light-gray-text" type="password" name="password" required autocomplete="current-password" />
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="bg-dark-gray border-medium-gray text-accent-blue-500" />
                    <span class="ms-2 text-sm text-faded-gray-text">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-faded-gray-text hover:text-accent-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-accent-blue-500 focus:ring-offset-2 ring-offset-medium-gray" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4 bg-accent-blue-600 hover:bg-accent-blue-700 focus:ring-accent-blue-500 ring-offset-medium-gray">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
