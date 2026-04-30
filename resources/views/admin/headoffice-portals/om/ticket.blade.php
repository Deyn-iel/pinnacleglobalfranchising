<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>OM · Support Tickets</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="chat-department" content="om">
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite([
        'resources/css/chatbot/app.css',
            
            // js files
            'resources/js/chatbot/app.js'])

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
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    color: var(--text);
    overflow-x: hidden;
  }

  /* ===== MAIN ===== */
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

  /* ===== HEADER ===== */
  .page-header{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: clamp(16px, 2vw, 24px);
    box-shadow: var(--shadow);
    margin-bottom: 16px;
    display:flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    flex-wrap: wrap;
    backdrop-filter: blur(10px);
  }

  .page-header h3{
    font-weight: 900;
    letter-spacing: -.02em;
    margin-bottom: 4px;
  }

  .muted-pill{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(15,23,42,.05);
    border: 1px solid rgba(15,23,42,.06);
    color: var(--muted);
    font-size: 12px;
    font-weight: 900;
    white-space: nowrap;
  }

  /* ===== ALERT ===== */
  .alert{
    border-radius: 14px;
    box-shadow: 0 12px 28px rgba(15,23,42,.08);
    border: 1px solid rgba(34,197,94,.25);
  }

  /* ===== USER CARD ===== */
  .user-card{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: var(--shadow);
    margin-bottom: 18px;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .user-header{
    padding: 14px 18px;
    border-bottom: 1px solid rgba(15,23,42,.08);
    display:flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .user-header h5{
    margin: 0;
    font-weight: 900;
    letter-spacing: -.01em;
  }

  .user-header small{ color: var(--muted); }

  .count-badge{
    border-radius: 999px;
    padding: 8px 12px;
    font-weight: 900;
    letter-spacing: .2px;
  }

  /* ===== TABLE ===== */
  .table-responsive{
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

.table{
  table-layout: fixed;
  width: 100%;
  min-width: 760px;
  margin-bottom: 0;
}

.table th:nth-child(1), .table td:nth-child(1){ width: 13%; } /* Ticket # */
.table th:nth-child(2), .table td:nth-child(2){ width: 13%; } /* Branch */
.table th:nth-child(3), .table td:nth-child(3){ width: 17%; } /* Concern */
.table th:nth-child(4), .table td:nth-child(4){ width: 8%; } /* Dept */
.table th:nth-child(5), .table td:nth-child(5){ width: 10%; } /* Priority */
.table th:nth-child(6), .table td:nth-child(6){ width: 12%; } /* Status */
.table th:nth-child(7), .table td:nth-child(7){ width: 15%; } /* Date */
.table th:nth-child(8), .table td:nth-child(8){ width: 8%; }  /* Actions */


  .table thead th{
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: rgba(255,255,255,.92);
    white-space: nowrap;
    border-bottom: 0;
    background: rgb(90, 90, 90);
  }

  .table tbody tr{ transition: background .15s ease; }

.concern-cell{
  min-width: 0;
}

  .concern-row{
    display:flex;
    align-items:center;
    gap: 8px;
    min-width: 0;
  }

.description-box{
  flex: 1 1 44px;
  min-width: 30px;
  max-width: 54px;
  min-height: 36px;

  font-size: 13px;
  color: #0f172a;
  line-height: 1;
  font-weight: 650;

  padding: 8px 10px;
  border-radius: 12px;
  border: 1px solid rgba(15,23,42,.10);
  background: rgba(248,250,252,.96);

  display: flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}


  .btn-view{
    flex: 0 0 auto;
    border-radius: 999px;
    font-weight: 900;
    padding: 7px 10px;
    border: 1px solid rgba(15,23,42,.12);
    background: #fff;
    white-space: nowrap;
    min-width: 72px;
    font-size: 12px;
  }
  .btn-view:hover{ background: rgba(15,23,42,.04); }

  @media (max-width: 1200px){
    .table{ min-width: 720px; }
    .table th,
    .table td{ padding-left: 8px; padding-right: 8px; }
    .concern-row{ gap: 6px; }
    .description-box{ min-width: 26px; max-width: 38px; padding: 7px 8px; }
    .btn-view{ min-width: 62px; padding: 7px 8px; }
  }

  @media (max-width: 768px){
    .table{ min-width: 760px; }
  }

  .action-wrap{
    display:inline-flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .action-menu-toggle{
    width: 38px;
    height: 38px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: #fff;
    color: var(--text);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 18px rgba(15,23,42,.08);
  }

  .action-menu-toggle:hover,
  .action-menu-toggle.show{
    background: var(--text);
    border-color: var(--text);
    color: #fff;
  }

  .action-menu{
    min-width: 190px;
    padding: 8px;
    border: 1px solid var(--border);
    border-radius: 14px;
    box-shadow: 0 18px 42px rgba(15,23,42,.14);
  }

  .action-menu.show{
    margin-top: 8px !important;
  }

  .action-menu .btn{
    width: 100%;
    min-height: 38px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
    border-radius: 10px;
    font-weight: 900;
    margin-bottom: 6px;
  }

  .action-menu .btn:last-child{
    margin-bottom: 0;
  }

  .btn{ font-weight: 900; border-radius: 999px; }
  .btn-danger{ padding: 6px 12px; }

  @media (max-width: 768px){
    .action-wrap{ align-items: center; }
    .action-menu .btn{ width: 100%; }
  }

  /* ===== EMPTY ===== */
  .no-tickets{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: var(--shadow);
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .modal{ z-index: 2000; }
  .modal-backdrop{ z-index: 1990; }

  .modal-content{
    border-radius: 18px !important;
    border: 1px solid rgba(15,23,42,.12);
    box-shadow: 0 18px 60px rgba(0,0,0,.25);
    overflow: hidden;
  }

  .modal-header{
    background: #fff;
    border-bottom: 1px solid rgba(15,23,42,.08);
  }

  .modal-title{ font-weight: 900; }

  .meta-badges .badge{
    border-radius: 999px;
    font-weight: 900;
    padding: 8px 12px;
  }

  .concern-full{
    white-space: pre-wrap;
    font-weight:650;
    line-height:1.75;
    background: rgba(15,23,42,.03);
    border: 1px solid rgba(15,23,42,.10);
    border-radius: 16px;
    padding: 14px;
    min-height: 120px;

    overflow-wrap: break-word;
    word-break: normal;
    hyphens: auto;
  }

  @media (max-width: 576px){
    .modal-dialog{ margin: 0; }
    .modal-content{ border-radius: 0 !important; }
  }
    .global-loader{
  position: fixed;
  inset: 0;
  background: rgba(15,23,42,0.55);
  backdrop-filter: blur(6px);
  z-index: 9999;

  display: flex;
  align-items: center;
  justify-content: center;
}

.loader-content{
  text-align: center;
  color: #fff;
  font-size: 14px;
  letter-spacing: .3px;
}

.toast-custom{
  min-width: 260px;
  border-radius: 12px;
  backdrop-filter: blur(10px);
  box-shadow: 0 10px 30px rgba(0,0,0,.15);
  font-weight: 600;
  animation: fadeInUp 0.4s ease;
}

@keyframes fadeInUp{
  from{
    opacity: 0;
    transform: translateY(-10px);
  }
  to{
    opacity: 1;
    transform: translateY(0);
  }
}

.chat-badge{
  position:absolute;
  top:-5px;
  right:-5px;
  background:red;
  color:white;
  font-size:11px;
  padding:2px 6px;
  border-radius:50%;
  font-weight:bold;
  display:none;
}
</style>
</head>

<body>
  <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;"></div>
<!-- FULLSCREEN LOADING -->
<div id="globalLoader" class="global-loader d-none">
  <div class="loader-content">
    <div class="spinner-border text-light" role="status"></div>
    <div class="mt-3 fw-semibold">Sending approval request...</div>
  </div>
</div>
@include('admin.headoffice-portals.om.partials.sidebar')

<main>

  <!-- HEADER -->
  <div class="page-header">
    <div>
      <h3><i class="fa-solid fa-ticket me-2"></i>Support Tickets</h3>
      <p class="text-muted mb-0">View tickets by account</p>
      <br>
      <a href="{{ route('tickets.myTickets', ['from' => 'om']) }}"
   style="text-decoration: none; color: black; font-weight: 700;"
   class="nav-item {{ request()->routeIs('tickets.myTickets') ? 'active' : '' }}">
    <i class="fas fa-ticket"></i>
    <span>LODGE TICKET</span>
</a>
    </div>

    <span class="muted-pill">
      <i class="fa-solid fa-user-shield"></i>
      Admin: <strong class="text-dark">{{ Auth::user()->name }}</strong>
    </span>
  </div>

  {{-- SUCCESS --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" id="successAlert" role="alert">
      <i class="fa-solid fa-circle-check"></i>
      <div class="fw-semibold">{{ session('success') }}</div>
    </div>
  @endif

  {{-- USERS --}}
  @forelse($tickets as $userId => $userTickets)

    @php $user = $userTickets->first()->user; @endphp

    <div class="user-card">

      <!-- USER HEADER -->
      <div class="user-header">
        <div>
          <h5>
            <i class="fa-solid fa-user me-1 text-muted"></i>
            {{ $user->name ?? 'Unknown User' }}
            <button
  type="button"
  class="btn btn-sm btn-dark ms-2 position-relative"
  data-user-id="{{ $user->id }}"
  data-user-name="{{ $user->name }}"
  onclick="startAdminChat(this)"
>
  <i class="fa-solid fa-comments me-1"></i> Chat

  <!-- ✅ ADD THIS -->
  <span id="chatBadge-{{ $user->id }}" class="chat-badge">0</span>
</button>
          </h5>
          <small>{{ $user->email ?? 'No email' }}</small>
        </div>

        <div class="d-flex align-items-center gap-2">
    <span class="badge bg-primary count-badge">
      {{ $userTickets->count() }} Ticket(s)
    </span>

    <!-- ✅ REALTIME ONLINE/OFFLINE -->
    <span class="badge bg-secondary" id="user-presence-{{ $user->id }}">Offline</span>
  </div>
      </div>

      <!-- TABLE -->
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Ticket #</th>
              <th>Branch</th>
              <th>Concern</th>
              <th>Dept</th>
              <th>Priority</th>
              <th>Status</th>
              <th>Date Submitted</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody>
          @foreach($userTickets as $ticket)
            <tr>
              <td class="fw-semibold">{{ $ticket->ticket_no }}</td>
              <td class="fw-semibold">{{ $ticket->subject }}</td>

              <!-- Concern + View (magkatabi + clamped preview) -->
              <td class="concern-cell">
                <div class="concern-row">
                  <div class="description-box" title="Click View to see full concern">
                      ...........
                    </div>

                  <button
                    type="button"
                    class="btn btn-sm btn-view view-ticket"
                    data-bs-toggle="modal"
                    data-bs-target="#concernModal"
                    data-ticket-id="{{ $ticket->id }}"
                    data-ticket="{{ $ticket->ticket_no }}"
                    data-user="{{ $user->name ?? 'Unknown User' }}"
                    data-user-id="{{ $user->id }}"
                    data-branch="{{ $ticket->subject }}"
                    data-dept="{{ ucfirst($ticket->department) }}"
                    data-priority="{{ ucfirst($ticket->priority) }}"
                    {{-- @php
$isReview = $ticket->status === 'in_progress' && $ticket->approval_requested;
@endphp

data-status="{{ $isReview ? 'Requesting' : ucwords(str_replace('_',' ', $ticket->status)) }}" --}}
                    data-date="{{ $ticket->created_at->format('M d, Y • h:i A') }}"
                    data-pending="{{ $ticket->pending_at ?? $ticket->created_at }}"
                    data-inprogress="{{ $ticket->in_progress_at }}"
                    data-resolved="{{ $ticket->resolved_at }}"
                    data-concern="{{ $ticket->description }}"
                    aria-label="View full concern"
                  >
                    <i class="fa-regular fa-eye me-1"></i> View
                  </button>
                  
                </div>
              </td>

              <td>{{ ucfirst($ticket->department) }}</td>

              <td>
                <span class="badge
                  {{ $ticket->priority === 'high' ? 'bg-danger'
                      : ($ticket->priority === 'medium' ? 'bg-warning text-dark'
                      : ($ticket->priority === 'low' ? 'bg-info'
                      : 'bg-secondary')) }} p-2">
                  {{ ucfirst($ticket->priority) }}
                </span>
              </td>

              @php
  $isReview = $ticket->status === 'in_progress' && $ticket->approval_requested;
@endphp

<td>
  <span class="badge
    {{ $ticket->status === 'pending' ? 'bg-danger'
        : ($isReview ? 'bg-warning text-dark'
        : ($ticket->status === 'in_progress' ? 'bg-primary'
        : ($ticket->status === 'resolved' ? 'bg-success'
        : 'bg-secondary'))) }} p-2">

    {{ $isReview ? 'Requesting' : ucwords(str_replace('_',' ', $ticket->status)) }}

  </span>
</td>

              <td>
<div class="small text-muted">

{{ $ticket->created_at->format('M d, Y') }} <br>

</div>
</td>

              <td class="text-center">
  <div class="action-wrap dropdown">
    <button class="action-menu-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open actions">
      <i class="fa-solid fa-ellipsis"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end action-menu">

    @php
  $isReview = $ticket->status === 'in_progress' && $ticket->approval_requested;
@endphp

<button
  type="button"
  class="btn btn-sm btn-warning request-approval"
  data-ticket-id="{{ $ticket->id }}"
  title="Request user confirmation"
  {{ $isReview ? 'disabled' : '' }}
>
  <i class="fa-solid {{ $isReview ? 'fa-hourglass-half' : 'fa-paper-plane' }}"></i>
  {{ $isReview ? 'Requesting' : 'Request' }}
</button>

@php
  $isLocked = $ticket->status === 'resolved' || $ticket->approval_requested;
@endphp

<button
  type="button"
  class="btn btn-sm btn-info transfer-ticket"
  data-ticket-id="{{ $ticket->id }}"
  data-current-dept="{{ $ticket->department }}"
  title="{{ $isLocked ? 'Transfer disabled' : 'Transfer to another department' }}"
  {{ $isLocked ? 'disabled' : '' }}
>
  <i class="fa-solid {{ $isLocked ? 'fa-lock' : 'fa-share' }}"></i>
  {{ $isLocked ? 'Transfer Locked' : 'Transfer' }}
</button>

    {{-- <!-- DELETE -->
    <form method="POST"
          action="{{ route('admin.tickets.destroy', $ticket) }}"
          class="m-0"
          onsubmit="return confirm('Delete this ticket permanently?')">
      @csrf
      @method('DELETE')
      @php
  $isDeleteAllowed = $ticket->status === 'resolved';
@endphp

<button 
  class="btn btn-sm btn-danger"
  aria-label="Delete"
  {{ !$isDeleteAllowed ? 'disabled' : '' }}
  title="{{ !$isDeleteAllowed ? 'Only resolved tickets can be deleted' : 'Delete ticket' }}"
>
  <i class="fa-solid {{ $isDeleteAllowed ? 'fa-trash' : 'fa-lock' }}"></i>
</button>
    </form> --}}

    </div>
  </div>
</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>

    </div>

  @empty
    <div class="no-tickets">
      <div class="text-center py-5 text-muted">
        <i class="fa-solid fa-ticket fa-2x mb-2"></i><br>
        No support tickets available
      </div>
    </div>
  @endforelse

  <!-- MODAL (CENTERED + RESPONSIVE) -->
  <div class="modal fade" id="concernModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header">
          <div class="w-100">
            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
              <h5 class="modal-title mb-0">
                Ticket <span id="m_ticket">—</span>
              </h5>
              {{-- <span class="badge bg-dark" id="m_status">—</span> --}}
            </div>

            <div class="text-muted mt-1" style="font-weight:650;">
              <span id="m_user">—</span> • <span id="m_date">—</span>
            </div>

            <div id="m_timeline" class="fw-bold mt-2"></div>
            
            <div class="mt-2 d-flex gap-2 flex-wrap meta-badges">
              <span class="badge bg-secondary" id="m_branch">—</span>
              <span class="badge bg-secondary" id="m_dept">—</span>
              <span class="badge bg-secondary" id="m_priority">—</span>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <div class="text-muted mb-2" style="font-weight:900; font-size:12px; letter-spacing:.06em; text-transform:uppercase;">
            Concern Details
          </div>
          <div id="m_concern" class="concern-full">—</div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

</main>
<!-- ✅ APPROVAL JUSTIFICATION MODAL -->
<div class="modal fade" id="approvalModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Request Approval</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label class="fw-bold mb-2">Justification</label>
        <textarea 
          id="approvalJustification" 
          class="form-control"
          rows="4"
          placeholder="Enter reason before requesting approval..."></textarea>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-warning" id="confirmApprovalBtn">
          Send Request
        </button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="transferModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Transfer Ticket</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <label class="fw-bold mb-2">Select Department</label>
        <select id="transferDept" class="form-select mb-3" required>
  <option value="" disabled selected>Choose</option>
</select>

        <label class="fw-bold mb-2">Reason</label>
        <textarea id="transferReason" class="form-control"></textarea>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-info" id="confirmTransferBtn">
  <span class="btn-text">Transfer</span>
  <span class="btn-loading d-none">
    <i class="fa-solid fa-arrows-rotate fa-spin"></i> Transferring...
  </span>
</button>
      </div>

    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(() => {
"use strict";

const $ = (sel, parent=document) => parent.querySelector(sel);
const $$ = (sel, parent=document) => [...parent.querySelectorAll(sel)];

function safeText(el, text){
  if(el) el.textContent = text ?? "—";
}

function safeHTML(el, html){
  if(el) el.innerHTML = html ?? "";
}

const CSRF = document.querySelector('meta[name="csrf-token"]')?.content;

let selectedTicketId = null;
let transferTicketId = null;

document.addEventListener("DOMContentLoaded", () => {

  initPresence();
  initAlerts();
  initEventDelegation();

  refreshAdminBadges();
  refreshTicketStatus();

  setInterval(refreshPresence, 5000);
  setInterval(refreshAdminBadges, 4000); // 🔥 less spam
  setInterval(refreshTicketStatus, 4000); // 🔥 less spam

});

function initAlerts(){
  const alert = $("#successAlert");
  if (!alert) return;

  setTimeout(() => alert.classList.remove("show"), 3500);
  setTimeout(() => alert.remove(), 4200);
}

let userIds = [];

function initPresence(){
  userIds = $$('[id^="user-presence-"]')
    .map(el => Number(el.id.replace("user-presence-","")))
    .filter(n => n > 0);

  refreshPresence();
}

async function refreshPresence(){
  if(!userIds.length) return;

  try{
    const url = `/support/presence/status?user_ids=${userIds.join(",")}`;
    const res = await fetch(url, { headers:{ "Accept":"application/json" }});
    if(!res.ok) return;

    const data = await res.json();

    (data.users || []).forEach(u => {
      const el = document.getElementById(`user-presence-${u.id}`);
      if(!el) return;

      el.textContent = u.online ? "Online" : "Offline";
      el.classList.toggle("bg-success", u.online);
      el.classList.toggle("bg-secondary", !u.online);
    });

  }catch(e){
    console.log("Presence error:", e);
  }
}

window.startAdminChat = function(btn){

  const userId = Number(btn?.dataset?.userId);
  const userName = btn?.dataset?.userName || "User";

  if(!userId){
    alert("Invalid user");
    return;
  }

  const chatBox = $("#chatbox");
  if(chatBox){
    chatBox.style.display = "flex";
    chatBox.classList.add("open");
  }

  const badge = document.getElementById("chatBadge-" + userId);
  if(badge){
    badge.style.display = "none";
    badge.textContent = "0";
  }

  if(typeof window.startAccountChat === "function"){
  const dept = document.querySelector('meta[name="chat-department"]')?.content || "";
  window.startAccountChat(userId, "Chat with " + userName + (dept ? " - " + dept.toUpperCase() : ""));
}

  setTimeout(refreshAdminBadges, 500);
};

function handleViewTicket(btn){

  safeText($("#m_ticket"), btn.dataset.ticket);
  safeText($("#m_user"), btn.dataset.user);
  safeText($("#m_branch"), "Branch: " + (btn.dataset.branch || "—"));
  safeText($("#m_dept"), "Dept: " + (btn.dataset.dept || "—"));
  safeText($("#m_priority"), "Priority: " + (btn.dataset.priority || "—"));
  safeText($("#m_date"), btn.dataset.date);

  const status = btn.dataset.status || "—";
  const statusEl = $("#m_status");

  if(statusEl){
    statusEl.className = "badge";
    statusEl.textContent = status;

    const s = status.toLowerCase();

    if(s.includes("pending")) statusEl.classList.add("bg-danger");
    else if(s.includes("requesting")) statusEl.classList.add("bg-warning","text-dark");
    else if(s.includes("progress")) statusEl.classList.add("bg-primary");
    else if(s.includes("resolved")) statusEl.classList.add("bg-success");
    else statusEl.classList.add("bg-dark");
  }

  safeText($("#m_concern"), btn.dataset.concern);

  computeTimeline(btn);

  // mark viewed
  fetch(`/admin/tickets/${btn.dataset.ticketId}/view`, {
    method: "PATCH",
    headers:{
      "X-CSRF-TOKEN": CSRF,
      "Accept": "application/json"
    }
  }).catch(()=>{});
}

function diffTime(start, end){
  if(!start || !end) return "-";

  const diff = Math.floor((new Date(end) - new Date(start)) / 1000);

  if(diff <= 0) return "1 min";

  const d = Math.floor(diff / 86400);
  const h = Math.floor(diff / 3600);
  const m = Math.floor(diff / 60);

  if(d) return d + " day(s)";
  if(h) return h + " hour(s)";
  if(m) return m + " min(s)";
  return "1 min";
}

function computeTimeline(btn){

  const created = btn.dataset.pending || btn.dataset.date;
  const inProgress = btn.dataset.inprogress !== "null" ? btn.dataset.inprogress : null;
  const resolved = btn.dataset.resolved !== "null" ? btn.dataset.resolved : null;

  const pendingTime = created
    ? diffTime(created, inProgress || new Date())
    : "-";

  const progressTime = inProgress
    ? diffTime(inProgress, resolved || new Date())
    : "-";

  const resolvedTime = resolved ? "Done" : "-";

  safeHTML($("#m_timeline"), `
    <div class="text-danger">Pending: ${pendingTime}</div>
    <div class="text-primary">In Progress: ${progressTime}</div>
    <div class="text-success">Resolved: ${resolvedTime}</div>
  `);
}

async function handleApproval(){

  const justification = $("#approvalJustification")?.value?.trim();

  if(!justification){
    alert("Justification required");
    return;
  }

  const loader = $("#globalLoader");

  const btn = document.querySelector(`.request-approval[data-ticket-id="${selectedTicketId}"]`);

if(btn){
  btn.disabled = true;
  btn.innerHTML = `<i class="fa-solid fa-hourglass-half"></i>`;
}

  try{
    loader?.classList.remove("d-none");

    const res = await fetch(`/admin/headoffice-portals/tickets/${selectedTicketId}/request-approval`, {
      method: "POST",
      headers:{
        "X-CSRF-TOKEN": CSRF,
        "Accept": "application/json"
      },
      body: new URLSearchParams({ justification })
    });

    if(!res.ok) throw new Error();

    showToast('<i class="fa-solid fa-circle-check me-2"></i>Request submitted');

    bootstrap.Modal.getInstance($("#approvalModal"))?.hide();

  }catch{
    showToast("Failed", "error");
  }finally{
    loader?.classList.add("d-none");
  }
}

async function handleTransfer(){

  const dept = $("#transferDept")?.value;
  const reason = $("#transferReason")?.value;

  if(!dept){
    showToast("Please select a department", "error");
    $("#transferDept").classList.add("is-invalid");
    return;
  }else{
    $("#transferDept").classList.remove("is-invalid");
  }

  const btn = $("#confirmTransferBtn");
  const text = btn.querySelector(".btn-text");
  const loading = btn.querySelector(".btn-loading");

  try{

    btn.disabled = true;
    text.classList.add("d-none");
    loading.classList.remove("d-none");

    const res = await fetch(`/admin/tickets/${transferTicketId}/transfer`, {
      method: "POST",
      headers:{
        "X-CSRF-TOKEN": CSRF,
        "Accept": "application/json"
      },
      body: new URLSearchParams({ department: dept, reason })
    });

    if(!res.ok) throw new Error();

    showToast("Transferred successfully");

    setTimeout(() => location.reload(), 800);

  }catch{

    showToast("Transfer failed", "error");

    btn.disabled = false;
    text.classList.remove("d-none");
    loading.classList.add("d-none");

  }

}

async function refreshAdminBadges(){

  const dept = document.querySelector('meta[name="chat-department"]')?.content;

  for(const el of $$('[id^="chatBadge-"]')){

    const userId = el.id.replace("chatBadge-","");

    try{
      const res = await fetch(`/support/unread-count?user_id=${userId}&department=${dept}`);
      const data = await res.json();

      if(data.count > 0){
        el.style.display = "inline-block";
        el.textContent = data.count > 9 ? "9+" : data.count;
      }else{
        el.style.display = "none";
      }

    }catch{}
  }
}

async function refreshTicketStatus(){

  try{
    const res = await fetch('/admin/tickets/status-list');
    const tickets = await res.json();

    tickets.forEach(ticket => {

      const row = document.querySelector(`.request-approval[data-ticket-id="${ticket.id}"]`)?.closest("tr");
      if(!row) return;

      const badge = row.querySelector('td:nth-child(6) .badge');

      if(!badge) return;

      const approvalBtn = row.querySelector('.request-approval');
      const transferBtn = row.querySelector('.transfer-ticket');
      const deleteBtn = row.querySelector('.btn-danger');

// STATUS
if(ticket.status === "pending"){
  badge.className = "badge bg-danger p-2";
  badge.textContent = "Pending";
}
else if(ticket.approval_requested){
  badge.className = "badge bg-warning text-dark p-2";
  badge.textContent = "Requesting";
}
else if(ticket.status === "in_progress"){
  badge.className = "badge bg-primary p-2";
  badge.textContent = "In Progress";
}
else if(ticket.status === "resolved"){
  badge.className = "badge bg-success p-2";
  badge.textContent = "Resolved";
}

if(approvalBtn){

  if(ticket.approval_requested){
    approvalBtn.disabled = true;
    approvalBtn.innerHTML = `<i class="fa-solid fa-hourglass-half"></i> Requesting`;
  }

  else if(ticket.status === "pending"){
  approvalBtn.disabled = true;
  approvalBtn.innerHTML = `<i class="fa-solid fa-paper-plane"></i> Request`;
}
  else if(ticket.status === "in_progress"){
    approvalBtn.disabled = false;
    approvalBtn.innerHTML = `<i class="fa-solid fa-paper-plane"></i> Request`;
  }

  else if(ticket.status === "resolved"){
    approvalBtn.disabled = true;
    approvalBtn.innerHTML = `<i class="fa-solid fa-check"></i> Resolved`;
  }

}

if(transferBtn){

  if(ticket.status === "resolved" || ticket.approval_requested){
    transferBtn.disabled = true;
    transferBtn.innerHTML = `<i class="fa-solid fa-lock"></i> Transfer Locked`;
  }else{
    transferBtn.disabled = false;
    transferBtn.innerHTML = `<i class="fa-solid fa-share"></i> Transfer`;
  }

}

if(deleteBtn){

  if(ticket.status === "resolved"){
    deleteBtn.disabled = false;
    deleteBtn.innerHTML = `<i class="fa-solid fa-trash"></i>`;
    deleteBtn.title = "Delete ticket";
  }else{
    deleteBtn.disabled = true;
    deleteBtn.innerHTML = `<i class="fa-solid fa-lock"></i>`;
    deleteBtn.title = "Only resolved tickets can be deleted";
  }

}

    });

  }catch(e){
    console.log("Status error:", e);
  }
}

function showToast(msg, type="success"){

  const container = $("#toastContainer");
  if(!container) return;

  const toast = document.createElement("div");

  toast.className = `toast show text-white ${type==="success"?"bg-success":"bg-danger"} mb-2`;
  toast.innerHTML = `<div class="toast-body">${msg}</div>`;

  container.appendChild(toast);

  setTimeout(()=>toast.remove(), 3000);
}

function initEventDelegation(){

  document.addEventListener("click", e => {

    const view = e.target.closest(".view-ticket");
    if(view) return handleViewTicket(view);

    const approval = e.target.closest(".request-approval");
    if(approval){
      selectedTicketId = approval.dataset.ticketId;
      new bootstrap.Modal($("#approvalModal")).show();
    }

    const transfer = e.target.closest(".transfer-ticket");
if(transfer){

  transferTicketId = transfer.dataset.ticketId;

  const currentDept = transfer.dataset.currentDept;

  const select = document.getElementById("transferDept");

  // 🔥 reset options
  const allDepts = {
    it: "IT",
    hr: "HR",
    smm: "SMM",
    "admin-secretary": "Admin Secretary",
    od: "OD",
    om: "OM"
  };

  select.innerHTML = `<option value="" disabled selected>Choose</option>`;

Object.entries(allDepts).forEach(([key, label]) => {

  if(key === currentDept){
    // 🔥 current department (disabled)
    select.innerHTML += `<option value="${key}" disabled>${label} (Current)</option>`;
  } else {
    // normal options
    select.innerHTML += `<option value="${key}">${label}</option>`;
  }

});

  new bootstrap.Modal($("#transferModal")).show();
}

  });

  $("#confirmApprovalBtn")?.addEventListener("click", handleApproval);
  $("#confirmTransferBtn")?.addEventListener("click", handleTransfer);

}

})();
</script>


@include('partials.chatbot', ['isAdmin' => true])
</body>
</html>


