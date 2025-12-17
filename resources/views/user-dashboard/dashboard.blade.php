<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

[x-cloak] { display: none !important; }

:root {
    --primary: #0d3553;
    --primary-dark: #09263b;
    --bg: #f4f7fb;
    --card: #ffffff;
    --text: #1f2937;
    --muted: #6b7280;
    --radius: 16px;
}

body {
    background: var(--bg);
    color: var(--text);
}

/* =========================
   SIDEBAR
========================= */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, var(--primary), var(--primary-dark));
    padding: 22px 18px;
    z-index: 300;
}

/* SIDEBAR HEADER */
.sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 30px;
}

.sidebar-close {
    display: none;
    background: none;
    border: none;
    color: #fff;
    font-size: 22px;
    cursor: pointer;
}

/* LINKS */
.sidebar a,
.sidebar button {
    display: block;
    width: 100%;
    padding: 14px 16px;
    margin-bottom: 10px;
    border-radius: 12px;
    color: rgba(255,255,255,.9);
    font-weight: 600;
    text-decoration: none;
    background: none;
    border: none;
    text-align: left;
    cursor: pointer;
    transition: .25s;
}

.sidebar a:hover,
.sidebar a.active,
.sidebar button:hover {
    background: rgba(255,255,255,.18);
}

.sidebar .logout {
    color: #ffb4b4;
}

/* =========================
   MAIN
========================= */
.main {
    margin-left: 260px;
    min-height: 100vh;
}

/* =========================
   TOPBAR
========================= */
.topbar {
    background: #fff;
    padding: 16px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 6px 18px rgba(0,0,0,.08);
    position: sticky;
    top: 0;
    z-index: 200;
}

.menu-btn {
    display: none;
    font-size: 24px;
    background: none;
    border: none;
    cursor: pointer;
}

/* =========================
   CONTENT
========================= */
.content {
    padding: 32px;
}

.page-title {
    font-size: 28px;
    font-weight: 800;
}

.page-subtitle {
    margin-top: 6px;
    color: var(--muted);
    margin-bottom: 32px;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 24px;
}

.dashboard-card {
    background: var(--card);
    padding: 28px;
    border-radius: var(--radius);
    font-size: 17px;
    font-weight: 700;
    text-decoration: none;
    color: var(--text);
    box-shadow: 0 14px 35px rgba(0,0,0,.08);
    transition: .25s;
}

.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 45px rgba(0,0,0,.15);
}

/* =========================
   MOBILE
========================= */
@media (max-width: 900px) {

    .menu-btn { display: block; }

    .sidebar {
        transform: translateX(-100%);
        transition: transform .3s ease;
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .sidebar-close {
        display: block;
    }

    .main {
        margin-left: 0;
    }

    .overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.45);
        z-index: 250;
    }
}
</style>
</head>

<body x-data="{ sidebar:false }">

<!-- OVERLAY (MOBILE ONLY) -->
<div x-show="sidebar" x-cloak class="overlay" @click="sidebar=false"></div>

<!-- SIDEBAR -->
<aside class="sidebar" :class="{ 'show': sidebar }">
    <div class="sidebar-header">
        Dashboard
        <button class="sidebar-close" @click="sidebar=false">✕</button>
    </div>

    <a href="{{ route('dashboard') }}" class="active">🏠 Dashboard</a>
    <a href="{{ route('ordering.supplies') }}">📦 Orders</a>
    <a href="{{ route('proceed') }}">📝 Exams</a>
    <a href="{{ route('profile.edit') }}">👤 Profile</a>

    <form method="POST" action="{{ route('custom.logout') }}">
        @csrf
        <button class="logout">🚪 Logout</button>
    </form>
</aside>

<!-- MAIN -->
<div class="main">
    <header class="topbar">
        <button class="menu-btn" @click="sidebar=true">☰</button>
        <div>Hello, {{ ucwords(strtolower(Auth::user()->name)) }} 👋</div>
    </header>

    <main class="content">
        <h1 class="page-title">
            Welcome back, {{ ucwords(strtolower(Auth::user()->name)) }}
        </h1>
        <p class="page-subtitle">Choose a service to get started.</p>

        <div class="dashboard-grid">
            <a href="{{ route('ordering.supplies') }}" class="dashboard-card">
                📦 Ordering of Supplies
            </a>
            <a href="{{ route('proceed') }}" class="dashboard-card">
                📝 Take an Exam
            </a>
        </div>
    </main>
</div>

</body>
</html>
