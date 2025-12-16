<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { background: #f5f6fa; }
        .sidebar-link:hover { background: #1f2937 !important; }
        .sidebar-link { text-decoration: none; }
        aside { z-index: 999; }
        main { transition: margin-left 0.3s; }

        /* Dashboard Cards */
        .dash-card {
            border-radius: 12px;
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
        }
        .dash-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .dash-icon {
            font-size: 40px;
            opacity: .8;
        }
    </style>
</head>

<body x-data="{ open:false }">

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex align-items-center">

            <!-- MOBILE MENU BUTTON -->
            <button @click="open = !open" class="btn btn-outline-light d-md-none me-3">☰</button>

            <span class="navbar-brand fw-bold">📊 Admin Dashboard</span>

            <div class="ms-auto text-white me-3">
                {{ Auth::user()->name }}
            </div>

            <form method="POST" action="{{ route('custom.logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>

        </div>
    </nav>

    <!-- SIDEBAR -->
    @include('admin-sidebar.sidebar')

    <!-- MOBILE OVERLAY -->
    <div 
        class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none"
        x-show="open"
        @click="open = false"
        style="z-index: 998;">
    </div>

    <!-- MAIN CONTENT -->
    <main class="container mt-4" style="margin-left:260px;">

        <h2 class="mb-4">Welcome {{ Auth::user()->name }} 👋</h2>

        <p class="text-muted">Quick overview of your system modules:</p>

        <!-- 3 MAIN DASHBOARD MODULE CARDS -->
        <div class="row g-4 mt-2">

            <!-- APPLICATIONS -->
            <div class="col-md-4">
                <a href="{{ route('admin.application') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3">📁</div>
                        <h4 class="mb-1">Franchise Applications</h4>
                        <p class="text-muted mb-1">Total Records: 
                            <strong>{{ \App\Models\FranchiseApplication::count() }}</strong>
                        </p>
                        <p class="text-muted mb-0">New Today: 
                            <strong>{{ \App\Models\FranchiseApplication::whereDate('created_at', today())->count() }}</strong>
                        </p>
                    </div>
                </a>
            </div>

            <!-- SUPPLIES -->
            <div class="col-md-4">
                <a href="{{ route('admin.supplies') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3">📦</div>
                        <h4 class="mb-1">Supplies Orders</h4>
                        <p class="text-muted mb-0">Track orders and manage supply requests.</p>
                    </div>
                </a>
            </div>

            <!-- REQUIREMENTS -->
            <div class="col-md-4">
                <a href="{{ route('admin.requirements') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3">📄</div>
                        <h4 class="mb-1">Requirements Upload</h4>
                        <p class="text-muted mb-0">Manage uploaded franchise documents.</p>
                    </div>
                </a>
            </div>
            <!-- REQUIREMENTS -->
            <div class="col-md-4">
                <a href="{{ route('admin.users-account') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3">👥</div>
                        <h4 class="mb-1">Users Account</h4>
                        <p class="text-muted mb-0">Manage uploaded franchise documents.</p>
                    </div>
                </a>
            </div>
            <!-- REQUIREMENTS -->
            <div class="col-md-4">
                <a href="{{ route('admin.uploading-exams') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3">📝</div>
                        <h4 class="mb-1">Exams</h4>
                        <p class="text-muted mb-0">Manage uploaded franchise documents.</p>
                    </div>
                </a>
            </div>

        </div>

    </main>

</body>
</html>
