<section>
    <header>
        <h2 class="text-lg font-medium text-light-gray-text">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-faded-gray-text">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-faded-gray-text" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-dark-gray border-medium-gray text-light-gray-text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-faded-gray-text" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-dark-gray border-medium-gray text-light-gray-text" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-light-gray-text">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-faded-gray-text hover:text-accent-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-accent-blue-500 focus:ring-offset-2 ring-offset-medium-gray">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-accent-blue-600 hover:bg-accent-blue-700 focus:ring-accent-blue-500 ring-offset-medium-gray">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
