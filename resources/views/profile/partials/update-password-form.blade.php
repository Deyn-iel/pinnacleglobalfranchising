<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- CURRENT PASSWORD --}}
        <div class="password-group">
    <label class="password-label">Current Password</label>

    <div class="password-wrapper">
        <input
            id="current_password"
            name="current_password"
            type="password"
            class="password-input"
            autocomplete="current-password"
        />

        <i class="fas fa-eye toggle-password"
           data-target="current_password"></i>
    </div>

    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
</div>


        {{-- NEW PASSWORD --}}
        <div class="password-group">
    <label class="password-label">New Password</label>

    <div class="password-wrapper">
        <input
            id="password"
            name="password"
            type="password"
            class="password-input"
            autocomplete="new-password"
        />

        <i class="fas fa-eye toggle-password"
           data-target="password"></i>
    </div>

    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
</div>


        {{-- CONFIRM PASSWORD --}}
        <div class="password-group">
    <label class="password-label">Confirm Password</label>

    <div class="password-wrapper">
        <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            class="password-input"
            autocomplete="new-password"
        />

        <i class="fas fa-eye toggle-password"
           data-target="password_confirmation"></i>
    </div>

    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
</div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
