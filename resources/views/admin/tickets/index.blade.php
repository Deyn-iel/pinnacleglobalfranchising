<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Admin · Support Tickets</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="chat-department" content="">
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite(['resources/css/admin/app.css', 
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

/* Force same width ng Concern column across rows */
table{
  table-layout: fixed; 
}

/* Set fixed width for each column (adjust if you want) */
th:nth-child(1), td:nth-child(1){ width: 140px; } /* Ticket # */
th:nth-child(2), td:nth-child(2){ width: 120px; } /* Branch */
th:nth-child(3), td:nth-child(3){ width: 260px; } 
th:nth-child(4), td:nth-child(4){ width: 120px; } /* Dept */
th:nth-child(5), td:nth-child(5){ width: 110px; } /* Priority */
th:nth-child(6), td:nth-child(6){ width: 110px; } /* Status */
th:nth-child(7), td:nth-child(7){ width: 160px; } /* Date */
th:nth-child(8), td:nth-child(8){ width: 90px; }  /* Actions */


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

  .user-card .table tbody tr:hover,
  .user-card .table tbody tr:hover > * {
    background: transparent !important;
    --bs-table-bg-state: transparent !important;
  }

  /* ===== CONCERN + VIEW (SIDE BY SIDE) ===== */
  .concern-cell{
    min-width: 220px;
    max-width: 360px;
  }

  .concern-row{
    display:flex;
    align-items:center; /* center button vertically */
    gap: 10px;
    min-width: 0; /* IMPORTANT for flex shrink */
  }

.description-box{
  flex: 1 1 auto;
  min-width: 0;               /* important for ellipsis inside flex */
  width: 100%;

  font-size: 14px;
  color: #0f172a;
  line-height: 1.45;
  font-weight: 650;

  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(15,23,42,.10);
  background: rgba(15,23,42,.03);

  /* ✅ ONE-LINE PREVIEW ONLY */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}


  .btn-view{
    flex: 0 0 auto;
    border-radius: 999px;
    font-weight: 900;
    padding: 8px 12px;
    border: 1px solid rgba(15,23,42,.12);
    background: #fff;
    white-space: nowrap;
    min-width: 86px;
  }
  .btn-view:hover{ background: rgba(15,23,42,.04); }

  /* Keep clamp consistent (no conflicting overrides) */
  @media (max-width: 1200px){
    .concern-cell{ min-width: 420px; }
    .description-box{ -webkit-line-clamp: 2; }
  }

  @media (max-width: 768px){
    table{ min-width: 980px; }
    .concern-cell{ min-width: 380px; max-width: 520px; }
    .description-box{ -webkit-line-clamp: 2; }
  }

  /* ===== ACTIONS ===== */
  .action-wrap{
    display:flex;
    gap: 8px;
    align-items: center;
    justify-content: center;
  }

  .btn{ font-weight: 900; border-radius: 999px; }
  .btn-danger{ padding: 6px 12px; }

  @media (max-width: 768px){
    .action-wrap{
      flex-direction: column;
      align-items: stretch;
    }
    .action-wrap form,
    .action-wrap button{ width: 100%; }
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

  /* ===== MODAL (CENTERED + RESPONSIVE) ===== */
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

    /* also handle super long no-space words in modal */
    overflow-wrap: anywhere;
    word-break: break-word;
    word-break: break-all;
  }

  @media (max-width: 576px){
    .modal-dialog{ margin: 0; }
    .modal-content{ border-radius: 0 !important; }
  }

  #chatbox.chat-readonly #ticketChatInput,
#chatbox.chat-readonly #ticketChatSend,
#chatbox.chat-readonly #clear-chat,
#chatbox.chat-readonly #delete-chat,
#chatbox.chat-readonly #fileInput,
#chatbox.chat-readonly #filePreviewContainer,
#chatbox.chat-readonly #uploadStatus{
  display: none !important;
}

#chatbox.chat-readonly #ticketChatHint::after{
  content: " • View only";
  font-weight: 700;
  color: #64748b;
}

.user-info-block{
  display: flex;
  flex-direction: column;
  gap: 6px;
  min-width: 0;
}

