<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <title>Support Tickets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <style>
    :root{
      /* Soft neutral palette (hindi masakit sa mata) */
      --bg:#c5c5c5;
      --card:#ffffff;
      --border:#e7e9ee;
      --text:#111827;
      --muted:#6b7280;

      --black:#111827;
      --green:#16a34a;
      --greenBg:#eaf7ee;
    }

    body{
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, Arial;
      background: var(--bg);
      color: var(--text);
    }

    /* Page width */
    main.container{ max-width: 1100px; }

    /* Header (responsive) */
    .app-header{
      background: var(--card);
      border-bottom:1px solid var(--border);
      position: sticky;
      top: 0;
      z-index: 1030;
    }
    .app-header-inner{
      max-width: 1100px;
      margin: 0 auto;
      padding: 12px 14px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 12px;
    }

    .brand{
      display:flex;
      align-items:center;
      gap:10px;
      min-width: 0;
    }
    .brand-badge{
      width: 38px;
      height: 38px;
      border-radius: 12px;
      display:grid;
      place-items:center;
      background:#fff;
      border:1px solid var(--border);
      color: var(--black);
      flex: 0 0 auto;
    }
    .brand-title{
      min-width: 0;
    }
    .brand-title h1{
      margin:0;
      font-size: 14px;
      font-weight: 900;
      letter-spacing:.2px;
      line-height: 1.2;
    }
    .brand-title small{
      display:block;
      margin-top:3px;
      font-size: 12px;
      color: var(--muted);
      font-weight: 600;
      line-height: 1.2;
    }

    .top-actions{
      display:flex;
      align-items:center;
      gap:10px;
      flex-wrap: wrap;
      justify-content:flex-end;
    }

    .user-pill{
      display:flex;
      align-items:center;
      gap:10px;
      padding: 8px 12px;
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      font-weight: 700;
      font-size: 13px;
      white-space: nowrap;
    }
    .avatar{
      width: 26px; height: 26px;
      border-radius: 999px;
      display:grid;
      place-items:center;
      border:1px solid var(--border);
      background:#f3f4f6;
      font-weight: 900;
      font-size: 12px;
    }

    .btn-black{
      background: var(--black);
      color:#fff;
      border:none;
      border-radius: 999px;
      font-weight: 850;
      padding: 9px 14px;
    }
    .btn-black:hover{ background:#000; color:#fff; }

    .btn-ghost{
      background:#fff;
      border:1px solid var(--border);
      border-radius: 999px;
      font-weight: 850;
      padding: 9px 12px;
      color: var(--text);
    }
    .btn-ghost:hover{ background:#f8fafc; }

    /* Alert only when session exists */
    .alert-green{
      background: var(--greenBg);
      border: 1px solid rgba(22,163,74,.20);
      color: #0f5132;
      border-radius: 12px;
      font-weight: 750;
    }

    /* Page Head */
    .page-head{
      display:flex;
      justify-content:space-between;
      align-items:flex-end;
      gap: 10px;
      flex-wrap: wrap;
      margin: 16px 0 10px;
    }
    .page-head h2{
      margin: 0;
      font-size: 18px;
      font-weight: 950;
      letter-spacing:.2px;
    }
    .page-head p{
      margin: 6px 0 0;
      color: var(--muted);
      font-weight: 600;
      font-size: 13px;
      line-height: 1.35;
    }

    /* Summary - responsive grid */
    .summary-grid{
      display:grid;
      grid-template-columns: repeat(4, minmax(0,1fr));
      gap: 10px;
      margin-bottom: 12px;
    }
    .summary-card{
      background: var(--card);
      border:1px solid var(--border);
      border-radius: 14px;
      padding: 12px 12px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap: 10px;
      min-height: 70px; /* consistent height */
    }
    .summary-card .label{
      color: var(--muted);
      font-weight: 700;
      font-size: 12px;
      margin-bottom: 2px;
    }
    .summary-card .value{
      font-weight: 950;
      font-size: 18px;
      margin: 0;
      line-height: 1.1;
    }
    .summary-icon{
      width: 38px; height: 38px;
      border-radius: 12px;
      border:1px solid var(--border);
      background:#f8fafc;
      display:grid;
      place-items:center;
      color:#111827;
      flex: 0 0 auto;
    }

    /* Controls */
    .controls{
      background:#fff;
      border:1px solid var(--border);
      border-radius: 14px;
      padding: 10px;
      display:flex;
      gap: 10px;
      justify-content:space-between;
      align-items:center;
      flex-wrap: wrap;
      margin-bottom: 12px;
    }
    .control-left, .control-right{
      display:flex;
      gap: 10px;
      align-items:center;
      flex-wrap: wrap;
    }

    .search-wrap{
      position: relative;
      min-width: 260px;
      flex: 1;
    }
    .search-wrap .bi-search{
      position:absolute;
      left: 12px;
      top:50%;
      transform: translateY(-50%);
      color:#9ca3af;
      font-size: 14px;
      pointer-events:none;
    }
    .search{
      width:100%;
      padding: 10px 12px 10px 34px;
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      outline:none;
      font-weight: 650;
      font-size: 13px;
    }
    .search:focus{
      box-shadow: 0 0 0 .2rem rgba(17,24,39,.08);
      border-color: rgba(17,24,39,.20);
    }

    .select{
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      padding: 10px 12px;
      font-weight: 750;
      font-size: 13px;
      min-width: 160px;
    }

    /* Tabs */
    .tabs{
      display:flex;
      gap: 8px;
      flex-wrap: wrap;
    }
    .tab{
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      padding: 8px 10px;
      font-weight: 850;
      font-size: 12px;
      cursor:pointer;
      user-select:none;
      color:#111827;
    }
    .tab.active{
      background:#111827;
      color:#fff;
      border-color:#111827;
    }
    .tab .count{
      margin-left: 8px;
      padding: 2px 7px;
      border-radius: 999px;
      background: rgba(0,0,0,.06);
      font-weight: 900;
      font-size: 11px;
    }
    .tab.active .count{ background: rgba(255,255,255,.18); }

    /* Main grid */
    .dashboard-grid{
      display:grid;
      grid-template-columns: minmax(0,1fr) 320px;
      gap: 12px;
      align-items:start;
    }

    .panel{
      background:#fff;
      border:1px solid var(--border);
      border-radius: 14px;
      overflow:hidden;
    }
    .panel-header{
      padding: 12px 14px;
      border-bottom:1px solid var(--border);
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .hint{
      color: var(--muted);
      font-weight: 650;
      font-size: 12px;
    }

    /* Ticket item (clean + responsive) */
    .ticket-item{
      padding: 12px 14px;
      display:flex;
      justify-content:space-between;
      gap: 12px;
      border-bottom:1px solid var(--border);
      cursor:pointer;
    }
    .ticket-item:last-child{ border-bottom:0; }
    .ticket-item:hover{ background:#fafafa; }

    .ticket-left{
      min-width: 0;
      flex: 1;
    }
    .ticket-no{
      font-size: 11px;
      font-weight: 900;
      color:#111827;
      padding: 2px 8px;
      border-radius: 999px;
      border:1px solid var(--border);
      background:#f8fafc;
      display:inline-block;
      margin-bottom: 6px;
    }
    .ticket-title{
      margin: 0;
      font-weight: 950;
      font-size: 14px;
      line-height: 1.25;
      white-space: nowrap;
      overflow:hidden;
      text-overflow: ellipsis;
    }
    .ticket-desc{
      margin: 6px 0 0;
      color: #374151;
      font-weight: 600;
      font-size: 13px;
      line-height: 1.35;
      display:-webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow:hidden;
    }
    .ticket-meta{
      margin-top: 10px;
      display:flex;
      gap: 8px;
      flex-wrap: wrap;
      color: var(--muted);
      font-size: 12px;
      font-weight: 700;
    }
    .meta-pill{
      padding: 4px 10px;
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
    }

    .badge-status{
      border-radius: 999px;
      padding: 7px 10px;
      font-weight: 900;
      font-size: 11px;
      text-transform: uppercase;
      border:1px solid var(--border);
      background:#fff;
      color:#111827;
      height: fit-content;
      white-space: nowrap;
      flex: 0 0 auto;
      align-self: flex-start;
    }
    .st-pending{ background:#fff7ed; border-color:#fed7aa; }
    .st-progress{ background:#eff6ff; border-color:#bfdbfe; }
    .st-resolved{ background:#eaf7ee; border-color:rgba(22,163,74,.20); }

    /* Side */
    .side{
      position: sticky;
      top: 84px;
    }
    .side-box{ padding: 14px; }
    .side-row{
      display:flex;
      justify-content:space-between;
      padding: 10px 0;
      border-bottom:1px dashed var(--border);
      font-weight: 850;
      font-size: 13px;
    }
    .side-row:last-child{ border-bottom:0; }
    .side-row .k{ color: var(--muted); font-weight: 800; }
    .side-note{
      margin-top: 10px;
      padding-top: 10px;
      border-top:1px solid var(--border);
      color: var(--muted);
      font-weight: 650;
      font-size: 12px;
      line-height: 1.5;
    }

    /* Empty */
    .empty{
      padding: 44px 16px;
      text-align:center;
    }
    .empty .icon{
      width: 54px; height: 54px;
      border-radius: 16px;
      border:1px solid var(--border);
      background:#f8fafc;
      display:grid;
      place-items:center;
      margin: 0 auto 10px;
    }
    .empty h6{ font-weight: 950; }
    .empty p{ color: var(--muted); font-weight: 650; }

    /* Modal */
    .modal-content{
      border-radius: 16px;
      border:1px solid var(--border);
    }
    .form-control, .form-select{
      border-radius: 12px;
      border:1px solid var(--border);
      font-weight: 650;
    }

    /* RESPONSIVE FIXES (important) */
    @media (max-width: 992px){
      .summary-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
      .dashboard-grid{ grid-template-columns: 1fr; }
      .side{ position: static; }
    }

    @media (max-width: 576px){
      /* header becomes stacked (true mobile responsive) */
      .app-header-inner{
        flex-direction: column;
        align-items: stretch;
      }
      .top-actions{
        width: 100%;
        justify-content: space-between;
      }
      .user-pill{
        flex: 1;
        justify-content: center;
      }
      .btn-black, .btn-ghost{
        width: 100%;
      }

      .summary-grid{ grid-template-columns: 1fr; }

      .controls{
        padding: 10px;
      }
      .search-wrap{ min-width: 100%; }
      .select{ min-width: 100%; }
      .control-right, .tabs{ width: 100%; }
      .tab{ flex: 1; text-align:center; }

      /* tickets: stack status under title if needed */
      .ticket-item{
        flex-direction: column;
        align-items: flex-start;
      }
      .badge-status{
        margin-top: 10px;
      }
    }
  </style>
</head>

<body>

<header class="app-header">
  <div class="app-header-inner">
    <div class="brand">
      <div class="brand-badge"><i class="fa-solid fa-ticket"></i></div>
      <div class="brand-title">
        <h1>Ticketing</h1>
        <small>Manage support requests</small>
      </div>
    </div>

    <div class="top-actions">
      @php
        $initials = collect(explode(' ', trim(Auth::user()->name)))
          ->filter()
          ->map(fn($p)=> strtoupper(mb_substr($p,0,1)))
          ->take(2)
          ->implode('');
      @endphp

      <div class="user-pill">
        <span class="avatar">{{ $initials }}</span>
        <span>{{ ucwords(strtolower(Auth::user()->name)) }}</span>
      </div>

      <button class="btn btn-black" data-bs-toggle="modal" data-bs-target="#submitTicketModal">
        <i class="bi bi-plus-circle me-1"></i> New Ticket
      </button>

      <form method="POST" action="{{ route('custom.logout') }}" class="m-0 p-0">
        @csrf
        <button type="submit" class="btn-ghost" title="Logout">
          <i class="fas fa-arrow-right-from-bracket"></i>
        </button>
      </form>
    </div>
  </div>
</header>

<main class="container py-4">

  {{-- ALERT appears ONLY when ticket submit success --}}
  @if(session('success'))
    <div class="alert alert-green py-2 px-3 mb-3 fade show" id="successAlert">
      <i class="bi bi-check-circle-fill me-2"></i>
      {{ session('success') }}
    </div>
  @endif

  <div class="page-head">
    <div>
      <h2>{{ ucwords(strtolower(Auth::user()->name)) }}'s Tickets</h2>
      <p>Track and manage your concerns.</p>
    </div>
  </div>

  <div class="summary-grid">
    <div class="summary-card">
      <div>
        <div class="label">Total</div>
        <p class="value">{{ $tickets->count() }}</p>
      </div>
      <div class="summary-icon"><i class="bi bi-collection"></i></div>
    </div>
    <div class="summary-card">
      <div>
        <div class="label">Pending</div>
        <p class="value">{{ $tickets->where('status','pending')->count() }}</p>
      </div>
      <div class="summary-icon"><i class="bi bi-hourglass-split"></i></div>
    </div>
    <div class="summary-card">
      <div>
        <div class="label">In Progress</div>
        <p class="value">{{ $tickets->where('status','in_progress')->count() }}</p>
      </div>
      <div class="summary-icon"><i class="bi bi-activity"></i></div>
    </div>
    <div class="summary-card">
      <div>
        <div class="label">Resolved</div>
        <p class="value">{{ $tickets->where('status','resolved')->count() }}</p>
      </div>
      <div class="summary-icon"><i class="bi bi-check2-circle"></i></div>
    </div>
  </div>

  <div class="controls">
    <div class="control-left">
      <div class="search-wrap">
        <i class="bi bi-search"></i>
        <input id="searchInput" class="search" type="text" placeholder="Search ticket no, subject, description..." />
      </div>

      <select id="departmentFilter" class="select">
        <option value="">All Departments</option>
        <option value="it">IT</option>
        <option value="hr">HR</option>
        <option value="finance">Finance</option>
        <option value="admin">Admin</option>
      </select>

      <select id="priorityFilter" class="select">
        <option value="">All Priority</option>
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
      </select>
    </div>

    <div class="control-right">
      <div class="tabs">
        <div class="tab active" data-status="">All <span class="count">{{ $tickets->count() }}</span></div>
        <div class="tab" data-status="pending">Pending <span class="count">{{ $tickets->where('status','pending')->count() }}</span></div>
        <div class="tab" data-status="in_progress">In Progress <span class="count">{{ $tickets->where('status','in_progress')->count() }}</span></div>
        <div class="tab" data-status="resolved">Resolved <span class="count">{{ $tickets->where('status','resolved')->count() }}</span></div>
      </div>
    </div>
  </div>

  <div class="dashboard-grid">

    <div class="panel">
      <div class="panel-header">
        <div class="hint">Click a ticket to view details</div>
        <div class="hint">Showing <span id="visibleCount">0</span> ticket(s)</div>
      </div>

      <div id="ticketList">
        @forelse($tickets as $ticket)
          @php
            $statusClass = match($ticket->status){
              'pending' => 'st-pending',
              'in_progress' => 'st-progress',
              'resolved' => 'st-resolved',
              default => ''
            };
          @endphp

          <div class="ticket-item"
               data-ticket-no="{{ strtolower($ticket->ticket_no) }}"
               data-subject="{{ strtolower($ticket->subject) }}"
               data-description="{{ strtolower($ticket->description) }}"
               data-department="{{ strtolower($ticket->department) }}"
               data-priority="{{ strtolower($ticket->priority) }}"
               data-status="{{ strtolower($ticket->status) }}"
               onclick="openTicketDetails(this)">
            <div class="ticket-left">
              <span class="ticket-no">{{ $ticket->ticket_no }}</span>
              <h6 class="ticket-title" title="{{ $ticket->subject }}">{{ $ticket->subject }}</h6>
              <p class="ticket-desc">{{ $ticket->description }}</p>

              <div class="ticket-meta">
                <span class="meta-pill"><i class="bi bi-building me-1"></i>{{ ucfirst($ticket->department) }}</span>
                <span class="meta-pill"><i class="bi bi-flag me-1"></i>{{ ucfirst($ticket->priority) }}</span>
                <span class="meta-pill"><i class="bi bi-clock me-1"></i>{{ $ticket->created_at->format('M d, Y • h:i A') }}</span>
              </div>
            </div>

            <span class="badge-status {{ $statusClass }}">
              {{ str_replace('_',' ', $ticket->status) }}
            </span>
          </div>
        @empty
          <div class="empty">
            <div class="icon"><i class="bi bi-inbox fs-3"></i></div>
            <h6>No tickets yet</h6>
            <p>Submit a concern to get started.</p>
            <button class="btn btn-black mt-2" data-bs-toggle="modal" data-bs-target="#submitTicketModal">
              <i class="bi bi-plus-circle me-1"></i> Create Ticket
            </button>
          </div>
        @endforelse
      </div>
    </div>

    <aside class="side">
      <div class="panel">
        <div class="panel-header">
          <div class="hint"><i class="bi bi-bar-chart me-1"></i> Overview</div>
        </div>
        <div class="side-box">
          <div class="side-row"><span class="k">Total</span><span>{{ $tickets->count() }}</span></div>
          <div class="side-row"><span class="k">Pending</span><span>{{ $tickets->where('status','pending')->count() }}</span></div>
          <div class="side-row"><span class="k">In Progress</span><span>{{ $tickets->where('status','in_progress')->count() }}</span></div>
          <div class="side-row"><span class="k">Resolved</span><span>{{ $tickets->where('status','resolved')->count() }}</span></div>

          <div class="side-note">
            Support team will respond as soon as possible.
          </div>
        </div>
      </div>
    </aside>

  </div>
</main>

<!-- Ticket details modal (simple) -->
<div class="modal fade" id="ticketDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <span class="ticket-no" id="d_ticketNo">—</span>
          <h5 class="modal-title mt-2 mb-0" id="d_subject">—</h5>
          <div class="text-muted mt-1" style="font-weight:650; font-size:13px;">
            <span id="d_department">—</span> • <span id="d_priority">—</span> • <span id="d_status">—</span>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-2" style="font-weight:800; font-size:12px; color:#6b7280;">Description</div>
        <div id="d_description" style="font-weight:650; line-height:1.6;">—</div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-ghost" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@include('ticket.ticket-partials.submit-modal')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Tabs
    document.querySelectorAll('.tab').forEach(t => {
      t.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
        t.classList.add('active');
        applyFilters();
      });
    });

    // Filters
    document.getElementById('searchInput')?.addEventListener('input', applyFilters);
    document.getElementById('departmentFilter')?.addEventListener('change', applyFilters);
    document.getElementById('priorityFilter')?.addEventListener('change', applyFilters);

    // Alert auto hide ONLY if exists (submit success)
    const alert = document.getElementById('successAlert');
    if(alert){
      setTimeout(() => alert.classList.remove('show'), 3500);
      setTimeout(() => alert.remove(), 4200);
    }

    applyFilters();
  });

  function activeStatus(){
    const tab = document.querySelector('.tab.active');
    return tab ? (tab.getAttribute('data-status') || '') : '';
  }

  function applyFilters(){
    const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();
    const dep = (document.getElementById('departmentFilter')?.value || '').trim().toLowerCase();
    const pri = (document.getElementById('priorityFilter')?.value || '').trim().toLowerCase();
    const st  = activeStatus();

    const items = document.querySelectorAll('#ticketList .ticket-item');
    let visible = 0;

    items.forEach(item => {
      const tNo  = item.dataset.ticketNo || '';
      const subj = item.dataset.subject || '';
      const desc = item.dataset.description || '';
      const tDep = item.dataset.department || '';
      const tPri = item.dataset.priority || '';
      const tSt  = item.dataset.status || '';

      const matchesQuery = !q || (tNo.includes(q) || subj.includes(q) || desc.includes(q));
      const matchesDep = !dep || tDep === dep;
      const matchesPri = !pri || tPri === pri;
      const matchesSt  = !st || tSt === st;

      const show = matchesQuery && matchesDep && matchesPri && matchesSt;
      item.style.display = show ? '' : 'none';
      if(show) visible++;
    });

    document.getElementById('visibleCount').textContent = visible;
  }

  function openTicketDetails(el){
    document.getElementById('d_ticketNo').innerText = el.querySelector('.ticket-no')?.innerText || '—';
    document.getElementById('d_subject').innerText = el.querySelector('.ticket-title')?.innerText || '—';
    document.getElementById('d_description').innerText = el.querySelector('.ticket-desc')?.innerText || '—';

    const dept = el.dataset.department || '—';
    const pri  = el.dataset.priority || '—';
    const st   = el.dataset.status || '—';

    document.getElementById('d_department').innerText = cap(dept);
    document.getElementById('d_priority').innerText = cap(pri);
    document.getElementById('d_status').innerText = st.replace('_',' ');

    new bootstrap.Modal(document.getElementById('ticketDetailsModal')).show();
  }

  function cap(s){
    if(!s) return '';
    return s.replace(/_/g,' ').replace(/\b\w/g, c => c.toUpperCase());
  }
</script>

</body>
</html>
