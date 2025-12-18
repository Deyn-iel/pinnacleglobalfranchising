<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
/* ================= RESET ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

body {
    background: #f4f6f9;
    overflow-x: hidden;
    
}

/* ================= MODERN LOGIN OVERLAY ================= */
.login-overlay {
    position: fixed;
    inset: 0;
    background: linear-gradient(
        135deg,
        #0d3553 0%,
        #0a2a44 50%,
        #071f33 100%
    );
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 99999;

    opacity: 1;
    transition: opacity 0.6s ease;
}

/* Fade-out state */
.login-overlay.fade-out {
    opacity: 0;
    pointer-events: none;
}

/* LOGIN BOX */
.login-box {
    color: #ffffff;
    text-align: center;
    padding: 40px 46px;
    border-radius: 18px;

    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    animation: popIn 0.6s ease;
}

/* ICON */
.login-box i {
    font-size: 58px;
    margin-bottom: 18px;
    color: #ffffff;

    animation: pulseGlow 1.6s ease-in-out infinite;
}

/* TEXT */
.login-box h2 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 6px;
    letter-spacing: 0.3px;
}

.login-box p {
    font-size: 14px;
    opacity: 0.85;
    letter-spacing: 0.4px;
}

/* ================= ANIMATIONS ================= */
@keyframes popIn {
    from {
        opacity: 0;
        transform: scale(0.92) translateY(10px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes pulseGlow {
    0% {
        transform: scale(1);
        text-shadow: 0 0 0 rgba(255,255,255,0);
    }
    50% {
        transform: scale(1.15);
        text-shadow: 0 0 25px rgba(255,255,255,0.35);
    }
    100% {
        transform: scale(1);
        text-shadow: 0 0 0 rgba(255,255,255,0);
    }
}

/* ================= LOGOUT FADE ANIMATION ================= */
.login-overlay {
    opacity: 1;
    transition: opacity 0.6s ease;
}

.login-overlay.fade-out {
    opacity: 0;
    pointer-events: none;
}



/* ================= LAYOUT ================= */
.wrapper {
    display: flex;
    min-height: 100vh;
}

/* ================= SIDEBAR ================= */
.sidebar {
    width: 260px;
    background: #0d3553;
    color: #fff;
    position: fixed;
    height: 100%;
}

.sidebar ul {
    list-style: none;
    margin-top: 20px;
}

.sidebar ul li {
    padding: 14px 22px;
    display: flex;
    align-items: center; /* 🔥 ALIGN FIX */
    gap: 15px;
    cursor: pointer;
}

.sidebar ul li:hover {
    background: rgba(255,255,255,0.1);
}

/* ================= LOGOUT FIX ================= */

/* Remove default form behavior */
.logout-item form {
    width: 100%;
    display: flex;          /* 🔥 IMPORTANT */
    align-items: center;
}

/* Button behaves EXACTLY like <li> content */
.logout-btn {
    background: none;
    border: none;
    outline: none;

    width: 100%;
    display: flex;
    align-items: center;
    gap: 15px;

    color: #fff;
    font-size: 15px;
    cursor: pointer;

    transition: opacity 0.3s ease; /* ✅ ANIMATION WORKS */
}

.logout-btn.fading {
    opacity: 0.4;
    pointer-events: none;
}

.logout-item:hover {
    background: rgba(255,255,255,0.1);
}

/* Icon alignment same as others */
.logout-btn i {
    min-width: 22px;
    text-align: center;
}


/* ================= MAIN ================= */
.main {
    margin-left: 260px;
    width: 100%;
}

/* ================= TOPBAR ================= */
.topbar {
    height: 65px;
    background: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.menu-btn {
    font-size: 22px;
    color: #0d3553;
    cursor: pointer;
    display: none;
}

/* PROFILE RIGHT */
.profile {
    margin-left: auto; /* 🔥 ITO ANG IMPORTANTE */
    display: flex;
    align-items: center;
    gap: 12px;
}

.profile span {
    font-weight: 500;
    color: #333;
}

.profile img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: 2px solid #0d3553;
}

/* ================= CONTENT ================= */
.content {
    padding: 25px;
}

/* ================= CARDS ================= */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.card {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.card h4 {
    color: #777;
    font-size: 14px;
}

.card h2 {
    color: #0d3553;
    font-size: 28px;
    margin-top: 6px;
}

/* ================= SECTIONS ================= */
.sections {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-top: 25px;
}

/* ================= ACTIVITY (REDESIGNED) ================= */
.activity {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.activity h3 {
    margin-bottom: 15px;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 34px;
    height: 34px;
    background: #0d3553;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.activity-content p {
    font-size: 14px;
    margin-bottom: 4px;
}

.activity-content span {
    font-size: 12px;
    color: #888;
}

/* ================= PROFILE CARD ================= */
.profile-card {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    text-align: center;
}

.profile-card img {
    width: 90px;
    border-radius: 50%;
}

.progress {
    height: 8px;
    background: #eee;
    border-radius: 5px;
    overflow: hidden;
    margin-top: 12px;
}

.progress span {
    display: block;
    height: 100%;
    background: #0d3553;
    width: 70%;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
    .sections {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .menu-btn {
        display: block;
    }

    .sidebar {
        left: -260px;
        transition: 0.3s;
    }

    .sidebar.show {
        left: 0;
    }

    .main {
        margin-left: 0;
    }
}
.sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 20px;
    background: rgba(0,0,0,0.15);
}

.close-btn {
    font-size: 22px;
    cursor: pointer;
    display: none;
}

/* SHOW X BUTTON ONLY ON MOBILE */
@media (max-width: 768px) {
    .close-btn {
        display: block;
    }
}

</style>
</head>

<body>

<!-- LOGIN OVERLAY -->
<div class="login-overlay" id="loginOverlay">
    <div class="login-box">
        <i class="fas fa-user-check"></i>
        <h2>Welcome, {{ ucwords(strtolower(Auth::user()->name)) }}!</h2>
        <p>Loading dashboard...</p>
    </div>
</div>

<div class="wrapper">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <span class="logo-text">MyDashboard</span>
            <i class="fas fa-times close-btn" id="closeSidebar"></i>
        </div>

        <ul>
            <li><i class="fas fa-home"></i>Dashboard</li>
            <li>
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-cog"></i>
                Profile
            </a>
            </li>

            <li><i class="fas fa-chart-line"></i>Analytics</li>
            <li><i class="fas fa-bell"></i>Notifications</li>
            <li><i class="fas fa-cog"></i>Settings</li>

            <!-- LOGOUT (SAME DESIGN AS OTHERS) -->
            <li class="logout-item">
            <form method="POST" action="{{ route('custom.logout') }}" onsubmit="handleLogout(event)">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </li>

            
        </ul>
    </aside>


    <div class="main">
        <div class="topbar">
            <i class="fas fa-bars menu-btn" id="menuBtn"></i>

            <!-- RIGHT SIDE -->
            <div class="profile">
                <span>Hi, {{ ucwords(strtolower(Auth::user()->name)) }}</span>
                <img src="https://i.pravatar.cc/150?img=3">
            </div>
        </div>

        <div class="content">
            <div class="cards">
                <div class="card"><h4>Active Users</h4><h2>1,245</h2></div>
                <div class="card"><h4>Pending Tasks</h4><h2>18</h2></div>
                <div class="card"><h4>Notifications</h4><h2>5</h2></div>
                <div class="card"><h4>Status</h4><h2>Online</h2></div>
            </div>

            <div class="sections">
                <!-- ACTIVITY -->
                <div class="activity">
                    <h3>Recent Activity</h3>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-sign-in-alt"></i></div>
                        <div class="activity-content">
                            <p>Logged in successfully</p>
                            <span>Just now</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-user-edit"></i></div>
                        <div class="activity-content">
                            <p>Updated profile information</p>
                            <span>10 minutes ago</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="activity-content">
                            <p>Completed a task</p>
                            <span>1 hour ago</span>
                        </div>
                    </div>
                </div>

                <!-- PROFILE -->
                <div class="profile-card">
                    <img src="https://i.pravatar.cc/150?img=5">
                    <h3>{{ ucwords(strtolower(Auth::user()->name)) }}</h3>
                    <p>Active Member</p>
                    <div class="progress"><span></span></div>
                    <small>Profile Completion: 70%</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const sidebar = document.getElementById("sidebar");
const menuBtn = document.getElementById("menuBtn");
const closeSidebar = document.getElementById("closeSidebar");
const loginOverlay = document.getElementById("loginOverlay");

/* SIDEBAR TOGGLE (MOBILE) */
menuBtn.onclick = () => sidebar.classList.toggle("show");
closeSidebar.onclick = () => sidebar.classList.remove("show");

/* ================= LOGIN ANIMATION ================= */
/*
  Lalabas lang:
  - kapag bagong login
  Hindi lalabas:
  - kapag refresh lang
*/
/* ================= LOGIN ANIMATION (WITH FADE) ================= */
if (localStorage.getItem("hasLoggedIn")) {
    loginOverlay.style.display = "none";
} else {
    // wait before fading
    setTimeout(() => {
        loginOverlay.classList.add("fade-out");
    }, 2000); // bago mag-fade

    // after fade animation
    setTimeout(() => {
        loginOverlay.style.display = "none";
        localStorage.setItem("hasLoggedIn", "true");
    }, 2800); // fade duration included
}


/* ================= LOGOUT HANDLER ================= */
/*
  Tatawagin ito ng logout FORM
  para sa next login, may animation ulit
*/
function handleLogout(event) {
    event.preventDefault(); // stop instant submit

    const logoutItem = event.target.closest(".logout-item");
    const form = event.target;

    // trigger fade
    logoutItem.classList.add("fading");

    // clear login animation flag
    localStorage.removeItem("hasLoggedIn");

    // submit AFTER fade finishes
    setTimeout(() => {
        form.submit();
    }, 300);
}

</script>


</body>
</html>

{{-- <!doctype html>
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
</html> --}}