.user-name-row{
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.chat-dept-actions{
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}

.dept-chat-btn{
  padding: 6px 10px;
  border-radius: 999px;
  font-size: 12px;
  line-height: 1.1;
}
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

  <!-- HEADER -->
  <div class="page-header">
    <div>
      <h3><i class="fa-solid fa-ticket me-2"></i>Support Tickets</h3>
      <p class="text-muted mb-0">View tickets by account</p>
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
        @php
  $chatDepartments = $userTickets->pluck('department')
      ->filter()
      ->map(fn($d) => strtolower(trim($d)))
      ->unique()
      ->values();
@endphp

<div class="user-info-block">
  <div class="user-name-row">
    <h5 class="mb-0">
      <i class="fa-solid fa-user me-1 text-muted"></i>
      {{ $user->name ?? 'Unknown User' }}
    </h5>

    <div class="chat-dept-actions">
      @foreach($chatDepartments as $dept)
        <button
          type="button"
          class="btn btn-sm btn-dark dept-chat-btn"
          data-user-id="{{ $user->id }}"
          data-user-name="{{ $user->name }}"
          data-department="{{ $dept }}"
          onclick="startAdminChat(this)"
        >
          <i class="fa-solid fa-comments me-1"></i>
          {{ strtoupper($dept) }}
        </button>
      @endforeach
    </div>
  </div>

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
                  <div class="description-box" title="{{ $ticket->description }}">
  {{ \Illuminate\Support\Str::limit($ticket->description, 80) }}
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
                    data-status="{{ ucwords(str_replace('_',' ', $ticket->status)) }}"
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

              <td>
@php
  $isRequesting = $ticket->status === 'in_progress' && $ticket->approval_requested;
@endphp

<span class="badge
{{ $ticket->status === 'pending' ? 'bg-danger'
: ($isRequesting ? 'bg-warning text-dark'
: ($ticket->status === 'in_progress' ? 'bg-primary'
: ($ticket->status === 'resolved' ? 'bg-success'
: 'bg-secondary'))) }} p-2">

{{ $isRequesting 
    ? 'Requesting' 
    : ucwords(str_replace('_',' ',$ticket->status)) }}

</span>
</td>

              <td>
<div class="small text-muted">

{{ $ticket->created_at->format('M d, Y') }} 

</div>
</td>

              {{-- <td class="text-center">
                <div class="action-wrap">
                  <form method="POST"
                        action="{{ route('admin.tickets.destroy', $ticket) }}"
                        class="m-0"
                        onsubmit="return confirm('Delete this ticket permanently?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" aria-label="Delete">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td> --}}
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
              <span class="badge bg-dark" id="m_status">—</span>
            </div>

            <div class="text-muted mt-1" style="font-weight:650;">
              <span id="m_user">—</span> • 
              <span id="m_date">—</span> 
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

  <select id="chatDepartmentSelect" class="d-none" aria-hidden="true">
  <option value=""></option>
  <option value="it">IT</option>
  <option value="hr">HR</option>
  <option value="smm">SMM</option>
  <option value="admin-secretary">Admin Secretary</option>
  <option value="od">OD</option>
  <option value="om">OM</option>
</select>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {

  // ✅ ADMIN: refresh online/offline badges every 5s
const presenceEls = document.querySelectorAll('[id^="user-presence-"]');
const userIds = Array.from(presenceEls)
  .map(el => Number(el.id.replace('user-presence-','')))
  .filter(n => Number.isFinite(n) && n > 0);

async function refreshPresence(){
  if(!userIds.length) return;

  const url = new URL("/support/presence/status", window.location.origin);
  url.searchParams.set("user_ids", userIds.join(","));

  try{
    const res = await fetch(url.toString(), {
      method: "GET",
      credentials: "same-origin",
      headers: { "Accept": "application/json", "X-Requested-With": "XMLHttpRequest" }
    });

    if(!res.ok) return;
    const data = await res.json();

    (data.users || []).forEach(u => {
      const el = document.getElementById(`user-presence-${u.id}`);
      if(!el) return;

      if(u.online){
        el.textContent = "Online";
        el.classList.remove("bg-secondary");
        el.classList.add("bg-success");
      }else{
        el.textContent = "Offline";
        el.classList.remove("bg-success");
        el.classList.add("bg-secondary");
      }
    });
  }catch(e){}
}

refreshPresence();
setInterval(refreshPresence, 5000);

  // success alert fade out
  const alert = document.getElementById('successAlert');
  if (alert){
    setTimeout(() => alert.classList.remove('show'), 3500);
    setTimeout(() => alert.remove(), 4200);
  }

  // ✅ VIEW button only opens modal (NO CHAT HERE)
  document.addEventListener('click', async (e) => {

  const btn = e.target.closest('[data-bs-target="#concernModal"]');
  if(!btn) return;

  const ticketId = btn.dataset.ticketId;


  // ✅ UPDATE TABLE BADGE AGAD
  const row = btn.closest('tr');
  const badge = row.querySelector('td:nth-child(6) .badge');


  // ✅ NOW OPEN MODAL WITH UPDATED STATUS
  const status = badge ? badge.innerText.trim() : (btn.dataset.status || '—');

  document.getElementById('m_ticket').innerText = btn.dataset.ticket || '—';
  document.getElementById('m_user').innerText   = btn.dataset.user || '—';
  document.getElementById('m_branch').innerText = 'Branch: ' + (btn.dataset.branch || '—');
  document.getElementById('m_dept').innerText   = 'Dept: ' + (btn.dataset.dept || '—');
  document.getElementById('m_priority').innerText = 'Priority: ' + (btn.dataset.priority || '—');
  document.getElementById('m_date').innerText   = btn.dataset.date || '—';

function diffTime(start, end){
  if(!start || !end) return "-";

  const diff = Math.floor((new Date(end) - new Date(start)) / 1000);

  const m = Math.floor(diff / 60);
  const h = Math.floor(diff / 3600);
  const d = Math.floor(diff / 86400);

  if(d > 0) return d + " day(s)";
  if(h > 0) return h + " hour(s)";
  if(m > 0) return m + " min(s)";
  return "1 min(s)"; // ✅ FIX ZERO ISSUE
}

  const statusEl = document.getElementById('m_status');
  statusEl.innerText = status;

  statusEl.className = 'badge';
  const s = status.toLowerCase();
  if(s.includes('pending')) statusEl.classList.add('bg-danger');
  else if(s.includes('progress')) statusEl.classList.add('bg-primary');
  else if(s.includes('resolved')) statusEl.classList.add('bg-success');
  else statusEl.classList.add('bg-dark');

  document.getElementById('m_concern').innerText = btn.dataset.concern || '—';

const created = btn.dataset.pending;

const rawInProgress = btn.dataset.inprogress;

const inProgress = (
  rawInProgress &&
  rawInProgress !== "null" &&
  rawInProgress !== created // ✅ KEY FIX
) ? rawInProgress : null;

const resolved = btn.dataset.resolved && btn.dataset.resolved !== "null"
  ? btn.dataset.resolved
  : null;

const now = new Date();


// 🟥 PENDING
let pendingTime = "-";

if (created) {
  if (inProgress && inProgress !== created) {
    // ✅ STOP kapag nag in progress na
    pendingTime = diffTime(created, inProgress);
  } else {
    // still pending
    pendingTime = diffTime(created, now);
  }
}

// 🟦 IN PROGRESS
let progressTime = "-";

if (inProgress) {
  if (resolved) {
    // ✅ STOP kapag resolved na
    progressTime = diffTime(inProgress, resolved);
  } else {
    // still in progress
    progressTime = diffTime(inProgress, now);
  }
}

let resolvedTime = resolved ? "Done" : "-";

document.getElementById('m_timeline').innerHTML = `
  <div class="d-flex align-items-center gap-2 text-danger">
    <i class="fa-solid fa-hourglass-half"></i>
    <span>Pending: ${pendingTime}</span>
  </div>

  <div class="d-flex align-items-center gap-2 text-primary">
    <i class="fa-solid fa-gear"></i>
    <span>In Progress: ${progressTime}</span>
  </div>

  <div class="d-flex align-items-center gap-2 text-success">
    <i class="fa-solid fa-circle-check"></i>
    <span>Resolved: ${resolvedTime}</span>
  </div>
`;

});
});

