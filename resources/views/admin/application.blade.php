<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Franchise Application · Dashboard</title>

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

    /* Safe space para hindi tabunan ng top navbar/header */
    --admin-top-safe: 76px;
  }

  body {
    overflow-x: hidden;
    color: var(--text);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  }

  aside {
    width: var(--sidebar-w);
    z-index: 999;
  }

  /* ================= MAIN ================= */
  main {
    margin-left: var(--sidebar-w);
    padding: clamp(16px, 2.2vw, 34px);
    max-width: calc(100vw - var(--sidebar-w));
    min-width: 0;
  }

  @media (min-width: 1400px){
    main{
      padding-left: 34px;
      padding-right: 34px;
    }
  }

  @media (max-width: 991.98px){
    main{
      margin-left: 0;
      max-width: 100%;
      padding: 16px;
    }
  }

  /* ================= HEADER ================= */
  .page-header {
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

  .page-header::after{
    content:"";
    position:absolute;
    right:-90px; top:-90px;
    width: 260px; height: 260px;
    background: radial-gradient(circle, rgba(13,110,253,.18), transparent 60%);
    pointer-events:none;
  }

  .page-header h3{
    letter-spacing: -.02em;
  }

  /* ================= STATS ================= */
  .stat-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 20px;
    box-shadow: var(--shadow);
    transition: transform .18s ease, box-shadow .22s ease, border-color .22s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .stat-card::before{
    content:"";
    position:absolute;
    inset: -25% -35% auto -35%;
    height: 120%;
    background: radial-gradient(circle at top, rgba(13,110,253,.10), transparent 55%);
    pointer-events:none;
  }

  .stat-card:hover {
    box-shadow: var(--shadow-hover);
    border-color: rgba(13,110,253,.22);
  }

  .stat-top{
    display:flex;
    align-items:flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 10px;
  }

  .stat-icon{
    width: 48px;
    height: 48px;
    border-radius: 16px;
    display:grid;
    place-items:center;
    background: var(--primary-soft);
    color: var(--text);
    flex: 0 0 auto;
    box-shadow: 0 14px 28px rgba(13,110,253,.10);
  }

  .stat-icon i{
    font-size: 18px;
  }

  .stat-title {
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 2px;
    font-weight: 700;
    letter-spacing: .2px;
  }

  .stat-value {
    font-size: clamp(26px, 2.6vw, 34px);
    font-weight: 900;
    color: var(--text);
    letter-spacing: -.02em;
    line-height: 1.05;
  }

  .stat-sub{
    font-size: 13px;
    color: var(--muted);
    margin: 0;
  }

  /* ================= TABLE ================= */
  .table-wrapper {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 14px;
    box-shadow: var(--shadow);
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .table-scroll{
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  table {
    margin-bottom: 0;
    font-size: 14px;
    min-width: 840px;
  }

  th {
    white-space: nowrap;
  }

  td {
    vertical-align: middle;
  }

  .table thead th{
    border-bottom: 0;
  }

  .table-hover tbody tr{
    transition: background .15s ease;
  }

  /* ================= BUTTONS ================= */
  .btn-primary {
    background: #0f172a;
    border: none;
    font-weight: 700;
    border-radius: 999px;
    padding: 6px 14px;
  }

  .btn-primary:hover{
    background: #111827;
  }

  .btn-danger {
    font-weight: 700;
    border-radius: 999px;
    padding: 6px 14px;
  }

  .actions-cell{
    white-space: nowrap;
}

.action-group{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    flex-wrap:wrap;
}

.action-btn{
    width:38px;
    height:38px;
    border:none;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    color:#fff;
    transition:all .18s ease;
    box-shadow:0 8px 18px rgba(0,0,0,.08);
}

.action-btn:hover{
    box-shadow:0 14px 25px rgba(0,0,0,.15);
}

.action-view{background:#0f172a;}
.action-schedule{background:#06b6d4;}
.action-start{background:#2563eb;}
.action-reschedule{background:#f59e0b;}
.action-done{background:#16a34a;}
.action-close{background:#111827;}
.action-decline{background:#dc2626;}
.action-delete{background:#e11d48;}

.action-btn i{
    pointer-events:none;
}

  /* ================= ALERT ================= */
  .alert {
    border-radius: 14px;
    box-shadow: 0 12px 30px rgba(15,23,42,.10);
    border: 1px solid rgba(34,197,94,.25);
    transition: opacity 0.6s ease, transform 0.6s ease;
  }

  .alert.fade:not(.show) {
    opacity: 0;
    transform: translateY(-10px);
  }

  /* ================= MODAL FIX ================= */
/* NORMALIZE ALL MODALS */
.modal{
    z-index: 1060 !important;
}

.modal-backdrop.show{
    z-index: 1055 !important;
}

/* application details only slightly higher */
.app-details-modal{
    z-index: 1070 !important;
}

  /* SCHEDULE + RESCHEDULE MODAL FIX */
[id^="scheduleModal"] .modal-dialog,
[id^="rescheduleModal"] .modal-dialog{
    margin: 80px auto !important;
    max-width: 650px;
    pointer-events: auto;
}

#scheduleModal1 .modal-content,
[id^="scheduleModal"] .modal-content,
[id^="rescheduleModal"] .modal-content{
    border-radius: 16px;
}

#scheduleModal1 .modal-body,
[id^="scheduleModal"] .modal-body,
[id^="rescheduleModal"] .modal-body{
    max-height: 70vh;
    overflow-y: auto;
}

  #appDetailsModal{
    padding: 16px !important;
  }

  #appDetailsModal.show{
    display: flex !important;
    align-items: center;
    justify-content: center;
    padding-top: var(--admin-top-safe) !important;
    padding-bottom: 24px !important;
  }

  #appDetailsModal .modal-dialog{
    margin: 0 auto !important;
    width: min(1100px, calc(100vw - 32px));
    max-width: 1100px;
  }

  #appDetailsModal .modal-content{
    border-radius: 18px;
    overflow: hidden;
    border: 0;
    box-shadow: 0 24px 80px rgba(15,23,42,.25);
    max-height: calc(100vh - var(--admin-top-safe) - 40px);
    background: #fff;
  }

  #appDetailsModal .modal-header,
  #appDetailsModal .modal-footer{
    background: #fff;
    position: relative;
    z-index: 2;
    flex: 0 0 auto;
  }

  #appDetailsModal .modal-header{
    padding: 14px 18px;
    border-bottom: 1px solid rgba(15,23,42,.08);
  }

  #appDetailsModal .modal-body{
    padding: 18px;
    overflow-y: auto;
    overflow-x: hidden;
  }

  #appDetailsModal .modal-footer{
    padding: 12px 18px;
    border-top: 1px solid rgba(15,23,42,.08);
  }

  @media (max-width: 991.98px){
    :root{
      --admin-top-safe: 58px;
    }

    #appDetailsModal .modal-dialog{
      width: min(100%, calc(100vw - 24px));
    }
  }

  @media (max-width: 767.98px){
    :root{
      --admin-top-safe: 48px;
    }

    #appDetailsModal{
      padding: 8px !important;
    }

    #appDetailsModal.show{
      padding-top: var(--admin-top-safe) !important;
      padding-bottom: 10px !important;
    }

    #appDetailsModal .modal-dialog{
      width: calc(100vw - 16px);
      max-width: none;
    }

    #appDetailsModal .modal-content{
      border-radius: 14px;
      max-height: calc(100vh - var(--admin-top-safe) - 16px);
    }

    #appDetailsModal .modal-header{
      padding: 12px 14px;
    }

    #appDetailsModal .modal-body{
      padding: 12px;
    }

    #appDetailsModal .modal-footer{
      padding: 10px 14px;
    }

    #appDetailsModal .modal-title{
      font-size: 16px;
    }

    #appDetailsModal .btn{
      font-size: 14px;
    }
  }

  form .form-control,
