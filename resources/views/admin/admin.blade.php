<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite([
    'resources/css/admin/app.css'
])

<style>
/* ================= RESPONSIVE FIX ================= */

/* MAIN CONTENT */
main {
    transition: margin-left 0.3s ease;
}
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
/* TABLET & BELOW */
@media (max-width: 991px) {
    main {
        margin-left: 0 !important;
        padding-left: 12px;
        padding-right: 12px;
    }
}

/* MOBILE */
@media (max-width: 576px) {
    h2 {
        font-size: 1.3rem;
    }

    .dash-card {
        padding: 20px !important;
    }

    .dash-icon {
        font-size: 32px;
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
    <div 
        class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none"
        x-show="open"
        @click="open = false"
        style="z-index: 998;">
    </div>

    <!-- MAIN CONTENT -->
    <main class="container mt-4" style="margin-left:260px;">

        <h2 class="mb-4">Welcome {{ Auth::user()->name }} <i class="fas fa-rocket"></i>
</h2>

        <p class="text-muted">Quick overview of your system modules:</p>

        <!-- 3 MAIN DASHBOARD MODULE CARDS -->
        <div class="row g-4 mt-2">

            {{-- <!-- ATTENDANCE -->
            <div class="col-md-4">
                <a href="{{ route('admin.attendance') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3"><i class="fas fa-calendar-check me-2"></i></div>
                        <h4 class="mb-1">Attendance Records</h4>
                        <p class="text-muted mb-1">Total Records: 
                            <strong>{{ \App\Models\Attendance::count() }}</strong>
                        </p>
                    </div>
                </a>
            </div> --}}

            <!-- APPLICATIONS -->
            <div class="col-md-4">
                <a href="{{ route('admin.application') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3"><i class="fas fa-folder-open me-2"></i></div>
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
                        <div class="dash-icon mb-3"><i class="fas fa-boxes-stacked me-2"></i></div>
                        <h4 class="mb-1">Supplies Orders</h4>
                        <p class="text-muted mb-0">Track orders and manage supply requests.</p>
                        <p class="text-muted mb-0">Total Supplies: 
                            <strong>{{ \App\Models\Supply::count() }}</strong>
                    </div>
                </a>
            </div>

            <!-- Profile -->
            <div class="col-md-4">
                <a href="{{ route('admin.admin-profile.edit') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3"><i class="fas fa-user-gear"></i></div>
                        <h4 class="mb-1">Profile</h4>
                        <p class="text-muted mb-0">Profile settings.</p>
                    </div>
                </a>
            </div>

            <!-- REQUIREMENTS -->
            <div class="col-md-4">
                <a href="{{ route('admin.requirements') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3"><i class="fas fa-file-lines me-2"></i></div>
                        <h4 class="mb-1">Requirements Upload</h4>
                        <p class="text-muted mb-0">Manage Requirements uploaded.</p>
                    </div>
                </a>
            </div>
            <!-- CONTACTS -->
            <div class="col-md-4">
                <a href="{{ route('admin.contacts') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3"><i class="fas fa-address-book me-2"></i></div>
                        <h4 class="mb-1">Contacts</h4>
                        <p class="text-muted mb-0">Manage Contacts.</p>
                    </div>
                </a>
            </div>
            <!-- REQUIREMENTS -->
            <div class="col-md-4">
                <a href="{{ route('admin.users-account') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3"><i class="fas fa-users me-2"></i></div>
                        <h4 class="mb-1">Users Account</h4>
                        <p class="text-muted mb-0">Manage Users account.</p>
                    </div>
                </a>
            </div>
            <!-- EXAMS -->
            <div class="col-md-4">
                <a href="{{ route('admin.uploading-exams') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4 dash-card">
                        <div class="dash-icon mb-3"><i class="fas fa-file-pen me-2"></i></div>
                        <h4 class="mb-1">Exams</h4>
                        <p class="text-muted mb-0">Manage Exams.</p>
                    </div>
                </a>
            </div>

        </div>

    </main>

</body>
</html>
