<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    @vite(['resources/css/user-dashboard/app.css', 'resources/js/app.js'])
</head>

<body>

<!-- ======================================
     NAVBAR — Modern SaaS Style
====================================== -->
<nav x-data="{ open: false, dropdownOpen: false }" class="navbar-glass">
    <div class="nav-container">
        <div class="nav-content">

            <!-- LEFT: LOGO + LINKS -->
            <div class="nav-left">
                <img src="{{ asset('img/logo1.jpg') }}" alt="Logo" class="nav-logo">

                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="nav-link active-nav">Dashboard</a>
                </div>
            </div>

            <!-- RIGHT: USER -->
            <div class="nav-right desktop-only">
                <div class="user-dropdown-wrapper">

                    <button @click="dropdownOpen = !dropdownOpen" class="user-btn">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        {{-- <img src="/icons/user.svg" class="user-avatar"> --}}
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="dropdown-panel">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>

                        <form method="POST" action="{{ route('custom.logout') }}">
                            @csrf
                            <button class="logout-btn"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- MOBILE MENU BUTTON -->
            <button @click="open = !open" class="mobile-hamburger mobile-only">
                <img src="/icons/menu.svg" class="hamburger-icon">
            </button>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" class="mobile-menu mobile-only">

        <div class="mobile-user">
            <div class="mobile-user-name">{{ Auth::user()->name }}</div>
            <div class="mobile-user-email">{{ Auth::user()->email }}</div>
        </div>

        <a href="{{ route('dashboard') }}" class="mobile-link">Dashboard</a>
        <a href="{{ route('profile.edit') }}" class="mobile-link">Profile</a>

        <form method="POST" action="{{ route('custom.logout') }}">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="mobile-link logout-mobile">
                Log Out
            </a>
        </form>

    </div>
</nav>


<!-- ======================================
     PAGE CONTENT
====================================== -->
<div class="page-wrapper">

    <div class="welcome-section">
        <h1 class="welcome-title">Welcome back, {{ Auth::user()->name }} 👋</h1>
        <p class="welcome-subtitle">Choose a service to get started.</p>
    </div>

    <div class="dashboard-grid">

        <a href="{{ route('ordering.supplies') }}" class="dashboard-card">
            <img src="/icons/box.svg" class="card-icon">
            <span>Ordering of Supplies</span>
        </a>

        <a href="{{ route('exam') }}" class="dashboard-card">
            <img src="/icons/exam.svg" class="card-icon">
            <span>Take an Exam</span>
        </a>

    </div>

</div>

</body>
</html>