form .form-select{
    height: 45px;
    border-radius: 10px;
}

.pagination{
    justify-content:center;
}
.loading-btn{
    opacity: 1;
}

.loading-btn.loading{
    pointer-events: none;
    opacity: .85;
}

.loading-btn .btn-text{
    display: none;
}

.loading-btn.loading .btn-text{
    display: inline;
}

.loading-btn .btn-loader{
    display: none;
}

.loading-btn.loading .btn-loader{
    display: inline;
}
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

  <div class="page-header">
    <h3 class="fw-bold mb-1">
      <i class="fas fa-chart-line me-2"></i>Franchise Application Dashboard
    </h3>
    <p class="text-muted mb-0">
      Overview of franchise applications and recent activity.
    </p>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-4">
      <div class="stat-card">
        <div class="stat-top">
          <div>
            <div class="stat-title">Total Applications</div>
            <div class="stat-value">{{ \App\Models\FranchiseApplication::count() }}</div>
            <p class="stat-sub">All-time submitted forms</p>
          </div>
          <div class="stat-icon"><i class="fas fa-folder-open"></i></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="stat-card">
        <div class="stat-top">
          <div>
            <div class="stat-title">Submitted Today</div>
            <div class="stat-value">{{ \App\Models\FranchiseApplication::whereDate('created_at', today())->count() }}</div>
            <p class="stat-sub">New entries today</p>
          </div>
          <div class="stat-icon"><i class="fas fa-bolt"></i></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="stat-card">
        <div class="stat-top">
          <div>
            <div class="stat-title">Latest Applicant</div>
            <div class="fw-semibold fs-5">
              {{ optional(\App\Models\FranchiseApplication::latest()->first())->personal_full_name ?? 'No Data' }}
            </div>
            <p class="stat-sub">Most recent submission</p>
          </div>
          <div class="stat-icon"><i class="fas fa-user"></i></div>
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

  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <h4 class="fw-bold mb-0">Recent Applications</h4>
    <div class="text-muted small">Showing latest submissions</div>
  </div>

  <form method="GET" class="row g-2 mb-3">

    <div class="col-md-4">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search applicant..."
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="All">All Status</option>
            <option value="Review in Progress" {{ request('status')=='Review in Progress' ? 'selected' : '' }}>Review in Progress</option>
            <option value="Appointment Scheduled" {{ request('status')=='Appointment Scheduled' ? 'selected' : '' }}>Appointment Scheduled</option>
            <option value="Discovery Meeting" {{ request('status')=='Discovery Meeting' ? 'selected' : '' }}>Discovery Meeting</option>
            <option value="Discovery Session Done" {{ request('status')=='Discovery Session Done' ? 'selected' : '' }}>Discovery Session Done</option>
            <option value="Closed Deal" {{ request('status')=='Closed Deal' ? 'selected' : '' }}>Closed Deal</option>
            <option value="Declined" {{ request('status')=='Declined' ? 'selected' : '' }}>Declined</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="latest" {{ request('sort')=='latest' ? 'selected' : '' }}>Latest</option>
            <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>Oldest</option>
        </select>
    </div>

    <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-dark loading-btn">
