<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HR · Dashboard</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


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
    --radius: 18px;
  }

  body{
    background:
      radial-gradient(1200px 650px at 18% 0%, rgba(13,110,253,.08), transparent 55%),
      radial-gradient(900px 520px at 95% 10%, rgba(34,197,94,.07), transparent 55%),
      var(--bg);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    overflow-x: hidden;
    color: var(--text);
  }

  aside{ width: var(--sidebar-w); z-index: 999; }

  main{
    margin-left: var(--sidebar-w);
    padding: clamp(16px, 2.2vw, 34px);
    max-width: calc(100vw - var(--sidebar-w));
    min-width: 0;
    transition: margin-left .3s ease;
  }

  @media (max-width: 991.98px){
    main{ margin-left: 0; max-width: 100%; padding: 16px; }
  }

  .dashboard-header{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: clamp(16px, 2vw, 24px);
    box-shadow: var(--shadow);
    margin-bottom: 16px;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }
  .dashboard-header::after{
    content:"";
    position:absolute;
    right:-90px; top:-90px;
    width: 260px; height: 260px;
    background: radial-gradient(circle, rgba(13,110,253,.18), transparent 60%);
    pointer-events:none;
  }
  .dashboard-header h2{
    font-weight: 900;
    letter-spacing: -.02em;
    margin-bottom: 6px;
  }
  .dashboard-header p{ margin: 0; color: var(--muted); }

  .stat-card{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 18px;
    box-shadow: var(--shadow);
    height: 100%;
    backdrop-filter: blur(10px);
  }
  .stat-title{ font-size: 12.5px; font-weight: 800; color: var(--muted); }
  .stat-value{ font-size: 28px; font-weight: 900; color: var(--text); }
  .stat-icon{
    width: 44px; height: 44px;
    border-radius: 14px;
    display:grid; place-items:center;
    background: rgba(13,110,253,.10);
    border: 1px solid rgba(13,110,253,.14);
    color: #0f172a;
  }

  .panel{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: clamp(16px, 2vw, 22px);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
  }

  .panel-title{
    font-weight: 900;
    letter-spacing: -.01em;
    margin-bottom: 4px;
  }
  .panel-sub{ color: var(--muted); font-size: 13px; margin: 0; }

  .form-label{
    font-weight: 800;
    font-size: 12.5px;
    color: #374151;
    margin-bottom: 6px;
  }
  .form-control, .form-select{
    border-radius: 14px;
    border: 1px solid rgba(15,23,42,.12);
    padding: 10px 12px;
    font-size: 14px;
  }
  .form-control:focus, .form-select:focus{
    border-color: rgba(13,110,253,.45);
    box-shadow: 0 0 0 4px rgba(13,110,253,.14);
  }

  .btn{ font-weight: 900; border-radius: 999px; }

  .folder-card{
    background: rgba(255,255,255,.85);
    border: 1px solid rgba(15,23,42,.10);
    border-radius: 18px;
    padding: 16px;
    box-shadow: 0 14px 34px rgba(15,23,42,.07);
    transition: transform .15s ease, box-shadow .15s ease;
    height: 100%;
  }
  .folder-card:hover{
    transform: translateY(-2px);
    box-shadow: 0 20px 48px rgba(15,23,42,.12);
  }
  .folder-top{ display:flex; align-items:flex-start; justify-content: space-between; gap: 10px; margin-bottom: 8px; }
  .folder-ico{
    width: 46px; height: 46px;
    border-radius: 16px;
    display:grid; place-items:center;
    background: rgba(245,158,11,.14);
    border: 1px solid rgba(245,158,11,.22);
  }
  .folder-name{ font-weight: 900; margin: 0; line-height: 1.15; }
  .folder-meta{ color: var(--muted); font-size: 12.5px; margin: 0; }

  .table-wrapper{
    background: rgba(255,255,255,.85);
    border: 1px solid rgba(15,23,42,.10);
    border-radius: 18px;
    overflow: hidden;
  }
  .table-responsive{ overflow-x:auto; -webkit-overflow-scrolling: touch; }
  table{ margin-bottom:0; font-size: 14px; min-width: 880px; }
  th{ white-space:nowrap; }
  .table-hover tbody tr:hover{ background: rgba(13,110,253,.05); }

  .soft-alert{
    border-radius: 14px;
    border: 1px solid rgba(15,23,42,.10);
    box-shadow: 0 12px 28px rgba(15,23,42,.08);
  }

  
