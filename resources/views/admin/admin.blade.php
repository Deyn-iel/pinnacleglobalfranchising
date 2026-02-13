<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Dashboard</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite(['resources/css/admin/app.css'])

<style>
  :root{
    --sidebar-w: 260px;
    --bg: #f5f6fa;
    --card: rgba(255,255,255,.88);
    --text: #0f172a;
    --muted: #64748b;
    --border: rgba(15,23,42,.10);
    --shadow: 0 18px 45px rgba(15,23,42,.08);
    --shadow-hover: 0 30px 80px rgba(15,23,42,.18);
    --radius: 18px;
    --primary: #0d6efd;
    --primary-soft: rgba(13,110,253,.12);
  }

  body {
    background:
      radial-gradient(1200px 600px at 18% 0%, rgba(13,110,253,.08), transparent 55%),
      radial-gradient(900px 500px at 95% 10%, rgba(34,197,94,.07), transparent 55%),
      var(--bg);
    color: var(--text);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    overflow-x: hidden;
  }

  /* Sidebar base (keep includes unchanged) */
  aside {
    width: var(--sidebar-w);
    z-index: 999;
  }

  /* ================= MAIN LAYOUT ================= */
  main {
    margin-left: var(--sidebar-w);
    padding: clamp(16px, 2vw, 34px);
    max-width: calc(100vw - var(--sidebar-w));
    transition: margin-left .25s ease, max-width .25s ease, padding .25s ease;
    min-width: 0;
  }

  /* If your topbar is sticky and overlays content, add room.
     (safe kahit di sticky—minimal effect) */
  main{
    padding-top: clamp(18px, 2vw, 30px);
  }

  /* ================= HEADER ================= */
  .dashboard-header {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: clamp(16px, 2vw, 26px);
    box-shadow: var(--shadow);
    margin-bottom: 22px;
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

  .dashboard-header h2 {
    font-weight: 900;
    margin-bottom: 6px;
    letter-spacing: -.02em;
  }

  .dashboard-header p{
    color: var(--muted);
  }

  /* ================= DASHBOARD CARDS ================= */
  a.dash-link {
    text-decoration: none;
    color: inherit;
    display:block;
    height:100%;
  }

  .dash-card {
    border-radius: 22px;
    padding: 22px;
    background: var(--card);
    height: 100%;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    transition: transform .18s ease, box-shadow .22s ease, border-color .22s ease;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .dash-card::before{
    content:"";
    position:absolute;
    inset: -25% -35% auto -35%;
    height: 120%;
    background: radial-gradient(circle at top, rgba(13,110,253,.10), transparent 55%);
    pointer-events:none;
  }

  .dash-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-hover);
    border-color: rgba(13,110,253,.22);
  }

  .dash-top{
    display:flex;
    align-items:flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 12px;
  }

  .dash-icon {
    width: 54px;
    height: 54px;
    border-radius: 16px;
    display:grid;
    place-items:center;
    background: var(--primary-soft);
    color: var(--primary);
    flex: 0 0 auto;
    box-shadow: 0 14px 28px rgba(13,110,253,.10);
  }

  .dash-icon i{
    font-size: 20px;
    color: var(--text)
  }

  .dash-card h4 {
    font-weight: 900;
    margin-bottom: 4px;
    font-size: 16px;
    letter-spacing: -.01em;
  }

  .dash-card p {
    font-size: 13px;
    margin-bottom: 6px;
    color: var(--muted);
  }

  .dash-meta{
    display:flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
  }

  .dash-pill{
    padding: 8px 10px;
    border-radius: 999px;
    background: rgba(15,23,42,.04);
    border: 1px solid rgba(15,23,42,.06);
    font-size: 12px;
    color: #0f172a;
  }
  .dash-pill strong{ font-weight: 900; }

  .mobile-overlay{
    z-index: 998;
  }

  @media (min-width: 1400px){
    main{
      padding-left: 34px;
      padding-right: 34px;
    }
  }

  @media (max-width: 991.98px) {
    main {
      margin-left: 0;
      max-width: 100%;
      padding: 16px;
    }

    /* Push sidebar offscreen by default (works with your include) */
    aside{
      transform: translateX(-110%);
      transition: transform .25s ease;
      box-shadow: 0 40px 90px rgba(15,23,42,.25);
    }

  }

  /* Small laptops: reduce spacing a bit */
  @media (max-width: 1200px) {
    .dash-card{ padding: 18px; }
    .dash-icon{ width: 50px; height: 50px; }
  }
</style>
</head>

