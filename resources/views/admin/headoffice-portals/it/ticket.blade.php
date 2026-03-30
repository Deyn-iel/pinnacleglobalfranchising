<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>IT · Support Tickets</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

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

/* Force same width ng Concern column across rows */
table{
  table-layout: fixed; 
}

/* Set fixed width for each column (adjust if you want) */
th:nth-child(1), td:nth-child(1){ width: 140px; } /* Ticket # */
th:nth-child(2), td:nth-child(2){ width: 120px; } /* Branch */
th:nth-child(3), td:nth-child(3){ width: 560px; } 
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
  .table-hover tbody tr:hover{ background: rgba(13,110,253,.05); }

  /* ===== CONCERN + VIEW (SIDE BY SIDE) ===== */
  .concern-cell{
    min-width: 520px;
    max-width: 760px;
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
@include('admin.headoffice-portals.it.partials.sidebar')

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
        <div>
          <h5>
            <i class="fa-solid fa-user me-1 text-muted"></i>
            {{ $user->name ?? 'Unknown User' }}<button
  type="button"
  class="btn btn-sm btn-dark ms-2"
  data-user-id="{{ $user->id }}"
  data-user-name="{{ $user->name }}"
  onclick="startAdminChat(this)"
>
  <i class="fa-solid fa-comments me-1"></i> Chat
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
        <table class="table table-hover align-middle">
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
                    data-status="{{ ucwords(str_replace('_',' ', $ticket->status)) }}"
                    data-date="{{ $ticket->created_at->format('M d, Y • h:i A') }}"
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
                <span class="badge
                  {{ $ticket->status === 'pending' ? 'bg-danger'
                      : ($ticket->status === 'in_progress' ? 'bg-primary'
                      : ($ticket->status === 'resolved' ? 'bg-success'
                      : 'bg-secondary')) }} p-2">
                  {{ ucwords(str_replace('_',' ', $ticket->status)) }}
                </span>
              </td>

              <td>
<div class="small text-muted">

{{ $ticket->created_at->format('M d, Y') }} 

</div>
</td>

              <td class="text-center">
  <div class="action-wrap">

    <!-- ✅ REQUEST APPROVAL (PER TICKET) -->
    <button
      type="button"
      class="btn btn-sm btn-warning request-approval"
      data-ticket-id="{{ $ticket->id }}"
      title="Request user confirmation"
    >
      <i class="fa-solid fa-paper-plane"></i>
    </button>

    <!-- DELETE -->
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
              <span class="badge bg-dark" id="m_status">—</span>
            </div>

            <div class="text-muted mt-1" style="font-weight:650;">
              <span id="m_user">—</span> • <span id="m_date">—</span>
            </div>

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
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-bs-target="#concernModal"]');
    if(!btn) return;

    document.getElementById('m_ticket').innerText = btn.dataset.ticket || '—';
    document.getElementById('m_user').innerText   = btn.dataset.user || '—';
    document.getElementById('m_branch').innerText = 'Branch: ' + (btn.dataset.branch || '—');
    document.getElementById('m_dept').innerText   = 'Dept: ' + (btn.dataset.dept || '—');
    document.getElementById('m_priority').innerText = 'Priority: ' + (btn.dataset.priority || '—');
    document.getElementById('m_date').innerText   = btn.dataset.date || '—';

    const status = btn.dataset.status || '—';
    const statusEl = document.getElementById('m_status');
    statusEl.innerText = status;

    // reset badge class then apply
    statusEl.className = 'badge';
    const s = (status || '').toLowerCase();
    if(s.includes('pending')) statusEl.classList.add('bg-danger');
    else if(s.includes('progress')) statusEl.classList.add('bg-primary');
    else if(s.includes('resolved')) statusEl.classList.add('bg-success');
    else statusEl.classList.add('bg-dark');

    document.getElementById('m_concern').innerText = btn.dataset.concern || '—';

    // ❌ IMPORTANT: WALANG startAccountChat dito
  });
});

// ✅ CHAT button handler (global para gumana sa inline onclick)
window.startAdminChat = function(btn){
  const targetUserId = Number(btn?.dataset?.userId || 0);
  const userName = btn?.dataset?.userName || "User";

  if (!Number.isFinite(targetUserId) || targetUserId <= 0) {
    alert("Invalid user selected.");
    return;
  }

  if (typeof window.startAccountChat === "function") {
    window.startAccountChat(targetUserId, "Chat with " + userName);
  } else {
    console.log("startAccountChat not found. Make sure chatbot/app.js is loaded.");
    alert("Chat system not ready. Check if chatbot/app.js is loaded.");
  }
};

document.addEventListener('click', async function(e){

  const btn = e.target.closest('.view-ticket');
  if(!btn) return;

  const ticketId = btn.dataset.ticketId;

  try{

    const response = await fetch(`/admin/tickets/${ticketId}/view`, {
      method: "PATCH",
      headers:{
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    });

    if(response.ok){

      const currentStatus = (btn.dataset.status || '').toLowerCase();

      if(currentStatus.includes('resolved')) return;

      const row = btn.closest('tr');
      const badge = row.querySelector('td:nth-child(6) .badge');

      if(badge){
        badge.classList.remove('bg-danger');
        badge.classList.add('bg-primary');
        badge.textContent = 'In Progress';
      }

      btn.dataset.status = "In Progress";

      const modalStatus = document.getElementById('m_status');
      if(modalStatus){
        modalStatus.innerText = "In Progress";
        modalStatus.className = 'badge bg-primary';
      }
    }

  }catch(err){
    console.log(err);
  }

});

document.addEventListener('click', async function(e){

  const btn = e.target.closest('.request-approval');
  if(!btn) return;

  const ticketId = btn.dataset.ticketId;

  if(!confirm("Send approval request to this user?")) return;

  const loader = document.getElementById('globalLoader');

  try{

    // ✅ SHOW FULLSCREEN LOADER
    loader.classList.remove('d-none');

    const res = await fetch(`/admin/headoffice-portals/tickets/${ticketId}/request-approval`, {
      method: "POST",
      headers:{
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        "Accept": "application/json",
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    });

    const data = await res.json().catch(() => null);

    if(res.ok){

      showToast("Approval request sent successfully.");

    }else{

      console.error(data);
      showToast("Failed to send request.", "error");

    }

  }catch(err){

    console.log(err);
    showToast("Network error. Please try again.", "error");

  }finally{

    // ✅ HIDE LOADER ALWAYS
    loader.classList.add('d-none');

  }

});

function showToast(message, type = "success"){

  const container = document.getElementById('toastContainer');

  const toast = document.createElement('div');

  const bg = type === "success" ? "bg-success" : "bg-danger";
  const icon = type === "success"
    ? "fa-circle-check"
    : "fa-circle-xmark";

  toast.className = `toast align-items-center text-white ${bg} border-0 show toast-custom mb-2`;

  toast.innerHTML = `
    <div class="d-flex align-items-center">
      <div class="toast-body">
        <i class="fa-solid ${icon} me-2"></i> ${message}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto"></button>
    </div>
  `;

  container.appendChild(toast);

  // auto remove
  setTimeout(() => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 300);
  }, 3000);

  // manual close
  toast.querySelector('.btn-close').onclick = () => {
    toast.remove();
  };
}
</script>


  @include('partials.chatbot')
</body>
</html>