</style>
</head>

@php
  use Illuminate\Support\Facades\Route;

  $hasStore = Route::has('hr.payslips.store');
  $hasIndex = Route::has('hr.payslips.index');
  $hasDownload = Route::has('hr.payslips.download');
  $hasDestroy = Route::has('hr.payslips.destroy');

  $folders = $folders ?? [];
  $recentPayslips = $recentPayslips ?? collect();
@endphp

<body x-data="{
  open:false,
  month: '{{ old('month', now()->format('m')) }}',
  year: '{{ old('year', now()->format('Y')) }}',
  get folderLabel(){ 
    const m = String(this.month).padStart(2,'0');
    return `${this.year}-${m}`;
  }
}">

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<div class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none"
     x-show="open"
     @click="open = false"
     style="z-index:998"></div>

<main>

  <div class="dashboard-header d-flex align-items-start justify-content-between flex-wrap gap-2">
    <div>
      <h2 class="mb-1">
        Welcome, {{ Auth::user()->name }}
        <i class="fas fa-user-check ms-1"></i>
      </h2>
      <p class="text-muted mb-0">HR Dashboard — Payroll & Payslip Management</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
      <span class="badge rounded-pill text-bg-dark px-3 py-2">
        <i class="fa-solid fa-calendar me-1"></i>
        {{ now()->format('M d, Y') }}
      </span>
      <span class="badge rounded-pill text-bg-primary px-3 py-2">
        <i class="fa-solid fa-shield-check me-1"></i>
        HR Access
      </span>
    </div>
  </div>

  <div class="row g-3 mb-3">
    <div class="col-12 col-md-4">
      <div class="stat-card d-flex align-items-center justify-content-between gap-3">
        <div>
          <div class="stat-title">This Month Folder</div>
          <div class="stat-value">{{ now()->format('Y-m') }}</div>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-folder-open"></i></div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="stat-card d-flex align-items-center justify-content-between gap-3">
        <div>
          <div class="stat-title">Payslips (Example)</div>
          <div class="stat-value">{{ $payslipsCount ?? '—' }}</div>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-receipt"></i></div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="stat-card d-flex align-items-center justify-content-between gap-3">
        <div>
          <div class="stat-title">Employees (Example)</div>
          <div class="stat-value">{{ $employeesCount ?? '—' }}</div>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
      </div>
    </div>
  </div>

  @if(!$hasStore)
    <div class="alert alert-warning soft-alert d-flex align-items-start gap-2 mb-3" role="alert">
      <i class="fa-solid fa-triangle-exclamation mt-1"></i>
      <div>
        <div class="fw-bold">Heads up: Payslip upload route is not yet created.</div>
        <div class="small text-muted">
          Create route name <code>hr.payslips.store</code> to enable uploading. (UI is ready.)
        </div>
      </div>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success soft-alert d-flex align-items-center gap-2 mb-3" role="alert" id="successAlert">
      <i class="fa-solid fa-circle-check"></i>
      <div class="fw-semibold">{{ session('success') }}</div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger soft-alert mb-3">
      <div class="fw-bold mb-1">Please fix the following:</div>
      <ul class="mb-0 small">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row g-3 mb-3">

    <div class="col-12 col-lg-5">
      <div class="panel h-100">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <div>
            <div class="panel-title">
              <i class="fa-solid fa-cloud-arrow-up me-2"></i>
              Upload Payslips
            </div>
            <p class="panel-sub">Upload multiple payslip files under a Month/Year folder.</p>
          </div>
          <span class="badge rounded-pill text-bg-warning text-dark px-3 py-2">
            Folder: <span class="fw-bold" x-text="folderLabel"></span>
          </span>
        </div>

        <form action="{{ route('hr.payslips.store') }}"
      method="POST"
      enctype="multipart/form-data">
  @csrf

  <div class="row g-3">
    <div class="col-6">
      <label class="form-label">Month *</label>
      <select name="month" class="form-select" required>
        @foreach(range(1,12) as $m)
          <option value="{{ $m }}">
            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-6">
      <label class="form-label">Year *</label>
      <select name="year" class="form-select" required>
        @for($y = now()->year; $y >= now()->year - 6; $y--)
          <option value="{{ $y }}">{{ $y }}</option>
        @endfor
      </select>
    </div>

    <div class="col-12">
      <label class="form-label">Payroll Batch Name (optional)</label>
      <input type="text" name="batch_name" class="form-control"
             placeholder="e.g., Payroll - Branch A / Cutoff 1-15">
    </div>

    <div class="col-12">
      <label class="form-label">Select Payslip Files *</label>
      <input type="file"
             name="files[]"
             class="form-control"
             multiple
             required
             accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
      <div class="form-text">
        Allowed: PDF / Images / DOC. You can upload multiple files.
      </div>
    </div>
  </div>

  <div class="d-flex gap-2 flex-wrap mt-3">
    <button class="btn btn-primary px-4" type="submit">
      Upload to Folder
    </button>

    <a href="{{ route('hr.payslips.index') }}" class="btn btn-outline-secondary px-4">
      View All Folders
    </a>
  </div>
