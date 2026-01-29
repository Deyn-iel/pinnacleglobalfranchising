<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Dashboard</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite(['resources/css/admin/app.css'])

<style>
    body {
        background: #f5f6fa;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
        overflow-x: hidden;
    }

    aside {
        width: 260px;
        z-index: 999;
    }

    /* ================= MAIN LAYOUT ================= */
    main {
        margin-left: 260px;
        padding: clamp(20px, 2vw, 36px);
        max-width: calc(100vw - 260px);
        transition: margin-left .3s ease;
    }

    /* ================= HEADER ================= */
    .dashboard-header {
        background: #ffffff;
        border-radius: 18px;
        padding: 26px 30px;
        box-shadow: 0 18px 40px rgba(15,23,42,.08);
        margin-bottom: 32px;
    }

    .dashboard-header h2 {
        font-weight: 800;
        margin-bottom: 6px;
    }

    /* ================= DASHBOARD CARDS ================= */
    .dash-card {
        border-radius: 20px;
        padding: 26px;
        background: #ffffff;
        height: 100%;
        box-shadow: 0 18px 38px rgba(15,23,42,.08);
        transition: transform .25s ease, box-shadow .25s ease;
        position: relative;
        overflow: hidden;
    }

    .dash-card::after {
        content: "";
        position: absolute;
        inset: auto -40% -60% -40%;
        height: 140%;
        background: radial-gradient(circle at bottom,
            rgba(13,110,253,.08),
            transparent 60%);
        pointer-events: none;
    }

    .dash-card:hover {
        box-shadow: 0 28px 60px rgba(15,23,42,.18);
    }

    .dash-icon {
        font-size: 42px;
        color: #000000;
        margin-bottom: 16px;
        opacity: .9;
    }

    .dash-card h4 {
        font-weight: 700;
        margin-bottom: 6px;
    }

    .dash-card p {
        font-size: 14px;
        margin-bottom: 0;
    }

    a.dash-link {
        text-decoration: none;
        color: inherit;
    }

    /* ================= RESPONSIVE (DESKTOP FIRST) ================= */
    @media (max-width: 1200px) {
        .dash-icon { font-size: 36px; }
    }

    @media (max-width: 991px) {
        main {
            margin-left: 0;
            max-width: 100%;
        }
    }
</style>
</head>

<body x-data="{ open:false }">

<!-- NAV -->
@include('admin-sidebar.navbar')

<!-- SIDEBAR -->
@include('admin-sidebar.sidebar')

<!-- MOBILE OVERLAY -->
<div class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none"
     x-show="open"
     @click="open = false"
     style="z-index:998"></div>

<!-- MAIN CONTENT -->
<main>

    <!-- HEADER -->
    <div class="dashboard-header">
        <h2>
            Welcome, {{ Auth::user()->name }}
            <i class="fas fa-rocket text-primary ms-2"></i>
        </h2>
        <p class="text-muted mb-0">
            Quick overview of your system modules
        </p>
    </div>

    <!-- DASHBOARD MODULES -->
    <div class="row g-4">

        <!-- APPLICATIONS -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.application') }}" class="dash-link">
                <div class="dash-card">
                    <div class="dash-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h4>Franchise Applications</h4>
                    <p class="text-muted">
                        Total:
                        <strong>{{ \App\Models\FranchiseApplication::count() }}</strong>
                    </p>
                    <p class="text-muted">
                        New Today:
                        <strong>{{ \App\Models\FranchiseApplication::whereDate('created_at', today())->count() }}</strong>
                    </p>
                </div>
            </a>
        </div>

        <!-- SUPPLIES -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.supplies') }}" class="dash-link">
                <div class="dash-card">
                    <div class="dash-icon">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <h4>Supplies</h4>
                    <p class="text-muted">
                        Total Supplies:
                        <strong>{{ \App\Models\Supply::count() }}</strong>
                    </p>
                    <p class="text-muted">Manage inventory & orders</p>
                </div>
            </a>
        </div>

        <!-- USERS -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.users-account') }}" class="dash-link">
                <div class="dash-card">
                    <div class="dash-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>User Accounts</h4>
                    <p class="text-muted">Manage system users</p>
                </div>
            </a>
        </div>

        <!-- EXAMS -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.uploading-exams') }}" class="dash-link">
                <div class="dash-card">
                    <div class="dash-icon">
                        <i class="fas fa-file-pen"></i>
                    </div>
                    <h4>Exams</h4>
                    <p class="text-muted">Create & manage exams</p>
                </div>
            </a>
        </div>

        <!-- REQUIREMENTS -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.requirements') }}" class="dash-link">
                <div class="dash-card">
                    <div class="dash-icon">
                        <i class="fas fa-file-lines"></i>
                    </div>
                    <h4>Requirements</h4>
                    <p class="text-muted">Uploaded requirements</p>
                </div>
            </a>
        </div>

        <!-- CONTACTS -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.contacts') }}" class="dash-link">
                <div class="dash-card">
                    <div class="dash-icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <h4>Contacts</h4>
                    <p class="text-muted">User inquiries & messages</p>
                </div>
            </a>
        </div>

        <!-- PROFILE -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('admin.admin-profile.edit') }}" class="dash-link">
                <div class="dash-card">
                    <div class="dash-icon">
                        <i class="fas fa-user-gear"></i>
                    </div>
                    <h4>Profile Settings</h4>
                    <p class="text-muted">Update your admin profile</p>
                </div>
            </a>
        </div>

    </div>

</main>

</body>
</html>
