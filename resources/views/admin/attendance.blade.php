<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Attendance Records</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        padding: 32px;
        max-width: calc(100vw - 260px);
    }

    /* ================= HEADER ================= */
    .page-header {
        background: #ffffff;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 16px 40px rgba(15,23,42,.08);
        margin-bottom: 26px;
    }

    .page-header h4 {
        font-weight: 800;
        margin-bottom: 0;
    }

    /* ================= CARDS ================= */
    .card {
        border-radius: 18px;
        box-shadow: 0 14px 34px rgba(15,23,42,.08);
        border: none;
    }

    /* ================= FORM LABEL ================= */
    .form-label {
        font-weight: 600;
        font-size: 13px;
        color: #374151;
    }

    /* ================= TABLE ================= */
    table {
        font-size: 14px;
    }

    thead {
        background: #1f2937;
        color: #fff;
    }

    th, td {
        vertical-align: middle;
        white-space: nowrap;
    }

    td img {
        max-height: 360px;
    }

    /* ================= BADGES ================= */
    .btn-selfie {
        font-size: 12px;
        padding: 4px 10px;
    }

    /* ================= RESPONSIVE (DESKTOP SAFE) ================= */
    @media (max-width: 1200px) {
        main {
            padding: 24px;
        }
    }
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4>
            <i class="fas fa-calendar-check me-2"></i>
            Attendance Records
        </h4>
        <span class="text-muted">
            Total Records: {{ $records->count() }}
        </span>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- FILTER & LOCATION -->
    <div class="card mb-4">
        <div class="card-body">

            <h6 class="fw-bold mb-3">
                <i class="fas fa-filter me-1"></i>
                Filters & Attendance Location
            </h6>

            <!-- FILTER -->
            <form id="filterForm" method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-md-3">
                    <label class="form-label">Filter by Date</label>
                    <input type="date" name="date" value="{{ $date ?? '' }}" class="form-control">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-dark w-100">
                        Apply Filter
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('admin.attendance') }}"
                       class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
            </form>

            <hr>

            <!-- LOCATION SETTINGS -->
            <form method="POST" action="{{ route('admin.attendance.location.update') }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Latitude</label>
                        <input type="number" step="0.0000001"
                               name="lat"
                               value="{{ $setting->lat ?? '' }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Longitude</label>
                        <input type="number" step="0.0000001"
                               name="lng"
                               value="{{ $setting->lng ?? '' }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Radius (meters)</label>
                        <input type="number"
                               name="radius"
                               value="{{ $setting->radius ?? 100 }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">
                            Save Location
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- EXPORT -->
    <div class="card mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="fas fa-file-excel me-1"></i>
                Export Attendance Report
            </h6>

            <form method="GET" action="{{ route('admin.attendance.export') }}" class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">From Date</label>
                    <input type="date" name="from" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">To Date</label>
                    <input type="date" name="to" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Morning In</label>
                    <input type="time" name="morning_required_in"
                           value="08:30" class="form-control">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Afternoon Out</label>
                    <input type="time" name="afternoon_required_out"
                           value="17:30" class="form-control">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Penalty (₱ / min)</label>
                    <input type="number" name="penalty"
                           value="3" min="0" class="form-control">
                </div>

                <div class="col-md-12">
                    <button class="btn btn-success w-100">
                        <i class="fas fa-download me-1"></i>
                        Export to Excel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>AM In</th>
                            <th>AM Out</th>
                            <th>PM In</th>
                            <th>PM Out</th>
                            <th>Selfies / Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($records as $a)
                        <tr>
                            <td>{{ $a->created_at->format('Y-m-d') }}</td>
                            <td class="fw-semibold">{{ $a->user->name }}</td>

                            <td>{{ optional($a->morning_in)->format('h:i A') ?? '—' }}</td>
                            <td>{{ optional($a->morning_out)->format('h:i A') ?? '—' }}</td>
                            <td>{{ optional($a->afternoon_in)->format('h:i A') ?? '—' }}</td>
                            <td>{{ optional($a->afternoon_out)->format('h:i A') ?? '—' }}</td>

                            <td>
                                <div class="d-flex flex-wrap gap-1">

                                    @foreach([
                                        'AM In' => $a->morning_in_selfie,
                                        'AM Out' => $a->morning_out_selfie,
                                        'PM In' => $a->afternoon_in_selfie,
                                        'PM Out' => $a->afternoon_out_selfie,
                                    ] as $label => $selfie)

                                        @if($selfie)
                                            <button class="btn btn-sm btn-primary btn-selfie"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#view{{ md5($label.$a->id) }}">
                                                {{ $label }}
                                            </button>

                                            <div class="modal fade"
                                                 id="view{{ md5($label.$a->id) }}"
                                                 tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                {{ $a->user->name }} – {{ $label }}
                                                            </h5>
                                                            <button class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/'.$selfie) }}"
                                                                 class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <form action="{{ route('admin.attendance.destroy', $a->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No attendance records found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