<body x-data="{ open:false }">

<!-- NAV (unchanged) -->
@include('admin-sidebar.navbar')


<script>
  document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {});
  });
</script>

<!-- set attribute so CSS can react -->
<div x-init="$watch('open', v => document.body.setAttribute('data-sidebar-open', v ? 'true' : 'false'))"></div>

@include('admin-sidebar.sidebar')

<!-- MOBILE OVERLAY -->
<div class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none mobile-overlay"
     x-show="open"
     x-transition.opacity
     @click="open = false"></div>

<!-- MAIN CONTENT -->
<main>

  <!-- HEADER -->
  <div class="dashboard-header">
    <h2>
      Welcome, {{ Auth::user()->name }}
      <i class="fas fa-rocket"></i>
    </h2>
    <p class="text-muted mb-0">
      Quick overview of your system modules
    </p>
  </div>

  <!-- DASHBOARD MODULES -->
  <div class="row g-4">

    <!-- Attendance -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.attendance') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Attendance</h4>
              <p class="mb-0">Manage attendance records</p>
            </div>
            <div class="dash-icon"><i class="fas fa-calendar-check"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Total Records: <strong>{{ \App\Models\Attendance::count() }}</strong></div>
          </div>
        </div>
      </a>
    </div>

    <!-- Applications -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.application') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Franchise Applications</h4>
              <p class="mb-0">Review new applications & status</p>
            </div>
            <div class="dash-icon"><i class="fas fa-folder-open"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Total: <strong>{{ \App\Models\FranchiseApplication::count() }}</strong></div>
            <div class="dash-pill">New Today: <strong>{{ \App\Models\FranchiseApplication::whereDate('created_at', today())->count() }}</strong></div>
          </div>
        </div>
      </a>
    </div>

    <!-- Supplies -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.supplies') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Supplies</h4>
              <p class="mb-0">Manage inventory & orders</p>
            </div>
            <div class="dash-icon"><i class="fas fa-boxes-stacked"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Total Supplies: <strong>{{ \App\Models\Supply::count() }}</strong></div>
          </div>
        </div>
      </a>
    </div>

    <!-- Users -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.users-account') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>User Accounts</h4>
              <p class="mb-0">Manage system users</p>
            </div>
            <div class="dash-icon"><i class="fas fa-users"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Total Users: <strong>{{ \App\Models\User::count() }}</strong></div>
          </div>
        </div>
      </a>
    </div>

    <!-- Exams -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.uploading-exams') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Exams</h4>
              <p class="mb-0">Create & manage exams</p>
            </div>
            <div class="dash-icon"><i class="fas fa-file-pen"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Total Exams: <strong>{{ \App\Models\Exam::count() }}</strong></div>
          </div>
        </div>
      </a>
    </div>

    <!-- Requirements -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.requirements') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Requirements</h4>
              <p class="mb-0">Uploaded requirements</p>
            </div>
            <div class="dash-icon"><i class="fas fa-file-lines"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Track submissions & validation</div>
          </div>
        </div>
      </a>
    </div>

    <!-- Contacts -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.contacts') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Contacts</h4>
              <p class="mb-0">User inquiries & messages</p>
            </div>
            <div class="dash-icon"><i class="fas fa-address-book"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Total Contacts: <strong>{{ \App\Models\Contact::count() }}</strong></div>
          </div>
        </div>
      </a>
    </div>

    <!-- Profile -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.admin-profile.edit') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Profile Settings</h4>
              <p class="mb-0">Update your admin profile</p>
            </div>
            <div class="dash-icon"><i class="fas fa-user-gear"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Security & preferences</div>
          </div>
        </div>
      </a>
    </div>

    <!-- Tickets -->
    <div class="col-12 col-sm-6 col-xl-4">
      <a href="{{ route('admin.tickets.index') }}" class="dash-link">
        <div class="dash-card">
          <div class="dash-top">
            <div>
              <h4>Tickets</h4>
              <p class="mb-0">Manage support tickets</p>
            </div>
            <div class="dash-icon"><i class="fas fa-life-ring"></i></div>
          </div>

          <div class="dash-meta">
            <div class="dash-pill">Total Tickets: <strong>{{ \App\Models\Ticket::count() }}</strong></div>
          </div>
        </div>
      </a>
    </div>

  </div>

</main>

<!-- CSS that reacts to body attribute (no change to includes needed) -->
<style>
  @media (max-width: 991.98px){
    body[data-sidebar-open="true"] aside{
      transform: translateX(0) !important;
    }
  }
</style>

</body>
</html>
