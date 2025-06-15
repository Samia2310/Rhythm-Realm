<section>
    <header>
        <h2 class="text-lg font-medium text-light-gray-text">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-faded-gray-text">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Current Password')" class="text-faded-gray-text" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full bg-dark-gray border-medium-gray text-light-gray-text" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('New Password')" class="text-faded-gray-text" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full bg-dark-gray border-medium-gray text-light-gray-text" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-faded-gray-text" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-dark-gray border-medium-gray text-light-gray-text" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-accent-blue-600 hover:bg-accent-blue-700 focus:ring-accent-blue-500 ring-offset-medium-gray">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-faded-gray-text"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
