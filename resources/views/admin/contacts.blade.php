<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Contact Messages</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite(['resources/css/admin/app.css'])

<style>
    body {
        background: #f5f6fa;
        overflow-x: hidden;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }

    aside {
        width: 260px;
        z-index: 999;
    }

    /* ================= MAIN ================= */
    main {
        margin-left: 260px;
        padding: clamp(20px, 2.5vw, 34px);
        max-width: calc(100vw - 260px);
    }

    /* ================= HEADER ================= */
    .page-header {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 22px;
        box-shadow: 0 10px 30px rgba(15,23,42,.08);
        margin-bottom: 22px;
    }

    /* ================= TABLE WRAPPER ================= */
    .table-wrapper {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 10px 28px rgba(15,23,42,.08);
        overflow: hidden;
    }

    table {
        width: 100%;
        table-layout: fixed;
        font-size: clamp(13px, 0.9vw, 14px);
        margin-bottom: 0;
    }

    th, td {
        vertical-align: middle;
        word-break: break-word;
        white-space: normal;
    }

    /* Column widths (desktop safe) */
    th:nth-child(1) { width: 160px; }
    th:nth-child(2) { width: 260px; }
    th:nth-child(3) { width: 40%; }
    th:nth-child(4) { width: 160px; }
    th:nth-child(5) { width: 90px; }

    /* ================= BUTTONS ================= */
    .btn-danger {
        font-size: 13px;
        padding: 5px 10px;
    }

    /* ================= SUCCESS MSG ================= */
    .success-msg {
        background: #dcfce7;
        color: #166534;
        border-left: 5px solid #22c55e;
        padding: 12px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: opacity .5s ease;
    }

    /* ================= SIDEBAR LINK ================= */
    .sidebar-link {
        border-radius: 8px;
        transition: background 0.25s ease, padding-left 0.25s ease;
        text-decoration: none;
    }

    .sidebar-link:hover {
        background: rgba(255,255,255,0.1);
    }

    .sidebar-link.active {
        background: rgba(255,255,255,0.18);
        border-left: 4px solid #0d6efd;
        padding-left: 14px;
    }

    .sidebar-link.active i {
        color: #ffffff;
    }

    /* ================= EMPTY ROW ================= */
    .no-hover {
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
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fas fa-envelope me-2"></i>Contact Messages
            </h4>
            <p class="text-muted mb-0">
                Messages submitted through the contact form.
            </p>
        </div>

        <div class="d-flex gap-2 align-items-center">
            <span class="text-muted small">
                Total: {{ $contacts->count() }}
            </span>

            @if($contacts->count() > 0)
            <form action="{{ route('admin.contacts.deleteAll') }}"
                  method="POST"
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
            ✔ {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td class="fw-semibold">{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td class="text-muted small">
                            {{ $contact->created_at->format('M d, Y · h:i A') }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.contacts.delete', $contact->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
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
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000);
</script>

</body>
</html>
