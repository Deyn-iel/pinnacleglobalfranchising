<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <title>@yield('title') | Pinnacle Global</title>


    @vite(['resources/css/app.css', 'resources/js/main.js'])
</head>

<body>

<div class="container-login">

    <!-- LEFT SIDE -->
    <div class="left">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        
        <h2 class="logo"
            style="
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 1.4rem;
                font-weight: 600;
                margin: 0;
            ">
            <img src="{{ asset('img/logo1-removebg-preview.png') }}"
                alt="Logo"
                style="
                    width: 40px;
                    height: auto;
                    object-fit: contain;
                ">
            Pinnacle Global
        </h2>


        <div class="welcome-box">
            <h1>Welcome!</h1>
            <p>Log in to access your account and manage your services.</p>
        </div>

        <p class="footer-text">© 2026 Pinnacle Global Franchising</p>
    </div>
    <!-- RIGHT SIDE (Laravel Breeze Slot) -->
    <div class="right">
        {{ $slot }}
    </div>
</div>

</body>
</html>
