<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- ✅ Fully responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration (Admin)</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  @vite(['resources/css/admin/app.css'])

  <style>
  :root{
    --sidebar-w: 260px;

    /* premium neutrals */
    --bg: #f6f7fb;
    --surface: rgba(255,255,255,.78);
    --surface-2: rgba(255,255,255,.92);
    --text: #0f172a;
    --muted: #64748b;

    --border: rgba(15,23,42,.08);
    --border-strong: rgba(15,23,42,.14);

    --shadow: 0 14px 40px rgba(2, 6, 23, .08);
    --shadow-2: 0 26px 80px rgba(2, 6, 23, .14);

    --radius: 20px;

    --primary: #0d3553;
    --primary-2: #0b4a7a;
    --primary-soft: rgba(13,53,83,.10);

    --content-pad: clamp(14px, 2vw, 34px);
    --container-max: 1320px;
    --gap: 16px;
    --right-col: 460px;

    --ring: 0 0 0 4px rgba(13,53,83,.12);
  }

  html,body{ height:100%; }
  body{
    margin:0;
    color: var(--text);
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
    background:
      radial-gradient(1200px 620px at 15% 0%, rgba(13,110,253,.08), transparent 60%),
      radial-gradient(980px 540px at 90% 12%, rgba(34,197,94,.07), transparent 60%),
      radial-gradient(860px 520px at 50% 85%, rgba(14,116,144,.05), transparent 60%),
      var(--bg);
    overflow-x:hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  /* sidebar only */
  body > aside{
    width: var(--sidebar-w);
    z-index: 999;
    flex: 0 0 auto;
  }

  main{
    margin-left: var(--sidebar-w);
    padding: var(--content-pad);
    max-width: calc(100vw - var(--sidebar-w));
    min-width: 0;
  }

  .adm-container{
    width: min(var(--container-max), 100%);
    margin: 0 auto;
    min-width: 0;
  }

  /* top header */
  .dashboard-header{
    background: linear-gradient(180deg, var(--surface-2), var(--surface));
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: clamp(14px, 2vw, 26px);
    box-shadow: var(--shadow);
    margin-bottom: 18px;
    backdrop-filter: blur(12px);
    position: relative;
    overflow: hidden;
  }

  .dashboard-header::before{
    content:"";
    position:absolute;
    inset:0;
    background:
      radial-gradient(600px 220px at 18% 0%, rgba(13,53,83,.08), transparent 65%),
      radial-gradient(680px 260px at 100% 30%, rgba(2,132,199,.06), transparent 65%);
    pointer-events:none;
  }

  .dashboard-header > *{ position: relative; }

  .dashboard-header h2{
    font-weight: 900;
    margin-bottom: 6px;
    letter-spacing: -.02em;
    font-size: clamp(18px, 2vw, 28px);
  }
  .dashboard-header p{
    color: var(--muted);
    margin: 0;
  }

  /* filter */
  .header-filter{
    display:flex;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    width: 100%;
  }
  .header-filter .form-control{
    min-width: 240px;
    flex: 1 1 280px;
  }
  .header-filter .form-select{
    min-width: 160px;
    flex: 0 0 180px;
  }

  /* premium inputs */
  .form-label{ color: var(--muted); font-size: 12.5px; }
  .form-control, .form-select{
    border-radius: 14px !important;
    border: 1px solid var(--border-strong) !important;
    padding: 10px 12px !important;
    background: rgba(255,255,255,.94);
    transition: box-shadow .15s ease, border-color .15s ease, transform .12s ease;
  }
  .form-control:focus, .form-select:focus{
    border-color: rgba(13,53,83,.50) !important;
    box-shadow: var(--ring) !important;
  }

  /* premium button */
  .adm-btn{
    border-radius: 999px;
    border: 1px solid rgba(13,53,83,.22);
    padding: 10px 14px;
    font-size: 13px;
    font-weight: 800;
    cursor:pointer;
    background: linear-gradient(135deg, var(--primary), var(--primary-2));
    color:#fff;
    box-shadow: 0 10px 22px rgba(13,53,83,.18);
    transition: transform .14s ease, filter .14s ease, box-shadow .14s ease;
    white-space: nowrap;
  }
  .adm-btn:hover{ transform: translateY(-2px); filter: brightness(1.04); box-shadow: 0 18px 40px rgba(13,53,83,.22); }
  .adm-btn:active{ transform: translateY(0); }

  .adm-btn-ghost{
    background: #fff;
    color: var(--primary);
    border: 1px solid rgba(13,53,83,.25);
    box-shadow: none;
  }
  .adm-btn-ghost:hover{ background: rgba(13,53,83,.04); filter:none; }

  /* layout grid */
  .adm-grid{
    display:grid;
    grid-template-columns: minmax(580px, 1fr) var(--right-col);
    gap: var(--gap);
    align-items: start;
    min-width: 0;
  }

  /* premium cards */
  .glass-card{
    background: linear-gradient(180deg, var(--surface-2), var(--surface));
    border: 1px solid var(--border);
    border-radius: 24px;
    box-shadow: var(--shadow);
    backdrop-filter: blur(14px);
    transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    overflow: hidden;
  }
  .glass-card:hover{
    transform: translateY(-2px);
    box-shadow: var(--shadow-2);
    border-color: rgba(13,110,253,.18);
  }

  .card-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 12px;
    padding: 18px 18px 0 18px;
    flex-wrap: wrap;
  }
  .card-title{
    display:flex;
    align-items:center;
    gap: 10px;
    margin:0;
    font-weight: 900;
    font-size: 15px;
    letter-spacing: -.01em;
    min-width: 0;
  }
  .title-icon{
    width: 44px;
    height: 44px;
    border-radius: 16px;
    display:grid;
    place-items:center;
    background: var(--primary-soft);
    color: var(--primary);
    box-shadow: 0 14px 28px rgba(13,53,83,.10);
    flex: 0 0 auto;
  }

  .badge-live{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 7px 10px;
    border-radius: 999px;
    background: rgba(15,23,42,.04);
    border: 1px solid rgba(15,23,42,.06);
    font-size: 12px;
    color: #0f172a;
    white-space: nowrap;
  }
  .badge-live .dot{
    width:8px;height:8px;border-radius:999px;
    background:#22c55e;
    box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  }

  .card-body-pad{ padding: 14px 18px 18px 18px; min-width: 0; }

  /* premium table wrapper */
  .table-wrap{
    border: 1px solid rgba(15,23,42,.08);
    border-radius: 18px;
    overflow: hidden;
    background: rgba(255,255,255,.92);
  }
  .table-scroll{
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .table{
    margin:0;
    min-width: 980px;
  }
  .table thead th{
    background: rgba(248,250,252,.98);
    color:#334155;
    font-weight: 800;
    font-size: 12.5px;
    border-bottom: 1px solid rgba(15,23,42,.08) !important;
    white-space: nowrap;
  }
  .table tbody tr{
    transition: background .12s ease;
  }
  .table tbody tr:hover{
    background: rgba(13,53,83,.03);
  }
  .table td{
    font-size: 13px;
    vertical-align: middle;
    white-space: nowrap;
  }

  /* chips */
  .pill-mini{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 6px 10px;
    border-radius:999px;
    border: 1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.95);
    font-size: 12px;
    font-weight: 800;
    color: #0f172a;
    white-space: nowrap;
    max-width: 260px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* nicer status pills (optional) */
  .pill-status{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 6px 10px;
    border-radius:999px;
    border:1px solid rgba(15,23,42,.10);
    background:#fff;
    font-size:12px;
    font-weight:900;
  }
  .pill-status::before{
    content:"";
    width:8px;height:8px;border-radius:999px;
    background:#94a3b8;
  }
  .pill-status.pending{ border-color: rgba(234,179,8,.28); background: rgba(234,179,8,.10); color:#854d0e; }
  .pill-status.pending::before{ background:#f59e0b; box-shadow: 0 0 0 4px rgba(245,158,11,.16); }
  .pill-status.approved{ border-color: rgba(34,197,94,.28); background: rgba(34,197,94,.10); color:#166534; }
  .pill-status.approved::before{ background:#22c55e; box-shadow: 0 0 0 4px rgba(34,197,94,.16); }
  .pill-status.rejected{ border-color: rgba(239,68,68,.28); background: rgba(239,68,68,.10); color:#991b1b; }
  .pill-status.rejected::before{ background:#ef4444; box-shadow: 0 0 0 4px rgba(239,68,68,.16); }

  /* note */
  .note{
    border: 1px solid rgba(15,23,42,.08);
    background: rgba(255,255,255,.78);
    border-radius: 18px;
    padding: 12px;
    color: var(--muted);
    font-size: 13px;
    line-height: 1.55;
    word-break: break-word;
  }

  /* sticky review */
  .review-sticky{ position: sticky; top: 16px; }

  /* alert */
  .adm-alert{
    display:flex;
    align-items:center;
    gap: 10px;
    border-radius: 16px;
    padding: 12px 14px;
    border: 1px solid rgba(15,23,42,.10);
    background: rgba(255,255,255,.92);
    box-shadow: var(--shadow);
    backdrop-filter: blur(12px);
  }
  .adm-alert-success{
    border-color: rgba(34,197,94,.30);
    background: rgba(34,197,94,.10);
    color: #166534;
  }

  /* alpine transitions (kept) */
  .adm-fade-enter,.adm-fade-leave{
    transition-property: opacity, transform, filter;
    transition-timing-function: cubic-bezier(.22,1,.36,1);
    will-change: opacity, transform;
  }
  .adm-fade-enter{ transition-duration: 320ms; }
  .adm-fade-leave{ transition-duration: 900ms; }
  .adm-fade-enter-start{ opacity: 0; transform: translateY(-8px); filter: blur(2px); }
  .adm-fade-enter-end{ opacity: 1; transform: translateY(0); filter: blur(0); }
  .adm-fade-leave-start{ opacity: 1; transform: translateY(0); filter: blur(0); }
  .adm-fade-leave-end{ opacity: 0; transform: translateY(-8px); filter: blur(2px); }

  /* responsive */
  @media (min-width: 1600px){
    :root{ --container-max: 1480px; --right-col: 520px; }
  }
  @media (max-width: 1440px){
    :root{ --sidebar-w: 250px; --right-col: 440px; }
    main{ margin-left: var(--sidebar-w); max-width: calc(100vw - var(--sidebar-w)); }
  }
  @media (max-width: 1366px){
    :root{ --sidebar-w: 240px; --right-col: 420px; }
    .card-head{ padding: 16px 16px 0 16px; }
    .card-body-pad{ padding: 12px 16px 16px 16px; }
  }
  @media (max-width: 1280px){
    :root{ --right-col: 390px; }
    .table{ min-width: 920px; }
  }
  @media (max-width: 1024px){
    :root{ --sidebar-w: 240px; --right-col: 1fr; }
    .adm-grid{ grid-template-columns: 1fr; }
    .review-sticky{ position: static; }
    .table{ min-width: 880px; }
  }
  @media (max-width: 768px){
    main{ margin-left: 0; max-width: 100%; padding: 14px; }
    body > aside{ width: 100%; }
    .dashboard-header{ padding: 14px; }
    .header-filter{ justify-content: stretch; }
    .header-filter .form-control,
    .header-filter .form-select,
    .header-filter .btn{
      width: 100%;
      flex: 1 1 100%;
    }
    .table{ min-width: 820px; }
  }
</style>

</head>

<body>
@include('admin.headoffice-portals.hr.hr-partials.sidebar')

  <main>
    <div class="adm-container">

      @if(session('success'))
        <div
          x-data="{ show: true }"
          x-init="setTimeout(() => show = false, 3000)"
          x-show="show"
          x-transition:enter="adm-fade-enter"
          x-transition:enter-start="adm-fade-enter-start"
          x-transition:enter-end="adm-fade-enter-end"
          x-transition:leave="adm-fade-leave"
          x-transition:leave-start="adm-fade-leave-start"
          x-transition:leave-end="adm-fade-leave-end"
          class="adm-alert adm-alert-success mb-3"
          role="alert"
        >
          <i class="fa-solid fa-circle-check me-2"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @php
  $selectedId = $selected?->id;
@endphp


      {{-- ✅ SHOW VALIDATION ERRORS --}}
@if ($errors->any())
  <div class="alert alert-danger">
    <strong>Upload failed:</strong>
    <ul class="mb-0">
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif


      <div class="dashboard-header d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="me-auto">
          <h2 class="mb-1">Coffee Track Registrations</h2>
          <p class="mb-0">Incoming submissions from users</p>
        </div>

        <form class="header-filter" method="GET" action="{{ route('admin.coffee-registrations.index') }}">
  <input class="form-control" name="search" value="{{ request('search') }}" placeholder="Search name/email/session">

  <select class="form-select" name="status">
    <option value="">All</option>
    @foreach(['Pending','Approved','Rejected'] as $st)
      <option value="{{ $st }}" @selected(request('status')===$st)>{{ $st }}</option>
    @endforeach
  </select>

  <button class="adm-btn" type="submit">
    <i class="fa-solid fa-filter me-1"></i> Filter
  </button>
</form>

      </div>

      <div class="adm-grid">

        <section class="glass-card">
          <div class="card-head">
            <h3 class="card-title">
              <span class="title-icon"><i class="fa-solid fa-list-check"></i></span>
              Submissions
            </h3>
            <span class="badge-live"><span class="dot"></span> Live</span>
          </div>

          <div class="card-body-pad">
            <div class="table-wrap table-scroll">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>Applicant</th>
                    <th>Email</th>
                    <th>Session</th>
                    <th>Package</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($regs as $r)
                    <tr>
                      <td><span class="pill-mini">{{ $r->full_name }}</span></td>
                      <td class="text-muted">{{ $r->email }}</td>
                      <td class="text-muted">{{ $r->session_datetime }}</td>
                      <td class="text-muted">{{ $r->rate_type }} (₱{{ number_format($r->rate_amount,2) }})</td>
                      @php $st = strtolower($r->status); @endphp
<td>
  <span class="pill-status {{ in_array($st,['pending','approved','rejected']) ? $st : '' }}">
    {{ $r->status }}
  </span>
</td>

                      <td class="text-end">
                        <div class="d-inline-flex gap-2 flex-wrap justify-content-end">
                          <a class="btn btn-sm btn-outline-secondary rounded-pill"
                             href="{{ route('admin.coffee-registrations.index', array_merge(request()->query(), ['selected'=>$r->id])) }}">
                            View
                          </a>

                          <form
                            method="POST"
                            action="{{ route('admin.coffee-registrations.destroy', $r->id) }}"
                            onsubmit="return confirm('Delete this registration? This cannot be undone.')"
                            class="d-inline"
                          >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                              <i class="fa-solid fa-trash me-1"></i> Delete
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No registrations found.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <div class="mt-3">
              {{ $regs->links() }}
            </div>
          </div>
        </section>

        <aside class="glass-card review-sticky">
          <div class="card-head">
            <h3 class="card-title">
              <span class="title-icon"><i class="fa-solid fa-file-lines"></i></span>
              Review Panel
            </h3>
            <span class="pill-mini">Admin / HR</span>
          </div>

          <div class="card-body-pad">
            @if($selected)

              <div class="note mb-3">
                <strong>Event:</strong> {{ $selected->event_name }} <br>
                <strong>Venue:</strong> {{ $selected->event_venue }} <br>
                <strong>Date:</strong> {{ $selected->event_date_range }}
              </div>

              <div class="mb-3">
                <div><strong>Applicant:</strong> {{ $selected->full_name }}</div>
                <div><strong>Email:</strong> {{ $selected->email }}</div>
                <div><strong>Phone:</strong> {{ $selected->phone ?? '—' }}</div>
                <hr>
                <div><strong>Session:</strong> {{ $selected->session_title }}</div>
                <div><strong>Speaker:</strong> {{ $selected->session_speaker }}</div>
                <div><strong>Schedule:</strong> {{ $selected->session_datetime }}</div>
                <hr>
                <div><strong>Package:</strong> {{ $selected->rate_type }} (₱{{ number_format($selected->rate_amount,2) }})</div>
                <div><strong>Payment:</strong> {{ $selected->payment_method ?? '—' }}</div>
                <div><strong>Ref #:</strong> {{ $selected->reference_no ?? '—' }}</div>
              </div>

              <form method="POST" action="{{ route('admin.coffee-registrations.update', $selected) }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select class="form-select" name="status" required>
                    @foreach(['Pending','Approved','Rejected'] as $st)
                      <option value="{{ $st }}" @selected($selected->status===$st)>{{ $st }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label">Admin notes</label>
                  <textarea class="form-control" name="admin_notes" rows="4">{{ old('admin_notes', $selected->admin_notes) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mb-3">
                  <button class="adm-btn w-100" type="submit">
                    <i class="fa-solid fa-check me-1"></i> Update
                  </button>
                </div>
              </form>

              <form
                method="POST"
                action="{{ route('admin.coffee-registrations.destroy', $selected) }}"
                onsubmit="return confirm('Delete this registration? This cannot be undone.')"
                class="mb-4"
              >
                @csrf
                @method('DELETE')
                <button class="adm-btn adm-btn-ghost w-100"
                        style="border-color: rgba(239,68,68,.35); color:#b91c1c;">
                  <i class="fa-solid fa-trash me-1"></i> Delete Registration
                </button>
              </form>

              @php $hrAccess = auth()->user()->hr_access ?? false; @endphp

              @if($hrAccess)
                <hr>

                <h6 class="fw-bold mb-2">HR Requirements (3 documents)</h6>

                @php
                  $count = 0;
                  if($selected->request_approval_path) $count++;
                  if($selected->travel_order_path) $count++;
                  if($selected->registration_ticket_path) $count++;
                @endphp

                <div class="note mb-3">
                  <strong>Progress:</strong> {{ $count }}/3 <br>
                  @if($selected->completed_at)
                    <span class="text-success fw-bold">
                      ✅ Completed ({{ \Carbon\Carbon::parse($selected->completed_at)->format('M d, Y h:i A') }})
                    </span>
                  @endif
                </div>

                <form method="POST"
                      action="{{ route('admin.coffee-registrations.documents', $selected) }}"
                      enctype="multipart/form-data">
                  @csrf

                  <div class="mb-2">
                    <label class="form-label">1) Request for Approval</label>
                    <input type="file" name="request_approval" class="form-control">
                    @if($selected->request_approval_path)
                      <small class="text-success">Uploaded ✓</small>
                    @endif
                  </div>

                  <div class="mb-2">
                    <label class="form-label">2) Travel Order</label>
                    <input type="file" name="travel_order" class="form-control">
                    @if($selected->travel_order_path)
                      <small class="text-success">Uploaded ✓</small>
                    @endif
                  </div>

                  <div class="mb-2">
                    <label class="form-label">3) Registration Ticket</label>
                    <input type="file" name="registration_ticket" class="form-control">
                    @if($selected->registration_ticket_path)
                      <small class="text-success">Uploaded ✓</small>
                    @endif
                  </div>

                  <button class="adm-btn mt-2 w-100" type="submit">
                    Upload / Update Documents
                  </button>
                </form>
              @endif

            @else
              <div class="note">Select a submission to review.</div>
            @endif
          </div>
        </aside>

      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
