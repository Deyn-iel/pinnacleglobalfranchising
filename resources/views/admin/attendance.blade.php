<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Attendance Records</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite(['resources/css/admin/app.css'])

<style>
  :root{
    --sidebar-w: 260px;

    --bg: #f5f6fa;
    --text: #0f172a;
    --muted: #64748b;
    --border: rgba(15,23,42,.10);
    --card: rgba(255,255,255,.90);

    --shadow: 0 18px 45px rgba(15,23,42,.08);
    --shadow-hover: 0 28px 80px rgba(15,23,42,.16);

    --radius: 18px;
    --primary: #0d6efd;
    --primary-soft: rgba(13,110,253,.12);
  }

  body{
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    overflow-x: hidden;
    color: var(--text);
  }

  aside{ width: var(--sidebar-w); z-index: 1000; }

  main{
    margin-left: var(--sidebar-w);
    padding: clamp(16px, 2.2vw, 34px);
    max-width: calc(100vw - var(--sidebar-w));
    min-width: 0;
  }

  @media (max-width: 991.98px){
    main{
      margin-left: 0;
      max-width: 100%;
      padding: 16px;
    }
  }

  .page-header{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: clamp(16px, 2vw, 24px);
    box-shadow: var(--shadow);
    margin-bottom: 18px;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .page-header h4{
    font-weight: 900;
    margin-bottom: 0;
    letter-spacing: -.02em;
  }

  .page-sub{
    color: var(--muted);
    font-size: 13px;
  }

  .card{
    border-radius: 20px;
    background: var(--card);
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .card .card-body{ padding: clamp(14px, 1.6vw, 20px); }

  .section-title{
    font-weight: 900;
    letter-spacing: -.01em;
  }

  .form-label{
    font-weight: 700;
    font-size: 12.5px;
    color: #374151;
    margin-bottom: 6px;
  }

  .btn{ font-weight: 700; border-radius: 999px; }
  .btn-primary{ background: #0f172a; border: none; }
  .btn-primary:hover{ background:#111827; }

  .table-wrap{
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(15,23,42,.08);
  }
  .table-responsive{ overflow-x: auto; -webkit-overflow-scrolling: touch; }

  table{
    font-size: 14px;
    margin-bottom: 0;
    min-width: 980px;
  }

  thead{ background: #111827; color: #fff; }
  thead th{ position: sticky; top: 0; z-index: 1; }

  th, td{ vertical-align: middle; white-space: nowrap; }

  tbody tr{ transition: background .15s ease; }
  tbody tr:hover{ background: rgba(13,110,253,.05); }

  .btn-selfie{
    font-size: 12px;
    padding: 6px 12px;
    background: rgba(13,110,253,.12);
    color: var(--primary);
    border: 1px solid rgba(13,110,253,.18);
  }
  .btn-selfie:hover{
    background: rgba(13,110,253,.18);
    border-color: rgba(13,110,253,.25);
    color: var(--primary);
  }

  .selfie-img{
    width: 100%;
    max-height: min(75vh, 620px);
    object-fit: contain;
    border-radius: 14px;
    background: rgba(0,0,0,.03);
  }

  .alert{
    border-radius: 14px;
    border: 1px solid rgba(34,197,94,.25);
    box-shadow: 0 12px 30px rgba(15,23,42,.10);
  }

  .muted-pill{
    display:inline-flex; align-items:center; gap:8px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(15,23,42,.05);
    border: 1px solid rgba(15,23,42,.06);
    color: var(--muted);
    font-size: 12px;
    font-weight: 700;
  }

  .modal-backdrop{ z-index: 2000 !important; }
  .modal{ z-index: 2005 !important; }
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

  <!-- HEADER -->
  <div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
      <h4>
        <i class="fas fa-calendar-check me-2"></i>
        Attendance Records
      </h4>
      <div class="page-sub mt-1">View attendance logs, selfies, filters, and export reports.</div>
    </div>

    <span class="muted-pill">
      <i class="fa-solid fa-database"></i>
      Total Records: <strong class="text-dark">{{ $records->count() }}</strong>
    </span>
  </div>

  <!-- SUCCESS -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
      <i class="fa-solid fa-circle-check"></i>
      <div class="fw-semibold">{{ session('success') }}</div>
      <button class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- FILTER & LOCATION -->
  <div class="card mb-4">
    <div class="card-body">

      <h6 class="section-title mb-3">
        <i class="fas fa-filter me-1"></i>
        Filters & Attendance Location
      </h6>

      <!-- FILTER -->
      <form id="filterForm" method="GET" class="row g-3 align-items-end mb-4">
        <div class="col-12 col-md-4 col-lg-3">
          <label class="form-label">Filter by Date</label>
          <input type="date" name="date" value="{{ $date ?? '' }}" class="form-control">
        </div>

        <div class="col-6 col-md-4 col-lg-2 d-grid">
          <button class="btn btn-dark w-100">Apply Filter</button>
        </div>

        <div class="col-6 col-md-4 col-lg-2 d-grid">
          <a href="{{ route('admin.attendance') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
      </form>

      <hr class="my-3">

      <!-- LOCATION SETTINGS -->
      <form method="POST" action="{{ route('admin.attendance.location.update') }}">
        @csrf
        <div class="row g-3 align-items-end">
          <div class="col-12 col-md-6 col-lg-4">
            <label class="form-label">Latitude</label>
            <input type="number" step="0.0000001" name="lat"
                   value="{{ $setting->lat ?? '' }}" class="form-control" required>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <label class="form-label">Longitude</label>
            <input type="number" step="0.0000001" name="lng"
                   value="{{ $setting->lng ?? '' }}" class="form-control" required>
          </div>

          <div class="col-12 col-md-6 col-lg-2">
            <label class="form-label">Radius (meters)</label>
            <input type="number" name="radius"
                   value="{{ $setting->radius ?? 100 }}" class="form-control" required>
          </div>

          <div class="col-12 col-md-6 col-lg-2 d-grid">
            <button class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk me-1"></i> Save
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <!-- EXPORT -->
  <div class="card mb-4">
    <div class="card-body">
      <h6 class="section-title mb-3">
        <i class="fas fa-file-excel me-1"></i>
        Export Attendance Report
      </h6>

      <form method="GET" action="{{ route('admin.attendance.export') }}" class="row g-3">
        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">From Date</label>
          <input type="date" name="from" class="form-control" required>
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">To Date</label>
          <input type="date" name="to" class="form-control" required>
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">Morning In</label>
          <input type="time" name="morning_required_in" value="08:30" class="form-control">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">Afternoon Out</label>
          <input type="time" name="afternoon_required_out" value="17:30" class="form-control">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">Penalty (₱ / min)</label>
          <input type="number" name="penalty" value="3" min="0" class="form-control">
        </div>

        <div class="col-12 col-lg-2 d-grid">
          <button class="btn btn-success w-100">
            <i class="fas fa-download me-1"></i> Export
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- TABLE -->
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h6 class="section-title mb-0">
          <i class="fa-solid fa-table me-1"></i>
          Attendance Table
        </h6>
        <div class="text-muted small">Tip: scroll horizontally on small screens.</div>
      </div>

      <div class="table-wrap">
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
              @php
                $userName = optional($a->user)->name ?? 'Unknown';

                // safe time formatter kahit string
                $fmt = function ($t) {
                  if(!$t) return '—';
                  try { return \Carbon\Carbon::parse($t)->format('h:i A'); } catch (\Throwable $e) { return '—'; }
                };
              @endphp

              <tr>
                <td>{{ $a->created_at->format('Y-m-d') }}</td>
                <td class="fw-semibold">{{ $userName }}</td>

                <td>{{ $fmt($a->morning_in) }}</td>
                <td>{{ $fmt($a->morning_out) }}</td>
                <td>{{ $fmt($a->afternoon_in) }}</td>
                <td>{{ $fmt($a->afternoon_out) }}</td>

                <td>
                  <div class="d-flex flex-wrap gap-2">

                    @foreach([
                      'AM In'  => $a->morning_in_selfie,
                      'AM Out' => $a->morning_out_selfie,
                      'PM In'  => $a->afternoon_in_selfie,
                      'PM Out' => $a->afternoon_out_selfie,
                    ] as $label => $selfie)

                      @if($selfie)
                        <button
                          type="button"
                          class="btn btn-sm btn-selfie js-open-selfie"
                          data-bs-toggle="modal"
                          data-bs-target="#selfieModal"
                          data-title="{{ $userName }} – {{ $label }}"
                          data-src="{{ asset('storage/'.$selfie) }}"
                        >
                          {{ $label }}
                        </button>
                      @endif
                    @endforeach

                    <form action="{{ route('admin.attendance.destroy', $a->id) }}"
                          method="POST"
                          class="m-0"
                          onsubmit="return confirm('Delete this record?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger">Delete</button>
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
  </div>

</main>

<div class="modal fade" id="selfieModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selfieModalTitle">Selfie</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="selfieModalImg"src="{{ asset('storage/'.$selfie) }}"
                                     class="img-fluid rounded selfie-img"
                                     alt="Selfie">
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('click', function(e){
    const btn = e.target.closest('.js-open-selfie');
    if(!btn) return;

    const title = btn.getAttribute('data-title') || 'Selfie';
    const src   = btn.getAttribute('data-src') || '';

    document.getElementById('selfieModalTitle').textContent = title;
    document.getElementById('selfieModalImg').src = src;
  });

  // optional: clear image on close to avoid old flash
  const selfieModalEl = document.getElementById('selfieModal');
  selfieModalEl.addEventListener('hidden.bs.modal', () => {
    document.getElementById('selfieModalImg').src = '';
  });
</script>

</body>
</html>
