<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <title>Support Tickets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="chat-target-user-id" content="{{ Auth::id() }}">
  <meta name="base-url" content="{{ url('/') }}">
<meta name="chat-department" content="">

  <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  @vite([
            'resources/css/chatbot/app.css',
            'resources/css/chatbot/ticket.css',
            
            // js files
            'resources/js/chatbot/app.js',
            'resources/js/chatbot/ticket.js'])

</head>

<body>
<div id="chatToast" class="chat-toast"></div>
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
      {{-- @php
        $initials = collect(explode(' ', trim(Auth::user()->name)))
          ->filter()
          ->map(fn($p)=> strtoupper(mb_substr($p,0,1)))
          ->take(2)
          ->implode('');
      @endphp
    <div class="logout-fab-2">
      <div class="user-pill">
        <span class="avatar">{{ $initials }}</span>
      </div>
    </div> --}}

    <div class="chat-dept-wrapper">
  <div class="chat-dept-container">
    <select id="chatDepartmentSelect" class="chat-dept-select">
      <option value="" disabled selected>Chat Department</option>
      <option value="it">IT</option>
      <option value="hr">HR</option>
      <option value="smm">SMM</option>
      <option value="admin-secretary">Admin Secretary</option>
      <option value="od">OD</option>
      <option value="om">OM</option>
    </select>
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
      <h2></h2>
      <h2>{{ ucwords(strtolower(Auth::user()->name)) }}'s Tickets </h2>
      <p>Track and manage your concerns.</p>
      
    </div>
  </div>

  <div class="summary-grid">
    <div class="summary-card">
      <div>
        <p style="margin:0;">
  <a href="{{ route('tickets.dashboard') }}"
     style="
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        background: #f1f5f9;
        text-decoration: none;
        color: #0f172a;
        font-weight: 600;
     ">
     
     <i class="fas fa-arrow-left"></i>
     Back to Dashboard
  </a>
</p>
      </div>
      
    </div>
    {{-- <div class="summary-card">
      <div>
        <div class="label">Total</div>
        <p class="value">{{ $tickets->count() }}</p>
      </div>
      <div class="summary-icon"><i class="bi bi-collection"></i></div>
    </div> --}}
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
    <div class="control-left w-100">
      <div class="search-wrap">
        <i class="bi bi-search"></i>
        <input id="searchInput" class="search" type="text" placeholder="Search ticket no, subject, description..." />
      </div>

      <button class="btn btn-ghost filters-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
        <i class="bi bi-funnel me-1"></i> Filters
      </button>

      <div class="d-none d-md-flex gap-2 flex-wrap align-items-center">
        <select id="departmentFilter" class="select">
          <option value="">All Departments</option>
          <option value="it">IT</option>
          <option value="smm">SMM</option>
          <option value="hr">HR</option>
          <option value="admin-secretary">Admin</option>
          <option value="od">Operations Director</option>
          <option value="om">Operations Manager</option>
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
          <option value="smm">SMM</option>
          <option value="hr">HR</option>
          <option value="finance">Finance</option>
          <option value="admin-secretary">Admin</option>
          <option value="od">Operations Director</option>
          <option value="om">Operations Manager</option>
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
        <div class="hint">
Showing <span id="visibleCount">0</span> ticket(s)
@if($tickets->count())
<span class="text-muted ms-2">
<i class="bi bi-clock"></i>
{{ $tickets->first()->created_at->diffForHumans() }}
</span>
@endif
</div>
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
          @php
  $isReview = $ticket->status === 'in_progress' && $ticket->approval_requested;
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
            data-status="{{ $ticket->approval_requested && $ticket->status === 'in_progress' ? 'for_review' : strtolower($ticket->status) }}"
            data-time="{{ $ticket->created_at->diffForHumans() }}"
            data-approval-requested="{{ $ticket->approval_requested ? 1 : 0 }}"
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
                  <span class="meta-pill">
<i class="bi bi-clock me-1"></i>
{{ $ticket->created_at->diffForHumans() }}
</span>
                </div>
              </div>

              <span class="badge-status {{ $isReview ? 'st-review' : $statusClass }}" id="status-{{ $ticket->id }}">
  {{ $isReview ? 'for review' : str_replace('_',' ', $ticket->status) }}
