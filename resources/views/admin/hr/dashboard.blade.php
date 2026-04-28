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
  --bg: #f8fafc;
  --card: #ffffff;
  --text: #0f172a;
  --muted: #6b7280;
  --border: #e5e7eb;
  --primary: #1e293b;
  --accent: #2563eb;
  --success: #16a34a;
  --danger: #dc2626;
  --radius: 14px;
}

body{
  background: var(--bg);
  font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  color: var(--text);
}

main{
  margin-left: var(--sidebar-w);
  padding: 28px;
  max-width: calc(100vw - var(--sidebar-w));
}

@media (max-width: 991.98px){
  main{ margin-left:0; padding:16px; }
}

/* HEADER */
.dashboard-header{
  background: var(--card);
  border:1px solid var(--border);
  border-radius: var(--radius);
  padding: 22px;
  margin-bottom: 24px;
}

.dashboard-header h2{
  font-weight:700;
  font-size:22px;
}

.dashboard-header p{
  font-size:14px;
  color: var(--muted);
}

/* STAT CARDS */
.stat-card{
  background: var(--card);
  border:1px solid var(--border);
  border-radius: var(--radius);
  padding:20px;
  transition:.2s ease;
}

.stat-card:hover{
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(0,0,0,.05);
}

.stat-title{
  font-size:12px;
  font-weight:600;
  text-transform: uppercase;
  color: var(--muted);
  letter-spacing:.5px;
}

.stat-value{
  font-size:26px;
  font-weight:700;
  margin-top:6px;
}

.stat-icon{
  width:42px;
  height:42px;
  border-radius:10px;
  display:grid;
  place-items:center;
  background:#f1f5f9;
  color:var(--primary);
}

/* PANELS */
.panel{
  background: var(--card);
  border:1px solid var(--border);
  border-radius: var(--radius);
  padding:20px;
}

.panel-title{
  font-weight:700;
  font-size:16px;
}

.panel-sub{
  font-size:13px;
  color:var(--muted);
}

/* FORM */
.form-label{
  font-weight:600;
  font-size:13px;
}

.form-control,
.form-select{
  border-radius:10px;
  border:1px solid var(--border);
  padding:10px 12px;
}

.form-control:focus,
.form-select:focus{
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(37,99,235,.15);
}

/* BUTTONS */
.btn{
  border-radius:10px;
  font-weight:600;
}

.btn-primary{
  background: var(--accent);
  border:none;
}

.btn-primary:hover{
  background:#1d4ed8;
}

/* FOLDER CARDS */
.folder-card{
  border:1px solid var(--border);
  border-radius: var(--radius);
  padding:16px;
  background:#fff;
  transition:.2s ease;
}

.folder-card:hover{
  box-shadow:0 8px 24px rgba(0,0,0,.05);
}

.folder-name{
  font-weight:600;
}

.folder-meta{
  font-size:12px;
  color:var(--muted);
}

/* TABLE */
.table-wrapper{
  border:1px solid var(--border);
  border-radius: var(--radius);
  overflow:hidden;
}

table{
  margin:0;
}

thead{
  background:#f1f5f9;
}

th{
  font-size:12px;
  font-weight:600;
  text-transform: uppercase;
  letter-spacing:.5px;
  color:var(--muted);
}

tbody td{
  font-size:13px;
  vertical-align:middle;
}

.table-hover tbody tr:hover{
  background:#f8fafc;
}

