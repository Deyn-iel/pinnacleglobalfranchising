<x-guest-layout>
@section('title', 'Login')
@if (Route::has('register'))
            <div class="extra-links">
                <a href="{{ route('register') }}" class="link-small">Register</a>
                <a href="{{ url('/') }}" class="link-small">Home</a>
            </div>
            @endif

    <h2 class="login-title"></h2>
        <p class="login-sub"></p>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <div class="relative">
        <x-text-input id="password"
            class="block mt-1 w-full pr-10"
            type="password"
            name="password"
            required autocomplete="current-password" />

        <!-- Eye Toggle Button -->
        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
              onclick="togglePassword()">

            <!-- Eye Icon -->
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none" 
                 stroke="currentColor" stroke-width="2">
                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </span>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4 w-full">

            @if (Route::has('password.request'))
    <a  href="{{ route('password.request') }}"
        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md 
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        style="text-decoration: none;">
        {{ __('Forgot your password?') }}
    </a>
@endif


            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>

        </div>

    </form>
</x-guest-layout>
