<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Contact Messages</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite([
    'resources/css/admin/app.css',
])
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar-link { text-decoration: none; }

        main {
            margin-left: 260px;
            padding: 30px;
        }

        @media (max-width: 768px) {
            main {
                margin-left: 0;
            }
        }

        .table thead {
            background: #1f2937;
            color: #fff;
        }

        .badge-new {
            background: #16a34a;
        }
        .success-msg {
            color: #16a34a;
            font-size: 14px;
            opacity: 1;
            transition: opacity 0.6s ease;
        }

        .btn-outline-danger {
            font-size: 13px;
            padding: 4px 10px;
        }
        .sidebar-link {
    border-radius: 8px;
    transition: background 0.25s ease, padding-left 0.25s ease;
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
.no-hover {
    pointer-events: none;
    background-color: transparent !important;
}

    </style>
</head>

<body x-data="{ open:false }">

<!-- NAV -->
    @include('admin-sidebar.navbar')

<!-- SIDEBAR -->
@include('admin-sidebar.sidebar')

<!-- MAIN CONTENT -->
<main>

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-envelope me-2"></i> Contact Messages</h4>

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
                🗑 Delete All
            </button>
        </form>
        @endif
    </div>
</div>

@if(session('success'))
    <div id="successMsg" class="success-msg mb-3">
        ✔ {{ session('success') }}
    </div>
@endif

    <!-- CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="width:40%">Message</th>
                            <th>Date</th>
                            <th>Action</th>

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
        <td>
            <form action="{{ route('admin.contacts.delete', $contact->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this message?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">
                    Delete
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
    </div>

</main>
<script>
    setTimeout(() => {
        const msg = document.getElementById('successMsg');
        if (msg) {
            msg.style.opacity = '0';

            // REMOVE element after fade
            setTimeout(() => {
                msg.remove();
            }, 600);
        }
    }, 3000);
</script>
</body>
</html>
