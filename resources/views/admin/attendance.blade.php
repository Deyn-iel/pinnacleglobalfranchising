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
        body { background: #f5f6fa; }
        main { margin-left: 260px; padding: 30px; overflow: hidden; }
        @media (max-width: 768px) { main { margin-left: 0; } }
        .table thead { background: #1f2937; color: #fff;}
        .form-label {
    font-weight: 500;
    color: #374151;
    padding-left: 10px;
}


    </style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">
            <i class="fas fa-calendar-check me-2"></i> Attendance Records
        </h4>
        <span class="text-muted small">
            Total: {{ $records->count() }}
        </span>
    </div>

    {{-- DATE FILTER --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-3">
            <input
                type="date"
                name="date"
                value="{{ $date ?? '' }}"
                class="form-control"
            >
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('admin.attendance') }}"
               class="btn btn-secondary w-100">
                Reset
            </a>
        </div>
    </form>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="GET"
                    action="{{ route('admin.attendance.export') }}"
                    class="row g-2 mb-4">

                    <div class="col-md-2">
                        <label class="form-label small mb-1">From Date</label>
                        <input type="date"
                            name="from"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small mb-1">To Date</label>
                        <input type="date"
                            name="to"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small mb-1">Morning Time In</label>
                        <input type="time"
                            name="morning_required_in"
                            value="08:30"
                            class="form-control"
                            title="Morning Time In">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small mb-1">Afternoon Time Out</label>
                        <input type="time"
                            name="afternoon_required_out"
                            value="17:30"
                            class="form-control"
                            title="Afternoon Time Out">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small mb-1">Penalty (₱ / minute)</label>
                        <input type="number"
                            name="penalty"
                            value="3"
                            min="0"
                            class="form-control"
                            title="Salary deduction per minute">
                    </div>


                    <div class="col-md-12">
                        <button class="btn btn-success w-100">
                            <i class="fas fa-file-excel me-1"></i>
                            Export to Excel
                        </button>
                    </div>

                </form>
    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">

                



                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Morning In</th>
                            <th>Morning Out</th>
                            <th>Afternoon In</th>
                            <th>Afternoon Out</th>
                            <th>Selfies</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($records as $a)
                        <tr>
                            {{-- DATE --}}
                            <td class="text-nowrap">
                                {{ $a->created_at->format('Y-m-d') }}
                            </td>

                            {{-- USER --}}
                            <td class="fw-semibold">
                                {{ $a->user->name }}
                            </td>

                            {{-- TIMES --}}
                            <td>{{ optional($a->morning_in)->format('h:i A') ?? '—' }}</td>
                            <td>{{ optional($a->morning_out)->format('h:i A') ?? '—' }}</td>
                            <td>{{ optional($a->afternoon_in)->format('h:i A') ?? '—' }}</td>
                            <td>{{ optional($a->afternoon_out)->format('h:i A') ?? '—' }}</td>

                            {{-- SELFIES --}}
                            <td>
                                <div class="d-flex flex-wrap gap-1">

                                    @foreach([
                                        'AM In' => $a->morning_in_selfie,
                                        'AM Out' => $a->morning_out_selfie,
                                        'PM In' => $a->afternoon_in_selfie,
                                        'PM Out' => $a->afternoon_out_selfie,
                                    ] as $label => $selfie)

                                        @if($selfie)
                                            <button class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#view{{ md5($label.$a->id) }}">
                                                {{ $label }}
                                            </button>

                                            {{-- MODAL --}}
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

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.attendance.destroy', $a->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this attendance record?')">
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
                            <td colspan="7"
                                class="text-center text-muted py-4">
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
