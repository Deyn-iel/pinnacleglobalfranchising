<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <title>IT Dashboard</title>
</head>
<body>
    <h1>IT Dashboard</h1>

    <li class="logout-item">
            <form method="POST" action="{{ route('custom.logout') }}" onsubmit="handleLogout()">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-arrow-right-from-bracket"></i>
                    <span>Log out</span>
                </button>
            </form>
        </li>
</body>
</html>