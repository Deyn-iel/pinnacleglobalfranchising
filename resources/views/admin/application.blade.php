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

  body {
    background:
      radial-gradient(1200px 650px at 18% 0%, rgba(13,110,253,.08), transparent 55%),
      radial-gradient(900px 520px at 95% 10%, rgba(34,197,94,.07), transparent 55%),
      var(--bg);
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

  /* nicer centering on huge desktop */
  @media (min-width: 1400px){
    main{
      padding-left: 34px;
      padding-right: 34px;
    }
  }

  /* remove sidebar offset on tablets/phones */
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
    transform: translateY(-3px);
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
  .stat-icon i{ font-size: 18px; }

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

  /* responsive horizontal scroll when needed */
  .table-scroll{
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  table {
    margin-bottom: 0;
    font-size: 14px;
    min-width: 840px; /* ensures nice layout; scroll on small screens */
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
    background: #0f172a; /* premium dark */
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

  /* action cell fix: allow wrap but keep aligned */
  .actions-cell{
    white-space: nowrap;
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

  <!-- RECENT APPLICATIONS -->
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <h4 class="fw-bold mb-0">Recent Applications</h4>
    <div class="text-muted small">Showing latest submissions</div>
  </div>

  <div class="table-wrapper">
    <div class="table-scroll">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Lead Source</th>
            <th>Date</th>
            <th class="text-center" style="width:160px;">Actions</th>
          </tr>
        </thead>

        <tbody>
        @forelse(\App\Models\FranchiseApplication::latest()->get() as $app)
          <tr>
            <td class="fw-semibold">{{ $app->personal_full_name }}</td>
            <td>{{ $app->email }}</td>
            <td>{{ $app->lead_source }}</td>
            <td>{{ $app->created_at->format('M d, Y') }}</td>
            <td class="text-center actions-cell">
              <div class="d-inline-flex align-items-center gap-2">
                <a href="{{ route('admin.applications.show', $app->id) }}"
                   class="btn btn-primary btn-sm">
                  View
                </a>

                <form action="{{ route('admin.applications.destroy', $app->id) }}"
                      method="POST"
                      class="m-0"
                      onsubmit="return confirm('Delete this application?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">
                    Delete
                  </button>
                </form>
              </div>
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
  </div>

</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const alertBox = document.getElementById("uploadSuccessAlert");
  if (alertBox) {
    setTimeout(() => {
      alertBox.classList.remove("show");
      alertBox.classList.add("fade");
      setTimeout(() => alertBox.remove(), 600);
    }, 2500);
  }
});
</script>

</body>
</html>
