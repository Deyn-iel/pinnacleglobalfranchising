<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <title>Support Tickets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="chat-target-user-id" content="{{ Auth::id() }}">

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  @vite([
            'resources/css/chatbot/app.css',
            
            // js files
            'resources/js/chatbot/app.js'])
  <style>
    :root{
      --bg:#f3f4f6;
      --card:#ffffff;
      --border:#e5e7eb;
      --text:#111827;
      --muted:#6b7280;
      --black:#111827;

      --shadow: 0 10px 30px rgba(17, 24, 39, .06);
      --radius: 16px;

      --pending-bg:#fff7ed;   --pending-br:#fed7aa;   --pending-tx:#9a3412;
      --progress-bg:#eff6ff;  --progress-br:#bfdbfe;  --progress-tx:#1d4ed8;
      --resolved-bg:#eaf7ee;  --resolved-br:rgba(22,163,74,.25); --resolved-tx:#166534;

      --chip-bg:#f8fafc;
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, Arial;
      background: radial-gradient(1200px 600px at 10% 0%, #ffffff 0%, var(--bg) 55%, var(--bg) 100%);
      color: var(--text);
      overflow-x: hidden;
    }

    /* ====== Layout ====== */
    main.container{ max-width: 1100px; }

    /* ====== Header ====== */
    .app-header{
      position: sticky;
      top: 0;
      z-index: 1030;
      background: rgba(255,255,255,.78);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(229,231,235,.8);
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
      flex: 0 0 auto;
    }
    .brand-badge{
      width: 40px;
      height: 40px;
      border-radius: 14px;
      display:grid;
      place-items:center;
      background:#fff;
      border:1px solid var(--border);
      box-shadow: 0 6px 18px rgba(0,0,0,.04);
      color: var(--black);
      flex: 0 0 auto;
    }
    .brand-title{
      min-width:0;
      line-height: 1.2;
    }
    .brand-title h1{
      margin:0;
      font-size: 14px;
      font-weight: 950;
      letter-spacing:.2px;
      white-space: nowrap;
    }
    .brand-title small{
      display:block;
      margin-top:3px;
      font-size: 12px;
      color: var(--muted);
      font-weight: 650;
      white-space: nowrap;
    }

    .top-actions{
      display:flex;
      align-items:center;
      justify-content:flex-end;
      gap: 10px;
      min-width: 0;
      flex: 1 1 auto;
    }

    .user-pill{
      display:flex;
      align-items:center;
      gap:10px;
      padding: 8px 12px;
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      font-weight: 750;
      font-size: 13px;
      white-space: nowrap;
      min-width: 0;
      max-width: 320px;
      box-shadow: 0 8px 24px rgba(0,0,0,.03);
    }
    .user-pill span:last-child{
      min-width: 0;
      overflow:hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      max-width: 220px;
    }
    .avatar{
      width: 28px; height: 28px;
      border-radius: 999px;
      display:grid;
      place-items:center;
      border:1px solid var(--border);
      background: var(--chip-bg);
      font-weight: 950;
      font-size: 12px;
      flex: 0 0 auto;
    }

    .btn-black{
      background: var(--black);
      color:#fff;
      border:none;
      border-radius: 999px;
      font-weight: 850;
      padding: 6px 14px;
      white-space: nowrap;
      box-shadow: 0 10px 24px rgba(17,24,39,.18);
    }
    .btn-black:hover{ background:#000; color:#fff; }

    .btn-ghost{
      background:#fff;
      border:1px solid var(--border);
      border-radius: 999px;
      font-weight: 850;
      padding: 10px 12px;
      color: var(--text);
      white-space: nowrap;
    }
    .btn-ghost:hover{ background:#f9fafb; }

    /* Alert */
    .alert-green{
      background: var(--resolved-bg);
      border: 1px solid var(--resolved-br);
      color: #0f5132;
      border-radius: var(--radius);
      font-weight: 750;
      box-shadow: var(--shadow);
    }

    /* Page Head */
    .page-head{
      display:flex;
      justify-content:space-between;
      align-items:flex-end;
      gap: 12px;
      flex-wrap: wrap;
      margin: 18px 0 10px;
    }
    .page-head h2{
      margin: 0;
      font-size: 18px;
      font-weight: 950;
      letter-spacing:.2px;
      word-break: break-word;
    }
    .page-head p{
      margin: 6px 0 0;
      color: var(--muted);
      font-weight: 650;
      font-size: 13px;
      line-height: 1.35;
    }

    /* Summary */
    .summary-grid{
      display:grid;
      grid-template-columns: repeat(4, minmax(0,1fr));
      gap: 12px;
      margin-bottom: 12px;
    }
    .summary-card{
      background: var(--card);
      border:1px solid var(--border);
      border-radius: var(--radius);
      padding: 14px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap: 12px;
      min-height: 78px;
      min-width: 0;
      box-shadow: var(--shadow);
    }
    .summary-card .label{
      color: var(--muted);
      font-weight: 750;
      font-size: 12px;
      margin-bottom: 4px;
    }
    .summary-card .value{
      font-weight: 950;
      font-size: 20px;
      margin: 0;
      line-height: 1.1;
    }
    .summary-icon{
      width: 42px; height: 42px;
      border-radius: 14px;
      border:1px solid var(--border);
      background: var(--chip-bg);
      display:grid;
      place-items:center;
      color:#111827;
      flex: 0 0 auto;
    }

    /* Controls */
    .controls{
      background:#fff;
      border:1px solid var(--border);
      border-radius: var(--radius);
      padding: 12px;
      display:flex;
      gap: 10px;
      justify-content:space-between;
      align-items:center;
      flex-wrap: wrap;
      margin-bottom: 12px;
      box-shadow: var(--shadow);
    }
    .control-left, .control-right{
      display:flex;
      gap: 10px;
      align-items:center;
      flex-wrap: wrap;
      min-width: 0;
    }
    .control-left{ flex: 1; }

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
      padding: 11px 12px 11px 36px;
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      outline:none;
      font-weight: 650;
      font-size: 13px;
    }
    .search:focus{
      box-shadow: 0 0 0 .2rem rgba(17,24,39,.08);
      border-color: rgba(17,24,39,.18);
    }

    .select{
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      padding: 11px 12px;
      font-weight: 750;
      font-size: 13px;
      min-width: 160px;
      max-width: 100%;
    }

    /* Tabs */
    .tabs{
      display:flex;
      gap: 8px;
      flex-wrap: wrap;
      justify-content: flex-end;
      max-width: 100%;
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
      display:flex;
      align-items:center;
      justify-content:center;
      gap: 6px;
      white-space: nowrap;
      transition: transform .12s ease, background .12s ease;
    }
    .tab:hover{ transform: translateY(-1px); }
    .tab.active{
      background:#111827;
      color:#fff;
      border-color:#111827;
    }
    .tab .count{
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
      border-radius: var(--radius);
      overflow:hidden;
      min-width: 0;
      box-shadow: var(--shadow);
    }
    .panel-header{
      padding: 12px 14px;
      border-bottom:1px solid var(--border);
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap: 10px;
      flex-wrap: wrap;
      background: linear-gradient(180deg, #ffffff 0%, #fbfbfb 100%);
    }
    .hint{
      color: var(--muted);
      font-weight: 650;
      font-size: 12px;
    }

    /* Ticket item (button-like) */
    .ticket-item{
      width: 100%;
      text-align: left;
      background: transparent;
      border: 0;
      padding: 0;
    }
    .ticket-card{
      padding: 14px;
      display:flex;
      justify-content:space-between;
      gap: 12px;
      border-bottom:1px solid var(--border);
      cursor:pointer;
      min-width: 0;
      transition: background .12s ease, transform .12s ease;
    }
    .ticket-card:hover{ background:#fafafa; }
    .ticket-card:active{ transform: scale(.998); }
    .ticket-card:last-child{ border-bottom:0; }
    .ticket-card:focus-within{
      outline: none;
      box-shadow: inset 0 0 0 2px rgba(17,24,39,.12);
    }

    .ticket-left{ min-width: 0; flex: 1; }

    .ticket-no{
      font-size: 11px;
      font-weight: 900;
      color:#111827;
      padding: 3px 10px;
      border-radius: 999px;
      border:1px solid var(--border);
      background: var(--chip-bg);
      display:inline-block;
      margin-bottom: 8px;
      max-width: 100%;
      overflow:hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
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
      margin: 7px 0 0;
      color: #374151;
      font-weight: 600;
      font-size: 13px;
      line-height: 1.4;
      display:-webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow:hidden;
      word-break: break-word;
    }
    .ticket-meta{
      margin-top: 10px;
      display:flex;
      gap: 8px;
      flex-wrap: wrap;
      color: var(--muted);
      font-size: 12px;
      font-weight: 750;
      min-width: 0;
    }
    .meta-pill{
      padding: 5px 10px;
      border-radius: 999px;
      border:1px solid var(--border);
      background:#fff;
      max-width: 100%;
      overflow:hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .badge-status{
      border-radius: 999px;
      padding: 8px 10px;
      font-weight: 950;
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
    .st-pending{ background: var(--pending-bg); border-color: var(--pending-br); color: var(--pending-tx); }
    .st-progress{ background: var(--progress-bg); border-color: var(--progress-br); color: var(--progress-tx); }
    .st-resolved{ background: var(--resolved-bg); border-color: var(--resolved-br); color: var(--resolved-tx); }

    /* Side */
    .side{ position: sticky; top: 86px; }
    .side-box{ padding: 14px; }
    .side-row{
      display:flex;
      justify-content:space-between;
      gap: 12px;
      padding: 10px 0;
      border-bottom:1px dashed var(--border);
      font-weight: 850;
      font-size: 13px;
      min-width: 0;
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
      line-height: 1.6;
    }

    /* Empty */
    .empty{
      padding: 46px 16px;
      text-align:center;
    }
    .empty .icon{
      width: 58px; height: 58px;
      border-radius: 18px;
      border:1px solid var(--border);
      background: var(--chip-bg);
      display:grid;
      place-items:center;
      margin: 0 auto 12px;
      box-shadow: 0 8px 18px rgba(0,0,0,.04);
    }
    .empty h6{ font-weight: 950; }
    .empty p{ color: var(--muted); font-weight: 650; }

    /* Modal */
    .modal-content{
      border-radius: 18px;
      border:1px solid var(--border);
      box-shadow: 0 18px 50px rgba(0,0,0,.14);
    }
    .form-control, .form-select{
      border-radius: 12px;
      border:1px solid var(--border);
      font-weight: 650;
    }

    /* Filters collapse on mobile */
    .filters-toggle{
      display:none;
      width: 100%;
    }

    /* ====== Responsive ====== */
    @media (max-width: 1092px){
      .summary-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
      .dashboard-grid{ grid-template-columns: 1fr; }
      .side{ position: static; }
      .tabs{ justify-content: flex-start; }
    }

    @media (max-width: 580px){
  main.container{ padding-left: 12px; padding-right: 12px; }

  .app-header-inner{
    position: relative;           /* IMPORTANT: anchor for absolute logout */
    flex-direction: column;
    align-items: stretch;       /* space para di matamaan yung logout */
  }

  /* Logout button stays top-right */
  .logout-fab-2{
    position: absolute;
    top: 12px;
    right: 60px;
    z-index: 5;
  }

  .logout-fab{
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 5;
  }
  .logout-fab .btn-ghost{
    width: auto !important;
    max-width: none !important;
    padding: 10px 12px;
    border-radius: 999px;
  }

  .top-actions{
    flex-direction: column;
    width: 100%;
    gap: 8px;
  }

  .user-pill{ width: 100%; max-width: 100%; }
  .btn-black{ width: 100%; }

  /* REMOVE this in mobile: .btn-ghost { width:100% } */
  /* .btn-ghost { width: 100%; max-width: 100%; }  <-- delete */

  .summary-grid{ grid-template-columns: 1fr; }

  .filters-toggle{ display:block; }
  .search-wrap{ min-width: 100%; width: 100%; }

  .tabs{ width: 100%; }
  .tab{ flex: 1 1 calc(50% - 8px); }

  .ticket-card{
    flex-direction: column;
    align-items: flex-start;
  }
  .ticket-title{
    white-space: normal;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .badge-status{ margin-top: 8px; }

  .modal-dialog{ margin: .75rem; }
  .modal-title{ font-size: 16px; }
}


    @media (max-width: 360px){
      .tab{ flex: 1 1 100%; }
      .brand-title small{ display:none; }
    }
    @media (max-width: 580px) {
  .modal-footer button {
    flex: 1;
  }
   .modal-dialog{
    width: calc(100% - 1.5rem);
    max-width: none;
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
    <div class="logout-fab-2">
      <div class="user-pill">
        <span class="avatar">{{ $initials }}</span>
        <span>{{ ucwords(strtolower(Auth::user()->name)) }}</span>
      </div>
    </div>

      <button class="btn btn-black" data-bs-toggle="modal" data-bs-target="#submitTicketModal">
        <i class="bi bi-plus-circle me-1"></i> New Ticket
      </button>

      <div class="logout-fab">
  <form method="POST" action="{{ route('custom.logout') }}" class="m-0 p-0">
    @csrf
    <button type="submit" class="btn-ghost" title="Logout" aria-label="Logout">
      <i class="fas fa-arrow-right-from-bracket"></i>
    </button>
  </form>
</div>

    </div>
  </div>
</header>

<main class="container py-4">

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
    <!-- Always-visible: Search + Mobile filter toggle -->
    <div class="control-left w-100">
      <div class="search-wrap">
        <i class="bi bi-search"></i>
        <input id="searchInput" class="search" type="text" placeholder="Search ticket no, subject, description..." />
      </div>

      <!-- Mobile: show/hide filters -->
      <button class="btn btn-ghost filters-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
        <i class="bi bi-funnel me-1"></i> Filters
      </button>

      <!-- Desktop filters (always visible) -->
      <div class="d-none d-md-flex gap-2 flex-wrap align-items-center">
        <select id="departmentFilter" class="select">
          <option value="">All Departments</option>
          <option value="it">IT</option>
          <option value="hr">HR</option>
          <option value="finance">Finance</option>
          <option value="admin">Admin</option>
          <option value="operations">Operations</option>
        </select>

        <select id="priorityFilter" class="select">
          <option value="">All Priority</option>
          <option value="low">Low</option>
          <option value="medium">Medium</option>
          <option value="high">High</option>
        </select>
      </div>
    </div>

    <!-- Mobile filters inside collapse -->
    <div class="collapse w-100 d-md-none" id="filtersCollapse">
      <div class="d-flex gap-2 flex-wrap pt-2">
        <select id="departmentFilter_m" class="select w-100">
          <option value="">All Departments</option>
          <option value="it">IT</option>
          <option value="hr">HR</option>
          <option value="finance">Finance</option>
          <option value="admin">Admin</option>
        </select>

        <select id="priorityFilter_m" class="select w-100">
          <option value="">All Priority</option>
          <option value="low">Low</option>
          <option value="medium">Medium</option>
          <option value="high">High</option>
        </select>
      </div>
    </div>

    <div class="control-right w-100">
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
        <div class="hint"><i class="bi bi-info-circle me-1"></i> Click a ticket to view details</div>
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

          <button
            type="button"
            class="ticket-item"
            data-id="{{ $ticket->id }}"
            data-ticket-no="{{ strtolower($ticket->ticket_no) }}"
            data-subject="{{ strtolower($ticket->subject) }}"
            data-description="{{ strtolower($ticket->description) }}"
            data-department="{{ strtolower($ticket->department) }}"
            data-priority="{{ strtolower($ticket->priority) }}"
            data-status="{{ strtolower($ticket->status) }}"
            onclick="openTicketDetails(this)"
            aria-label="Open ticket {{ $ticket->ticket_no }} details"
          >
            <div class="ticket-card">
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
          </button>
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
            Support team will respond as soon as possible. Please keep your ticket details complete for faster resolution.
          </div>
        </div>
      </div>
    </aside>

  </div>
</main>

<!-- Details Modal -->
<!-- Details Modal -->
<div class="modal fade" id="ticketDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="min-w-0">
          <span class="ticket-no" id="d_ticketNo">—</span>
          <h5 class="modal-title mt-2 mb-0" id="d_subject">—</h5>
          <div class="text-muted mt-1" style="font-weight:650; font-size:13px;">
            <span id="d_department">—</span> •
            <span id="d_priority">—</span> •
            <span id="d_statusText">—</span>
          </div>
        </div>
      </div>

      <!-- ✅ FORM WRAPS BODY + FOOTER -->
      <form id="statusForm" method="POST">
        @csrf
        @method('PATCH')

        <div class="modal-body">
          <div class="mb-2 fw-bold text-muted small">Concerns</div>
          <div id="d_description" style="font-weight:650; line-height:1.7;">—</div>

          <hr class="my-3">

          <div class="d-flex flex-wrap gap-2 align-items-center">
            <div class="fw-bold text-muted small">Update Status</div>

            <select name="status" id="d_statusSelect"
              class="form-select"
              style="max-width:220px; border-radius:999px; font-weight:800;">
              <option value="pending">Pending</option>
              <option value="in_progress">In Progress</option>
              <option value="resolved">Resolved</option>
            </select>
          </div>
        </div>

        <!-- ✅ MAGKATABI NA -->
        <div class="modal-footer d-flex gap-2 justify-content-end">
          <button type="submit" class="btn btn-black px-4">
            Save
          </button>
          <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </form>
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

    // Inputs
    document.getElementById('searchInput')?.addEventListener('input', applyFilters);

    // Desktop filters
    document.getElementById('departmentFilter')?.addEventListener('change', applyFilters);
    document.getElementById('priorityFilter')?.addEventListener('change', applyFilters);

    // Mobile filters mirror (departmentFilter_m / priorityFilter_m)
    document.getElementById('departmentFilter_m')?.addEventListener('change', () => {
      syncMobileToDesktop();
      applyFilters();
    });
    document.getElementById('priorityFilter_m')?.addEventListener('change', () => {
      syncMobileToDesktop();
      applyFilters();
    });

    // Success alert fade out
    const alert = document.getElementById('successAlert');
    if(alert){
      setTimeout(() => alert.classList.remove('show'), 3500);
      setTimeout(() => alert.remove(), 4200);
    }

    applyFilters();
  });

  function syncMobileToDesktop(){
    const depM = document.getElementById('departmentFilter_m');
    const priM = document.getElementById('priorityFilter_m');
    const depD = document.getElementById('departmentFilter');
    const priD = document.getElementById('priorityFilter');

    // If desktop elements exist, keep value aligned
    if(depM && depD) depD.value = depM.value;
    if(priM && priD) priD.value = priM.value;
  }

  function activeStatus(){
    const tab = document.querySelector('.tab.active');
    return tab ? (tab.getAttribute('data-status') || '') : '';
  }

  function applyFilters(){
    const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();

    // Prefer desktop filters; if not available (or empty) use mobile ones
    const depD = (document.getElementById('departmentFilter')?.value || '').trim().toLowerCase();
    const priD = (document.getElementById('priorityFilter')?.value || '').trim().toLowerCase();
    const depM = (document.getElementById('departmentFilter_m')?.value || '').trim().toLowerCase();
    const priM = (document.getElementById('priorityFilter_m')?.value || '').trim().toLowerCase();

    const dep = depD || depM || '';
    const pri = priD || priM || '';

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
  const noEl = el.querySelector('.ticket-no');
  const subjEl = el.querySelector('.ticket-title');

  const ticketId = el.dataset.id;
  const dept = el.dataset.department || '';
  const pri  = el.dataset.priority || '';
  const st   = el.dataset.status || 'pending';

  document.getElementById('d_ticketNo').innerText = noEl?.innerText || '—';
  document.getElementById('d_subject').innerText = subjEl?.innerText || '—';

  const visibleDesc = el.querySelector('.ticket-desc')?.innerText || '';
  document.getElementById('d_description').innerText = visibleDesc || '—';

  document.getElementById('d_department').innerText = cap(dept);
  document.getElementById('d_priority').innerText = cap(pri);
  document.getElementById('d_statusText').innerText = (st || '').replace(/_/g,' ');

  // ✅ set dropdown
  const statusSelect = document.getElementById('d_statusSelect');
  if(statusSelect) statusSelect.value = st;

  // ✅ set form action route
  const form = document.getElementById('statusForm');
  if(form && ticketId){
    form.action = "{{ url('/tickets') }}/" + ticketId + "/status";
  }

  new bootstrap.Modal(document.getElementById('ticketDetailsModal')).show();
}


  function cap(s){
    if(!s) return '';
    return s.replace(/_/g,' ').replace(/\b\w/g, c => c.toUpperCase());
  }
</script>
@include('partials.chatbot')
</body>
</html>
