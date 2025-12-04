{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col items-center justify-center min-h-screen p-6 lg:p-8">

    <!-- HEADER -->
    <header class="w-full max-w-[335px] lg:max-w-4xl mb-10">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4 text-sm">

                @auth
                    <!-- Dashboard Button -->
                    <a href="{{ url('/home') }}"
                       class="px-5 py-1.5 rounded-md border
                              text-[#1b1b18] dark:text-[#EDEDEC]
                              border-[#d6d6d6] dark:border-[#3E3E3A]
                              bg-white dark:bg-[#161615]
                              shadow-sm hover:shadow-md
                              hover:border-[#a8a8a8] dark:hover:border-[#62605b]
                              transition-all duration-200">
                       Dashboard
                    </a>
                @else
                    <!-- Login Button -->
                    <a href="{{ route('login') }}"
                       class="px-5 py-1.5 rounded-md
                              text-[#1b1b18] dark:text-[#EDEDEC]
                              bg-white dark:bg-[#161615]
                              border border-transparent
                              shadow-sm hover:shadow-md
                              hover:border-[#c6c6c6] dark:hover:border-[#3E3E3A]
                              transition-all duration-200">
                       Log in
                    </a>

                    @if (Route::has('register'))
                        <!-- Register Button -->
                        <a href="{{ route('register') }}"
                           class="px-5 py-1.5 rounded-md border
                                  text-[#1b1b18] dark:text-[#EDEDEC]
                                  bg-white dark:bg-[#161615]
                                  border-[#d6d6d6] dark:border-[#3E3E3A]
                                  shadow-sm hover:shadow-md
                                  hover:border-[#a6a6a6] dark:hover:border-[#62605b]
                                  transition-all duration-200">
                           Register
                        </a>
                    @endif
                @endauth

            </nav>
        @endif
    </header>

    <!-- SPACING BELOW HEADER (DESKTOP ONLY) -->
    @if (Route::has('login'))
        <div class="hidden lg:block h-10"></div>
    @endif

</body>
</html> --}}
