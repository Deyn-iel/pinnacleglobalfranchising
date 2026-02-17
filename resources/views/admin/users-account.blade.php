<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Users</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

    /* ================= TABLE ================= */
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
    th:nth-child(2) { width: 360px; }
    th:nth-child(3) { width: 130px; }
    th:nth-child(4) { width: 150px; }
    th:nth-child(5) { width: 220px; }
    th:nth-child(6) { width: 90px; }

    /* ================= BADGES ================= */
    .badge {
        font-size: 12px;
        padding: 6px 10px;
        font-weight: 600;
    }

    /* ================= BUTTONS ================= */
    .btn-primary {
        background: #000;
        border: none;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: #333;
    }

    /* ================= ALERT ================= */
    .alert.hide {
        opacity: 0;
        max-height: 0;
        padding: 0;
        margin: 0;
        transition: all .4s ease;
    }

    /* ================= SAFETY ================= */
    @media (max-width: 1280px) {
        table {
            font-size: 13px;
        }
    }
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- HEADER -->
    <div class="page-header">
        <h4 class="fw-bold mb-1">
            <i class="fas fa-users me-2"></i>User Accounts
        </h4>
        <p class="text-muted mb-0">
            All registered users displayed in a single view.
        </p>
    </div>

    <!-- ALERTS -->
    @if(session('success'))
        <div class="alert alert-success auto-hide">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger auto-hide">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered</th>
                        <th>Status / Temp Password</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>
                            <span class="badge
    {{ $user->usertype === 'admin'
        ? 'bg-primary'
        : ($user->usertype === 'supplies'
            ? 'bg-info'
            : ($user->usertype === 'ticket'
                ? 'bg-warning text-light'
                : 'bg-secondary')) }}">
    {{ ucfirst($user->usertype) }}
</span>

                        </td>

                        <td>{{ $user->created_at->format('M d, Y') }}</td>

                        <td>
                            @if($user->temp_password)
                                <span class="badge bg-warning text-dark">
                                    {{ $user->temp_password }}
                                </span>
                            @else
                                <span class="badge bg-success">
                                    Active
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <form action="{{ route('admin.users-account.destroy', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No user accounts found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- REGISTER -->
    <a href="{{ route('admin.users.register') }}"
       class="btn btn-primary mt-4">
        <i class="fas fa-user-plus me-2"></i>Register a User
    </a>

</main>

<script>
    setTimeout(() => {
        document.querySelectorAll('.auto-hide').forEach(alert => {
            alert.classList.add('hide');
            setTimeout(() => alert.remove(), 400);
        });
    }, 3000);
</script>

</body>
</html>
