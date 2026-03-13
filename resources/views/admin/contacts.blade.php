<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Contact Messages</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

    --danger: #dc2626;
  }

  body{
    overflow-x: hidden;
    color: var(--text);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  }

  aside{
    width: var(--sidebar-w);
    z-index: 999;
  }

  /* ================= MAIN ================= */
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

  /* ================= HEADER ================= */
  .page-header{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: clamp(16px, 2vw, 22px);
    box-shadow: var(--shadow);
    margin-bottom: 16px;
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

  .page-header h4{
    font-weight: 900;
    margin-bottom: 4px;
    letter-spacing: -.02em;
  }

  .page-header p{
    color: var(--muted);
    margin: 0;
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
    font-weight: 800;
    white-space: nowrap;
  }

  /* ================= SUCCESS MSG ================= */
  .success-msg{
    background: rgba(34,197,94,.12);
    color: #166534;
    border: 1px solid rgba(34,197,94,.25);
    border-left: 6px solid #22c55e;
    padding: 12px 14px;
    border-radius: 14px;
    font-weight: 800;
    box-shadow: 0 12px 28px rgba(15,23,42,.08);
    transition: opacity .5s ease, transform .5s ease;
  }

  /* ================= TABLE WRAPPER ================= */
  .table-wrapper{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .table-responsive{
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  table{
    width: 100%;
    font-size: 14px;
    margin-bottom: 0;
    min-width: 920px; /* scroll on small screens */
  }

  th, td{
    vertical-align: middle;
  }

  th{
    white-space: nowrap;
  }

  td{
    color: #0f172a;
  }

  .table-hover tbody tr{
    transition: background .15s ease;
  }
  .table-hover tbody tr:hover{
    background: rgba(13,110,253,.05);
  }

  /* Message cell: clamp lines to keep table tidy */
  .msg-cell{
    max-width: 520px;
  }
  .msg-clamp{
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    word-break: break-word;
    white-space: normal;
  }

  /* ================= BUTTONS ================= */
  .btn{
    font-weight: 800;
    border-radius: 999px;
  }

  .btn-danger{
    background: var(--danger);
    border: none;
  }
  .btn-danger:hover{
    background: #b91c1c;
  }

  .btn-outline-danger{
    border-radius: 999px;
    font-weight: 800;
  }

  /* ================= EMPTY ROW ================= */
  .no-hover{
    pointer-events: none;
    background: transparent !important;
  }
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

  <!-- HEADER -->
  <div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
      <h4 class="fw-bold mb-1">
        <i class="fas fa-envelope me-2"></i>Contact Messages
      </h4>
      <p>Messages submitted through the contact form.</p>
    </div>

    <div class="d-flex gap-2 align-items-center flex-wrap">
      <span class="muted-pill">
        <i class="fa-solid fa-inbox"></i>
        Total: <strong class="text-dark">{{ $contacts->count() }}</strong>
      </span>

      @if($contacts->count() > 0)
      <form action="{{ route('admin.contacts.deleteAll') }}"
            method="POST"
            class="m-0"
            onsubmit="return confirm('⚠️ This will permanently delete ALL messages. Continue?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">
          <i class="fas fa-trash me-1"></i> Delete All
        </button>
      </form>
      @endif
    </div>
  </div>

  <!-- SUCCESS -->
  @if(session('success'))
    <div id="successMsg" class="success-msg mb-3">
      <i class="fa-solid fa-circle-check me-1"></i>
      {{ session('success') }}
    </div>
  @endif

  <!-- TABLE -->
  <div class="table-wrapper">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th style="width: 180px;">Name</th>
            <th style="width: 260px;">Email</th>
            <th>Message</th>
            <th style="width: 180px;">Date</th>
            <th class="text-center" style="width: 110px;">Action</th>
          </tr>
        </thead>

        <tbody>
          @forelse($contacts as $contact)
          <tr>
            <td class="fw-semibold">{{ $contact->name }}</td>
            <td>{{ $contact->email }}</td>

            <td class="msg-cell">
              <div class="msg-clamp" title="{{ $contact->message }}">
                {{ $contact->message }}
              </div>
            </td>

            <td class="text-muted small">
              {{ $contact->created_at->format('M d, Y · h:i A') }}
            </td>

            <td class="text-center">
              <form action="{{ route('admin.contacts.delete', $contact->id) }}"
                    method="POST"
                    class="m-0"
                    onsubmit="return confirm('Delete this message?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" aria-label="Delete">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center text-muted py-4 no-hover">
              No messages received yet.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</main>

<script>
  setTimeout(() => {
    const msg = document.getElementById('successMsg');
    if (msg) {
      msg.style.opacity = '0';
      msg.style.transform = 'translateY(-6px)';
      setTimeout(() => msg.remove(), 500);
    }
  }, 3000);
</script>

</body>
</html>
