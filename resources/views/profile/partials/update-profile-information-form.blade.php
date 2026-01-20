<section class="space-y-10">

    <header>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your profile information and password in one action.') }}
        </p>
    </header>

    @if (session('status') === 'updated')
                <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                style="color:#16a34a; padding-top:15px; margin-bottom:-5px;"
                class="text-sm font-semibold"
            >
                Saved successfully.
            </p>


            @endif
            
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update.all') }}" class="mt-6 space-y-8">
        @csrf
        @method('patch')

        <div>

            <div class="space-y-4">
                 <div>
                    <x-input-label
                        for="name"
                        :value="__('Name')"
                        class="block mb-2"
                    />
                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="block w-full"
                        :value="old('name', $user->name)"
                        required
                        autofocus
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                     <x-input-label
                        for="email"
                        :value="__('Email')"
                        class="block mb-2"
                    />
                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="block w-full"
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

        <div class="pt-6 border-t">
            <h3 class="change-pass">Change Password</h3>

            <div class="space-y-4">
                <div>
                <x-input-label for="current_password" :value="__('Current Password')" />

                <div class="password-wrapper">
                    <x-text-input
                        id="current_password"
                        name="current_password"
                        type="password"
                        class="mt-1 block w-full password-input"
                        autocomplete="current-password"
                    />

                    <i class="far fa-eye toggle-password"
                    data-target="current_password"></i>

                </div>

                <x-input-error
                    :messages="$errors->get('current_password')"
                    class="mt-2"
                />
            </div>


                <div>
                <x-input-label for="password" :value="__('New Password')" />

                <div class="password-wrapper">
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full password-input"
                        autocomplete="new-password"
                    />

                    <i class="far fa-eye toggle-password"
                    data-target="password"></i>
                </div>

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />
            </div>


                <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <div class="password-wrapper">
                    <x-text-input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="mt-1 block w-full password-input"
                        autocomplete="new-password"
                    />

                    <i class="far fa-eye toggle-password"
                    data-target="password_confirmation"></i>
                </div>
            </div>

            </div>
        </div>

        <div class="flex items-center gap-4 pt-6">
            <x-primary-button>
                {{ __('Save Changes') }}
            </x-primary-button>

        </div>

    </form>

</section>