</form>

        <hr class="my-4">

        <div class="small text-muted">
          Tip: Use <span class="fw-semibold">Month/Year</span> folder naming for clean payroll history.
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-7">
      <div class="panel h-100">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <div>
            <div class="panel-title">
              <i class="fa-solid fa-folders me-2"></i>
              Payslip Folders
            </div>
            <p class="panel-sub">Folders grouped by Month/Year (payroll archive).</p>
          </div>

          <form method="GET" action="{{ route('hr.dashboard') }}" class="d-flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}"
                   class="form-control"
                   placeholder="Search folder (e.g., 2026-02)"
                   style="max-width: 260px;">
            <button class="btn btn-outline-dark">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </div>

        <div class="row g-3">
          @forelse($folders as $f)
            <div class="col-12 col-md-6">
              <a href="{{ $hasIndex ? route('hr.payslips.index', ['folder' => $f['key']]) : '#' }}"
                 class="text-decoration-none text-reset">
                <div class="folder-card">
                  <div class="folder-top">
                    <div class="folder-ico">
                      <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <span class="badge rounded-pill text-bg-primary">
                      {{ $f['count'] ?? 0 }} file(s)
                    </span>
                  </div>

                  <p class="folder-name mb-1">{{ $f['label'] ?? $f['key'] }}</p>
                  <p class="folder-meta mb-0">
                    <span class="text-muted">Folder key:</span> {{ $f['key'] ?? '—' }} <br>
                    <span class="text-muted">Latest upload:</span> {{ $f['latest'] ?? '—' }}
                  </p>
                </div>
              </a>
            </div>
          @empty
            <div class="col-12">
              <div class="alert alert-light border soft-alert mb-0">
                <div class="fw-bold mb-1">No folders yet.</div>
                <div class="text-muted small">
                  Upload payslips using the form to automatically create Month/Year folders.
                </div>
              </div>
            </div>
          @endforelse
        </div>

      </div>
    </div>

  </div>

  <div class="panel">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
      <div>
        <div class="panel-title">
          <i class="fa-solid fa-clock-rotate-left me-2"></i>
          Recent Uploads
        </div>
        <p class="panel-sub">Latest payslip files uploaded (for quick verification).</p>
      </div>
    </div>

    <div class="table-wrapper">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>Folder</th>
              <th>File Name</th>
              <th>Uploaded By</th>
              <th>Date</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>

          <tbody>
            @forelse($recentPayslips as $p)
              <tr>
                <td class="fw-semibold">{{ $p->folder_key ?? '—' }}</td>
                <td>{{ $p->original_name ?? '—' }}</td>
                <td class="text-muted">{{ $p->uploader->name ?? '—' }}</td>
                <td class="text-muted small">
                  {{ optional($p->created_at)->format('M d, Y · h:i A') ?? '—' }}
                </td>
                <td class="text-center">
                  <div class="d-inline-flex gap-2">
                    <a href="{{ $hasDownload ? route('hr.payslips.download', $p->id) : '#' }}"
                       class="btn btn-sm btn-outline-primary {{ $hasDownload ? '' : 'disabled' }}">
                      <i class="fa-solid fa-download"></i>
                    </a>

                    <form method="POST"
                          action="{{ $hasDestroy ? route('hr.payslips.destroy', $p->id) : '#' }}"
                          class="m-0"
                          onsubmit="return {{ $hasDestroy ? 'confirm(\'Delete this payslip file?\')' : 'false' }};">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" {{ $hasDestroy ? '' : 'disabled' }}>
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted py-4">
                  No uploads yet.
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
