<section class="space-y-10">

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Account Settings') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your profile information and password in one action.') }}
        </p>
    </header>

    <!-- Email Verification (separate, no change) -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- =====================
        SINGLE UPDATE FORM
    ====================== -->
    <form method="POST" action="{{ route('profile.update.all') }}" class="mt-6 space-y-8">
        @csrf
        @method('patch')

        <!-- =====================
            PROFILE INFO
        ====================== -->
        <div>
            <h3 class="font-semibold text-gray-800 mb-3">Profile Information</h3>

            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 block w-full"
                        :value="old('name', $user->name)"
                        required
                        autofocus
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="mt-1 block w-full"
                        :value="old('email', $user->email)"
                        required
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <p class="mt-2 text-sm text-gray-700">
                            {{ __('Your email address is unverified.') }}
                            <button
                                form="send-verification"
                                class="underline text-sm text-indigo-600 hover:text-indigo-800">
                                {{ __('Re-send verification email') }}
                            </button>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- =====================
            PASSWORD (OPTIONAL)
        ====================== -->
        <div class="pt-6 border-t">
            <h3 class="font-semibold text-gray-800 mb-3">Change Password (Optional)</h3>

            <div class="space-y-4">
                <div>
                    <x-input-label for="current_password" :value="__('Current Password')" />
                    <x-text-input
                        id="current_password"
                        name="current_password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="current-password"
                    />
                    <x-input-error
                        :messages="$errors->get('current_password')"
                        class="mt-2"
                    />
                </div>

                <div>
                    <x-input-label for="password" :value="__('New Password')" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                    />
                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                    />
                </div>
            </div>
        </div>

        <!-- =====================
            SAVE BUTTON
        ====================== -->
        <div class="flex items-center gap-4 pt-6">
            <x-primary-button>
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >
                    {{ __('Saved successfully.') }}
                </p>
            @endif
        </div>

    </form>

</section>