<span class="btn-label">Apply</span>
<span class="btn-loader">
<i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
</span>
<span class="btn-text ms-2">Loading...</span>
</button>
    </div>

</form>
  <div class="table-wrapper">
    <div class="table-scroll">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>Applicant</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Proposed Location</th>
            <th>Date Applied</th>
          <th>Meeting Schedule</th>
          <th>Status</th>
            <th class="text-center" style="width:230px;">Actions</th>
          </tr>
        </thead>

        <tbody>
        @forelse($applications as $app)
          <tr>
            <td class="fw-semibold">{{ $app->personal_full_name }}</td>
            <td>{{ $app->email }}</td>
            <td>{{ $app->personal_contact }}</td>
            <td>{{ $app->address_city }} {{ $app->proposal_location }}</td>
            <td>{{ $app->created_at->format('M d, Y') }}</td>

            <td>
            @if($app->appointment_date)
                <div class="fw-semibold">
                    {{ \Carbon\Carbon::parse($app->appointment_date)->format('M d, Y') }}
                </div>

                <small class="text-muted">
                    {{ \Carbon\Carbon::parse($app->appointment_time)->format('h:i A') }}
                </small>
            @else
                <span class="text-muted">Not Scheduled</span>
            @endif
            </td>

            <td>
    @php
        $status = $app->status ?? 'Review in Progress';
        $badgeClass = 'bg-warning text-dark';

        switch (strtolower(trim($status))) {

            // MODULE 3 - APPLICATION STATUS TRACKING
            case 'review in progress':
                $status = 'Review in Progress';
                $badgeClass = 'bg-warning text-dark';
                break;

            // MODULE 4 - APPOINTMENT SCHEDULING
            case 'appointment scheduled':
                $status = 'Appointment Scheduled';
                $badgeClass = 'bg-info text-dark';
                break;

            // Optional next stages
            case 'discovery meeting':
                $status = 'Discovery Meeting';
                $badgeClass = 'bg-primary';
                break;

            case 'discovery session done':
                $status = 'Discovery Session Done';
                $badgeClass = 'bg-success';
                break;

            case 'interested':
                $status = 'Interested';
                $badgeClass = 'bg-success';
                break;

            case 'follow-up needed':
                $status = 'Follow-up Needed';
                $badgeClass = 'bg-warning text-dark';
                break;

            case 'closed deal':
                $status = 'Closed Deal';
                $badgeClass = 'bg-success';
                break;

            case 'declined':
                $status = 'Declined';
                $badgeClass = 'bg-danger';
                break;

            default:
                $status = 'Review in Progress';
                $badgeClass = 'bg-warning text-dark';
                break;
        }
    @endphp