</span>
            </div>
          </button>
        @empty
          <div class="empty">
            <div class="icon"><i class="bi bi-inbox fs-3"></i></div>
            <h6>No tickets yet</h6>
            <p>Submit a concern first to start chatting.</p>
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
          <div class="side-row"><span class="k" style="color: rgb(233, 53, 53);">Pending</span><span>{{ $tickets->where('status','pending')->count() }}</span></div>
          <div class="side-row"><span class="k" style="color: #1d4ed8;">In Progress</span><span>{{ $tickets->where('status','in_progress')->count() }}</span></div>
          <div class="side-row"><span class="k" style="color: #166534;">Resolved</span><span>{{ $tickets->where('status','resolved')->count() }}</span></div>

          <div class="side-note">
            Support team will respond as soon as possible. Please ensure that all ticket details are complete and 
            accurate upon submission to facilitate 
            faster resolution. Kindly avoid submitting multiple requests for the same concern to prevent 
            duplication and processing delays.<br><br>

            <strong style="font-weight: bolder; color:#444444;">Reminder:</strong> Please observe proper behavior and professionalism when communicating your concerns. Our support team 
            is here to assist you, and maintaining a respectful tone will help us serve you better. Thank you for your understanding.
          </div>
        </div>
      </div>
    </aside>

  </div>
</main>

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
<span id="d_statusText">—</span> •
<span id="d_time">—</span>
</div>
        </div>
      </div>

      <form id="statusForm" method="POST">
        @csrf
        @method('PATCH')

        <div class="modal-body">
          <div class="mb-2 fw-bold text-muted small">Concerns</div>
          <div id="d_description" style="font-weight:650; line-height:1.7;">—</div>

          <hr class="my-3">




<div id="cancelJustificationWrap" class="mt-3 d-none">
  <label class="fw-bold text-muted small">Reason for Cancellation</label>

  <textarea 
    id="cancelJustification" 
    class="form-control mt-1"
    rows="3"
    placeholder="Why are you rejecting the resolved status?"></textarea>

  
</div>
          <div id="statusSection">

  <div id="normalStatusWrap">
    <div class="fw-bold text-muted small mt-3">Status</div>

    <select name="status" id="d_statusSelect"
      class="form-select"
      style="max-width:220px; border-radius:999px; font-weight:800;">
    </select>
  </div>

  <div id="approvalActionsWrap" class="d-none mt-3">

    <div class="fw-bold text-muted small">Waiting for Your Approval Decision</div>

    <div class="d-flex gap-2 mt-2">
      <button type="button" class="btn btn-success btn-sm" id="acceptTicket">
        <i class="bi bi-check-circle"></i> Accept
      </button>

      <button type="button" class="btn btn-danger btn-sm" id="cancelTicket">
        <i class="bi bi-x-circle"></i> Decline
      </button>
    </div>

  </div>

</div>
        </div>

        <div class="modal-footer d-flex gap-2 justify-content-end">
          {{-- <button type="submit" class="btn btn-black px-4" id="saveBtn">
  Save
</button> --}}
<button 
    type="button" 
    id="submitDeclineBtn"
    class="btn btn-black px-4  d-none"> Save
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

@include('partials.chatbot')

<script>


document.getElementById('ticketForm').addEventListener('submit', function () {
    let btn = document.getElementById('submitBtn');

    btn.disabled = true;

    btn.innerHTML = '<i class="fa-solid fa-arrows-rotate fa-spin"></i> Submitting...';
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {

  const msg = localStorage.getItem('success');

  if(msg){

    const alertBox = document.createElement('div');
    alertBox.className = 'alert alert-green py-2 px-3 mb-3 fade show';
    alertBox.innerHTML = `<i class="bi bi-check-circle-fill me-2"></i> ${msg}`;

    document.querySelector('main.container').prepend(alertBox);

    // remove after show
    setTimeout(() => alertBox.classList.remove('show'), 5000);
    setTimeout(() => alertBox.remove(), 5500);

    localStorage.removeItem('success');
  }

});
</script>

</body>
</html>
