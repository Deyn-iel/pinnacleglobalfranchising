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
    </style>
</head>

<body x-data="{ open:false }">

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex align-items-center">

            <!-- MENU BUTTON FOR MOBILE -->
            <button @click="open = !open" class="btn btn-outline-light d-md-none me-3">
                ☰
            </button>

            <span class="navbar-brand fw-bold">
                📊 Admin Dashboard
            </span>

            <div class="ms-auto text-white me-3">
                {{ Auth::user()->name }}
            </div>

            <!-- Logout -->
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
        style="z-index: 998;"
    ></div>

    <!-- MAIN CONTENT -->
    <main class="container mt-4" style="margin-left:260px;">

        <h2 class="mb-4">Admin Application</h2>

        <!-- DASHBOARD STAT CARDS -->
        <div class="row g-3">

            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h5>Total Applications</h5>
                    <h2>{{ \App\Models\FranchiseApplication::count() }}</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h5>Submitted Today</h5>
                    <h2>{{ \App\Models\FranchiseApplication::whereDate('created_at', today())->count() }}</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h5>Latest Applicant</h5>
                    <p class="fs-5 mb-0">
                        {{ optional(\App\Models\FranchiseApplication::latest()->first())->personal_full_name ?? 'No Data' }}
                    </p>
                </div>
            </div>

        </div>

        <hr class="my-4">

        <!-- RECENT APPLICATIONS TABLE -->
        <h3 class="mb-3">Recent Applications</h3>

        <table class="table table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Lead Source</th>
                    <th>Date</th>
                    <th width="100"></th>
                </tr>
            </thead>

            <tbody>
            @forelse(\App\Models\FranchiseApplication::latest()->get() as $app)
                <tr>
                    <td>{{ $app->id }}</td>
                    <td>{{ $app->personal_full_name }}</td>
                    <td>{{ $app->email }}</td>
                    <td>{{ $app->lead_source }}</td>
                    <td>{{ $app->created_at->format('M d, Y') }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.applications.show', $app->id) }}"
                        class="btn btn-primary btn-sm">
                            View
                        </a>

                        <form action="{{ route('admin.applications.destroy', $app->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this application?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i>No applications submitted yet.</i>
                    </td>
                </tr>
            @endforelse
        </tbody>

        </table>
    </main>

</body>
</html>