<span class="badge {{ $badgeClass }}">{{ $status }}</span>
      </td>

      <td class="text-center actions-cell">
<div class="action-group">

<button
type="button"
class="action-btn action-view js-view-app"
title="View Details"
data-bs-toggle="modal"
data-bs-target="#appDetailsModal"
data-url="{{ route('admin.applications.modal', $app->id) }}">
<i class="fas fa-eye"></i>
</button>

{{-- REVIEW --}}
@if($app->status == 'Review in Progress' || $app->status == 'Submitted')
<button
type="button"
class="action-btn action-schedule"
title="Schedule Meeting"
data-bs-toggle="modal"
data-bs-target="#scheduleModal{{ $app->id }}">
<i class="fas fa-calendar-plus"></i>
</button>
@endif

{{-- APPOINTMENT --}}
@if($app->status == 'Appointment Scheduled')

<form action="{{ route('admin.application.startDiscovery', $app->id) }}" method="POST">
@csrf
<button type="submit"
class="action-btn action-start loading-btn"
title="Start Discovery">
<i class="fas fa-play"></i>
</button>
</form>

<button
type="button"
class="action-btn action-reschedule"
title="Reschedule"
data-bs-toggle="modal"
data-bs-target="#rescheduleModal{{ $app->id }}">
<i class="fas fa-clock"></i>
</button>

@endif

{{-- DISCOVERY --}}
@if($app->status == 'Discovery Meeting')
<form action="{{ route('admin.application.doneDiscovery', $app->id) }}" method="POST">
@csrf
<button type="submit"
class="action-btn action-done loading-btn"
title="Mark Done">
<i class="fas fa-check"></i>
</button>
</form>
@endif

{{-- DONE --}}
@if($app->status == 'Discovery Session Done')

<form action="{{ route('admin.application.closeDeal', $app->id) }}" method="POST">
@csrf
<button type="submit"
class="action-btn action-close loading-btn"
title="Close Deal">
<i class="fas fa-handshake"></i>
</button>
</form>

<form action="{{ route('admin.application.decline', $app->id) }}" method="POST">
@csrf
<button type="submit"
class="action-btn action-decline loading-btn"
title="Decline">
<i class="fas fa-xmark"></i>
</button>
</form>

@endif

{{-- DELETE --}}
<form action="{{ route('admin.applications.destroy', $app->id) }}"
method="POST"
onsubmit="return confirm('Delete application?')">
@csrf
@method('DELETE')

<button type="submit"
class="action-btn action-delete loading-btn"
title="Delete">
<i class="fas fa-trash"></i>
</button>

</form>

</div>
</td>
</tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted py-4">
              No applications submitted yet.
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>
      <div class="mt-3">
{{ $applications->links() }}
</div>
    </div>
  </div>

</main>


@foreach($applications as $app)
<div class="modal fade" id="rescheduleModal{{ $app->id }}" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Reschedule Appointment</h5>
</div>

<form action="{{ route('admin.application.reschedule', $app->id) }}" method="POST">
@csrf

<div class="modal-body">

