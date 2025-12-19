<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Contact Messages</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    </style>
</head>

<body x-data="{ open:false }">

<!-- TOP NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">

        <button @click="open = !open" class="btn btn-outline-light d-md-none">☰</button>

        <div class="ms-auto d-flex align-items-center gap-3 text-white">
            <span>{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('custom.logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- SIDEBAR -->
@include('admin-sidebar.sidebar')

<!-- MAIN CONTENT -->
<main>

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">📩 Contact Messages</h4>

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
        <td colspan="5" class="text-center text-muted py-4">
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
