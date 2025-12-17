<x-guest-layout>
    @section('title', 'Forgot Password')

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Please provide your email address. We will send you an account invitation that will allow you to log in to this website.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4 w-full">
            @if (Route::has('register'))
            <div class="">
                <a href="{{ url('login') }}" class="link-small">Back</a>
            </div>
            @endif
            <x-primary-button>
                {{ __('Send') }}
            </x-primary-button>
            
        </div>
    </form>
</x-guest-layout>