<div class="mb-3">
<label>Date</label>
<input type="date" name="appointment_date" class="form-control" required value="{{ $app->appointment_date }}">
</div>

<div class="mb-3">
<label>Time</label>
<input type="time" name="appointment_time" class="form-control" required value="{{ $app->appointment_time }}">
</div>

<div class="mb-3">
<label>Meeting Type</label>
<select name="meeting_type" class="form-select">
<option {{ $app->meeting_type=='Zoom' ? 'selected' : '' }}>Zoom</option>
<option {{ $app->meeting_type=='Google Meet' ? 'selected' : '' }}>Google Meet</option>
<option {{ $app->meeting_type=='Face to Face' ? 'selected' : '' }}>Face to Face</option>
</select>
</div>

<div class="mb-3">
<label>Meeting Link</label>
<input type="url" name="meeting_link" class="form-control"
value="{{ $app->meeting_link }}"
placeholder="Paste Zoom / Google Meet link">
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-warning loading-btn">
<span class="btn-label">Save Changes</span>
<span class="btn-loader">
<i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
</span>
<span class="btn-text ms-2">Updating...</span>
</button>
</div>

</form>

</div>
</div>
</div>
@endforeach
@foreach($applications as $app)
<div class="modal fade" id="scheduleModal{{ $app->id }}" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Schedule Appointment</h5>
</div>

<form action="{{ route('admin.application.schedule', $app->id) }}" method="POST">
@csrf

<div class="modal-body">

<div class="mb-3">
<label>Date</label>
<input type="date" name="appointment_date" class="form-control" required>
</div>

<div class="mb-3">
<label>Time</label>
<input type="time" name="appointment_time" class="form-control" required>
</div>

<div class="mb-3">
<label>Meeting Type</label>
<select name="meeting_type" class="form-select" required>
<option value="">Select</option>
<option>Zoom</option>
<option>Google Meet</option>
<option>Face to Face</option>
</select>
</div>

<div class="mb-3">
<label>Meeting Link</label>
<input type="url" name="meeting_link" class="form-control"
placeholder="Paste Zoom / Google Meet link">
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-info loading-btn">
<span class="btn-label">Save Schedule</span>
<span class="btn-loader">
<i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
</span>
<span class="btn-text ms-2">Sending...</span>
</button>
</div>

</form>

</div>
</div>
</div>
@endforeach
<div class="modal fade app-details-modal" id="appDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold mb-0">Application Details</h5>
      </div>

      <div class="modal-body" id="appModalBody">
        <div class="text-center py-5 text-muted">
          <div class="spinner-border" role="status" aria-hidden="true"></div>
          <div class="mt-2">Loading...</div>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

  document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function () {

        const btn = form.querySelector('button[type="submit"], button:not([type])');

        if (!btn) return;

        btn.disabled = true;
        btn.classList.add("loading");

        const label = btn.querySelector(".btn-label");
        if(label) label.style.display = "none";
    });
});

  const alertBox = document.getElementById("uploadSuccessAlert");
  if (alertBox) {
    setTimeout(() => {
      alertBox.classList.remove("show");
      alertBox.classList.add("fade");
      setTimeout(() => alertBox.remove(), 600);
    }, 2500);
  }

  const modalBody = document.getElementById("appModalBody");

  document.querySelectorAll(".js-view-app").forEach(btn => {
    btn.addEventListener("click", async function () {
      const url = this.dataset.url;

      modalBody.innerHTML = `
        <div class="text-center py-5 text-muted">
          <div class="spinner-border" role="status" aria-hidden="true"></div>
          <div class="mt-2">Loading...</div>
        </div>
      `;

      try {
        const res = await fetch(url, {
          method: "GET",
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "Accept": "text/html"
          },
          credentials: "same-origin"
        });

        const html = await res.text();

        if (!res.ok) {
          console.error("Modal load failed:", res.status, html);
          throw new Error(`HTTP ${res.status}`);
        }

        modalBody.innerHTML = html;

      } catch (error) {
        console.error("Error loading modal:", error);
        modalBody.innerHTML = `
          <div class="alert alert-danger mb-0">
            Failed to load application details.<br>
            <small>${error.message}</small>
          </div>
        `;
      }
    });
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>