<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Admin · Support Tickets</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

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

    --primary-dark: #0f172a;
  }

  body{
    background:
      radial-gradient(1200px 650px at 18% 0%, rgba(13,110,253,.08), transparent 55%),
      radial-gradient(900px 520px at 95% 10%, rgba(34,197,94,.07), transparent 55%),
      var(--bg);
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
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .page-header::after{
    content:"";
    position:absolute;
    right:-90px; top:-90px;
    width: 260px; height: 260px;
    pointer-events:none;
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

  .user-header small{
    color: var(--muted);
  }

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

  table{
    margin-bottom: 0;
    font-size: 14px;
    min-width: 1100px; /* scroll on small screens */
    
  }

  .table thead{
    background: #111827;
  }

  .table thead th{
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: rgba(255,255,255,.9);
    white-space: nowrap;
    border-bottom: 0;
    background: rgb(90, 90, 90);
  }

  .table tbody tr{
    transition: background .15s ease;
  }

  .table-hover tbody tr:hover{
    background: rgba(13,110,253,.05);
  }

  /* description clamp */
  .description-box{
    max-width: 420px;
    font-size: 13px;
    color: var(--muted);
    line-height: 1.4;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    word-break: break-word;
  }

  @media (max-width: 1200px){
    .description-box{ max-width: 320px; }
  }

  /* ===== ACTIONS ===== */
  .action-wrap{
    display:flex;
    gap: 8px;
    align-items: center;
    justify-content: center;
  }

  .form-select-sm{
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
    padding-right: 2rem;
  }

  .btn{
    font-weight: 900;
    border-radius: 999px;
  }

  .btn-danger{
    padding: 6px 12px;
  }

  @media (max-width: 768px){
    .action-wrap{
      flex-direction: column;
      align-items: stretch;
    }
    .action-wrap form,
    .action-wrap select,
    .action-wrap button{
      width: 100%;
    }
  }

  /* ===== EMPTY STATE ===== */
  .no-tickets{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: var(--shadow);
    overflow: hidden;
    backdrop-filter: blur(10px);
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
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
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
          </h5>
          <small>{{ $user->email ?? 'No email' }}</small>
        </div>

        <span class="badge bg-primary count-badge">
          {{ $userTickets->count() }} Ticket(s)
        </span>
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

              <td>
                <div class="description-box" title="{{ $ticket->description }}">
                  {{ $ticket->description }}
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
                  {{ $ticket->created_at->format('M d, Y') }} <br>
                  <span class="text-secondary">{{ $ticket->created_at->format('h:i A') }}</span>
                </div>
              </td>

              <td class="text-center">
                <div class="action-wrap">

                  {{-- STATUS --}}
                  <span class="badge
  {{ $ticket->status === 'pending' ? 'bg-danger'
      : ($ticket->status === 'in_progress' ? 'bg-primary'
      : ($ticket->status === 'resolved' ? 'bg-success'
      : 'bg-secondary')) }} p-2">
  {{ ucwords(str_replace('_',' ', $ticket->status)) }}
</span>


                  {{-- DELETE --}}
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

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const alert = document.getElementById('successAlert');
  if (!alert) return;

  setTimeout(() => {
    alert.classList.remove('show');
  }, 3500);

  setTimeout(() => {
    alert.remove();
  }, 4200);
});
</script>
</body>
</html>