/* ALERTS */
.soft-alert{
  border-radius:10px;
  font-size:13px;
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
      <p class="text-muted mb-0">Payroll & Payslip Management Overview</p>
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
          <div class="stat-title">Total Payslips</div>
          <div class="stat-value">{{ $payslipsCount ?? '—' }}</div>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-receipt"></i></div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="stat-card d-flex align-items-center justify-content-between gap-3">
        <div>
          <div class="stat-title">Total Employees</div>
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
  </div>
@endif

@if(session('skipped_files') && count(session('skipped_files')))
  <div class="alert alert-warning soft-alert mb-3">
    <div class="fw-bold mb-2">Skipped files (no matching email found):</div>
    <ul class="mb-0 small">
      @foreach(session('skipped_files') as $sf)
        <li>{{ $sf }}</li>
      @endforeach
    </ul>
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
            <p class="panel-sub">Upload payslips individually or as a ZIP file for automatic distribution.</p>
          </div>
          <span class="badge rounded-pill text-bg-warning text-dark px-3 py-2">
            Folder: <span class="fw-bold" x-text="folderLabel"></span>
          </span>
        </div>

        <form id="uploadForm"
      action="{{ route('hr.payslips.store') }}"
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

    {{-- <div class="col-12">
      <label class="form-label">Payroll Batch Name (optional)</label>
      <input type="text" name="batch_name" class="form-control"
             placeholder="e.g., Payroll - Branch A / Cutoff 1-15">
    </div> --}}

    <div class="col-12">
      <label class="form-label">Select Payslip Files *</label>

      <input type="file"
             name="files[]"
             class="form-control"
             multiple
             required
             accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.zip">
      <div class="form-text">
        Allowed: PDF / Images / DOC / ZIP. You can upload multiple files.
      </div>
    </div>
  </div>

  <div class="d-flex gap-2 flex-wrap mt-3">
    <button id="uploadBtn" class="btn btn-primary px-4" type="submit">
      Upload
    </button>

    {{-- <a href="{{ route('hr.payslips.index') }}" class="btn btn-outline-secondary px-4">
      View All Folders
    </a> --}}
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
             <a href="#"
              class="text-decoration-none text-reset"
              data-bs-toggle="modal"
              data-bs-target="#folderModal"
              data-folder="{{ $f['key'] }}"
              data-label="{{ $f['label'] }}"
              data-count="{{ $f['count'] }}"
              data-latest="{{ $f['latest'] }}"
              data-files='@json($f["files"])'>
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

  {{-- <div class="panel">
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
                  <div class="dropdown action-menu-wrap">
                    <button class="action-menu-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" aria-label="Open actions">
                      <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end action-menu">
                    <a href="{{ $hasDownload ? route('hr.payslips.download', $p->id) : '#' }}"
                       class="btn btn-sm btn-outline-primary {{ $hasDownload ? '' : 'disabled' }}">
                      <i class="fa-solid fa-download"></i>
                      Download
                    </a>

                    <form method="POST"
                          action="{{ $hasDestroy ? route('hr.payslips.destroy', $p->id) : '#' }}"
                          onsubmit="return {{ $hasDestroy ? 'confirm(\'Delete this payslip file?\')' : 'false' }};">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" {{ $hasDestroy ? '' : 'disabled' }}>
                        <i class="fa-solid fa-trash"></i>
                        Delete
                      </button>
                    </form>
                    </div>
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
  </div> --}}

  <!-- Folder Details Modal -->
<div class="modal fade" id="folderModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius:14px;">
      
      <div class="modal-header">
        <h5 class="modal-title fw-semibold">
          Folder Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

  <div class="row mb-4">
    <div class="col-md-6">
      <small class="text-muted">Folder</small>
      <div class="fw-semibold" id="modalFolderLabel"></div>
    </div>
    <div class="col-md-6">
      <small class="text-muted">Total Files</small>
      <div class="fw-semibold" id="modalFolderCount"></div>
    </div>
  </div>

  <div class="table-wrapper">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>File Name</th>
            <th>Uploaded By</th>
            <th>Date</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody id="modalFileTable">
        </tbody>
      </table>
    </div>
  </div>

</div>

    </div>
  </div>
</div>

<!-- Upload Loading Overlay -->
<div id="uploadLoading"
     style="display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.55);
            z-index:2000;
            backdrop-filter: blur(2px);
            align-items:center;
            justify-content:center;
            flex-direction:column;
            color:white;
            font-weight:600;">
            
    <div class="spinner-border text-light mb-3" style="width:3rem;height:3rem;"></div>
    <div>Uploading... Please wait.</div>
</div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

  // ✅ Upload loading
  const uploadForm = document.getElementById('uploadForm');
  const uploadBtn = document.getElementById('uploadBtn');
  const loadingOverlay = document.getElementById('uploadLoading');

  if (uploadForm) {
    uploadForm.addEventListener('submit', function () {
      if (loadingOverlay) loadingOverlay.style.display = 'flex';
      if (uploadBtn) {
        uploadBtn.disabled = true;
        uploadBtn.innerText = 'Uploading...';
      }
    });
  }

  // ✅ Success alert fade
  const alert = document.getElementById("successAlert");
  if (alert) {
    setTimeout(() => {
      alert.style.transition = "opacity 0.6s ease, transform 0.6s ease";
      alert.style.opacity = "0";
      alert.style.transform = "translateY(-5px)";
      setTimeout(() => alert.remove(), 600);
    }, 3000);
  }

  // ✅ Folder modal populate
  const folderModal = document.getElementById('folderModal');
  folderModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const label = button.getAttribute('data-label');
    const count = button.getAttribute('data-count');
    const rawFiles = button.getAttribute('data-files');
    const files = rawFiles ? JSON.parse(rawFiles) : [];

    document.getElementById('modalFolderLabel').innerText = label;
    document.getElementById('modalFolderCount').innerText = count + " file(s)";

    const tableBody = document.getElementById('modalFileTable');
    tableBody.innerHTML = '';

    if (files.length === 0) {
      tableBody.innerHTML = `
        <tr>
          <td colspan="4" class="text-center text-muted py-4">
            No files in this folder.
          </td>
        </tr>
      `;
      return;
    }

    files.forEach(file => {
      const row = `
        <tr>
          <td>${file.original_name ?? '—'}</td>
          <td>${file.uploader?.name ?? '—'}</td>
          <td>${new Date(file.created_at).toLocaleString()}</td>
          <td class="text-center">
            <div class="dropdown action-menu-wrap">
              <button class="action-menu-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open actions">
                <i class="fa-solid fa-ellipsis"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end action-menu">

              <a href="/hr/payslips/${file.id}/download"
                 class="btn btn-sm btn-outline-primary">
                 <i class="fa-solid fa-download"></i>
                 Download
              </a>

              <form method="POST"
                    action="/hr/payslips/${file.id}"
                    onsubmit="return confirm('Delete this payslip file?')">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-sm btn-outline-danger">
                  <i class="fa-solid fa-trash"></i>
                  Delete
                </button>
              </form>

              </div>
            </div>
          </td>
        </tr>
      `;
      tableBody.innerHTML += row;
    });
  });

});
</script>
</body>
</html>