function setAdminChatReadOnly(enabled = true){
  const chatBox = document.getElementById("chatbox");
  if (!chatBox) return;

  chatBox.classList.toggle("chat-readonly", enabled);

  const input   = document.getElementById("ticketChatInput");
  const send    = document.getElementById("ticketChatSend");
  const clear   = document.getElementById("clear-chat");
  const del     = document.getElementById("delete-chat");
  const file    = document.getElementById("fileInput");
  const preview = document.getElementById("filePreviewContainer");
  const upload  = document.getElementById("uploadStatus");

  if (input) {
    input.value = "";
    input.readOnly = true;
    input.disabled = true;
    input.placeholder = "View only";
  }

  [send, clear, del, file, preview, upload].forEach(el => {
    if (el) el.style.display = enabled ? "none" : "";
  });
}

window.startAdminChat = function(btn){
  const targetUserId = Number(btn?.dataset?.userId || 0);
  const userName = btn?.dataset?.userName || "User";
  const department = String(btn?.dataset?.department || "").trim().toLowerCase();

  if (!Number.isFinite(targetUserId) || targetUserId <= 0) {
    alert("Invalid user selected.");
    return;
  }

  if (!department) {
    alert("No department selected.");
    return;
  }

  const deptSelect = document.getElementById("chatDepartmentSelect");
  if (deptSelect) {
    deptSelect.value = department;
    deptSelect.dispatchEvent(new Event("change", { bubbles: true }));
  }

  const chatBox = document.getElementById("chatbox");
  if (chatBox) {
    chatBox.style.display = "flex";
    chatBox.classList.add("open");
    chatBox.setAttribute("aria-hidden", "false");
  }

  if (typeof window.startAccountChat === "function") {
    window.startAccountChat(
      targetUserId,
      "Chat with " + userName + " - " + department.toUpperCase()
    );

    // re-apply readonly after app.js opens the chat
    setTimeout(() => setAdminChatReadOnly(true), 150);
    setTimeout(() => setAdminChatReadOnly(true), 500);
  } else {
    console.log("startAccountChat not found. Make sure chatbot/app.js is loaded.");
    alert("Chat system not ready. Check if chatbot/app.js is loaded.");
  }
};




</script>


 @include('partials.chatbot', ['isAdmin' => true])
</body>
</html>
