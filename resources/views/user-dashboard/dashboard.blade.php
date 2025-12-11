<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    @vite(['resources/css/user-dashboard/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<!-- ======================================
     NAVBAR (Modern Glassmorphism)
====================================== -->
<nav x-data="{ open: false }" class="navbar-glass">
    <div class="nav-container">
        <div class="nav-content">

                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="nav-link active-nav">Dashboard</a>
                </div>

            </div>

            <!-- RIGHT: USER DROPDOWN -->
            <div class="nav-right desktop-only">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="user-btn">
                        {{ Auth::user()->name }}
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        Profile
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('custom.logout') }}">
                        @csrf
                        <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>


            <!-- MOBILE MENU BUTTON -->
            <div class="mobile-hamburger mobile-only">
                <button @click="open = !open" class="mobile-hamburger-btn">
                    <img src="/icons/menu.svg" class="hamburger-icon" />
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" class="mobile-menu mobile-only">
        <div class="mobile-links">
            <a href="{{ route('dashboard') }}" class="mobile-link">Dashboard</a>
        </div>

        <div class="mobile-user">
            <div class="mobile-user-name">{{ Auth::user()->name }}</div>
            <div class="mobile-user-email">{{ Auth::user()->email }}</div>
        </div>

        <div class="mobile-actions">
            <a href="{{ route('profile.edit') }}" class="mobile-link">Profile</a>

            <form method="POST" action="{{ route('custom.logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="mobile-link">
                    Log Out
                </a>
            </form>
        </div>
    </div>

</nav>

<!-- ======================================
     PAGE CONTENT
====================================== -->
<div class="page-wrapper">

    <h1 class="welcome-title">Welcome, {{ Auth::user()->name }}!</h1>

    <div class="dashboard-grid">

        <a href="{{ route('ordering.supplies') }}" class="dashboard-button btn-blue futuristic-hover">
            <span>Ordering of Supplies</span>
        </a>

    </div>

</div>

</body>
</html>
