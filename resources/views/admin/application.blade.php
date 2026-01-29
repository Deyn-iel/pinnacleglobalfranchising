<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Dashboard</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite(['resources/css/admin/app.css'])

<style>
    body {
        background: #f5f6fa;
        overflow-x: hidden;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }

    aside {
        width: 260px;
        z-index: 999;
    }

    /* ================= MAIN ================= */
    main {
        margin-left: 260px;
        padding: clamp(20px, 2.5vw, 34px);
        max-width: calc(100vw - 260px);
    }

    /* ================= HEADER ================= */
    .page-header {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 12px 30px rgba(15,23,42,.08);
        margin-bottom: 26px;
    }

    /* ================= STATS ================= */
    .stat-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 12px 28px rgba(15,23,42,.08);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover {
        box-shadow: 0 18px 36px rgba(15,23,42,.12);
    }

    .stat-title {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
    }

    /* ================= TABLE ================= */
    .table-wrapper {
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 12px 30px rgba(15,23,42,.08);
    }

    table {
        margin-bottom: 0;
        font-size: 14px;
    }

    th {
        white-space: nowrap;
    }

    td {
        vertical-align: middle;
    }

    /* ================= BUTTONS ================= */
    .btn-primary {
        background: #000;
        border: none;
        font-weight: 600;
    }

    .btn-danger {
        font-weight: 600;
    }

    /* ================= SIDEBAR ================= */
    .sidebar-link {
        border-radius: 8px;
        transition: background 0.25s ease, padding-left 0.25s ease;
        text-decoration: none;
    }

    .sidebar-link:hover {
        background: rgba(255,255,255,0.1);
    }

    .sidebar-link.active {
        background: rgba(255,255,255,0.18);
        border-left: 4px solid #0d6efd;
        padding-left: 14px;
    }

    .sidebar-link.active i {
        color: #ffffff;
    }

    /* ================= ALERT ================= */
    .alert {
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .alert.fade:not(.show) {
        opacity: 0;
        transform: translateY(-10px);
    }
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- HEADER -->
    <div class="page-header">
        <h3 class="fw-bold mb-1">
            <i class="fas fa-chart-line me-2"></i>Admin Dashboard
        </h3>
        <p class="text-muted mb-0">
            Overview of franchise applications and recent activity.
        </p>
    </div>

    <!-- STATS -->
    <div class="row g-3 mb-4">

        <div class="col-lg-4">
            <div class="stat-card">
                <div class="stat-title">Total Applications</div>
                <div class="stat-value">
                    {{ \App\Models\FranchiseApplication::count() }}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="stat-card">
                <div class="stat-title">Submitted Today</div>
                <div class="stat-value">
                    {{ \App\Models\FranchiseApplication::whereDate('created_at', today())->count() }}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="stat-card">
                <div class="stat-title">Latest Applicant</div>
                <div class="fs-5 fw-semibold">
                    {{ optional(\App\Models\FranchiseApplication::latest()->first())->personal_full_name ?? 'No Data' }}
                </div>
            </div>
        </div>

    </div>

    @if(session('success'))
        <div id="uploadSuccessAlert"
             class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
             role="alert">
            <i class="fas fa-check-circle fs-5"></i>
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <!-- RECENT APPLICATIONS -->
    <h4 class="fw-bold mb-3">Recent Applications</h4>

    <div class="table-wrapper">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Lead Source</th>
                    <th>Date</th>
                    <th class="text-center" style="width:140px;">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse(\App\Models\FranchiseApplication::latest()->get() as $app)
                <tr>
                    <td>{{ $app->personal_full_name }}</td>
                    <td>{{ $app->email }}</td>
                    <td>{{ $app->lead_source }}</td>
                    <td>{{ $app->created_at->format('M d, Y') }}</td>
                    <td class="text-center d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.applications.show', $app->id) }}"
                           class="btn btn-primary btn-sm">
                            View
                        </a>

                        <form action="{{ route('admin.applications.destroy', $app->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this application?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        No applications submitted yet.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const alertBox = document.getElementById("uploadSuccessAlert");

    if (alertBox) {
        setTimeout(() => {
            alertBox.classList.remove("show");
            alertBox.classList.add("fade");

            setTimeout(() => {
                alertBox.remove();
            }, 600);
        }, 2500);
    }
});
</script>

</body>
</html>
