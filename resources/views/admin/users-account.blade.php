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
    transition: all .3s ease;
}

main {
    margin-left: 260px;
    padding: clamp(16px, 2.5vw, 34px);
    max-width: calc(100vw - 260px);
    transition: all .3s ease;
}

.page-header {
    background: #ffffff;
    border-radius: 14px;
    padding: clamp(14px, 2vw, 22px);
    box-shadow: 0 10px 30px rgba(15,23,42,.08);
    margin-bottom: 22px;
}

.table-wrapper {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 10px 28px rgba(15,23,42,.08);
    overflow: hidden;
}

.table-responsive {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    table-layout: fixed;
    font-size: clamp(12px, 0.9vw, 14px);
    margin-bottom: 0;
    min-width: 700px; 
}

th, td {
    vertical-align: middle;
    word-break: break-word;
    white-space: normal;
}

th:nth-child(1) { width: 140px; }
th:nth-child(2) { width: 300px; }
th:nth-child(3) { width: 140px; }
th:nth-child(4) { width: 140px; }
th:nth-child(5) { width: 200px; }
th:nth-child(6) { width: 80px; }

.badge {
    font-size: clamp(10px, 0.7vw, 12px);
    padding: clamp(4px, 0.5vw, 6px) clamp(8px, 0.8vw, 10px);
    font-weight: 600;
    border-radius: 999px;
    white-space: nowrap;
}

/* prevent overflow */
td .badge {
    display: inline-block;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-primary {
    background: #000;
    border: none;
    font-weight: 600;
    white-space: nowrap;
}

.btn-primary:hover {
    background: #333;
}

.alert.hide {
    opacity: 0;
    max-height: 0;
    padding: 0;
    margin: 0;
    transition: all .4s ease;
}

tbody tr:first-child td {
    border-top: 2px solid #000;
}

.table tbody tr.group-header td {
    background: #b3b3b3 !important;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

@media (max-width: 1024px) {

    aside {
        width: 220px;
    }

    main {
        margin-left: 220px;
        max-width: calc(100vw - 220px);
    }

    table {
        font-size: 12px;
    }
}

@media (max-width: 768px) {

    aside {
        position: fixed;
        left: -260px;
        top: 0;
        height: 100%;
    }

    main {
        margin-left: 0;
        max-width: 100%;
        padding: 16px;
    }

    .page-header {
        text-align: center;
    }

    table {
        font-size: 11px;
        min-width: 600px;
    }

    .badge {
        font-size: 10px;
        padding: 4px 8px;
    }
}

@media (max-width: 480px) {

    table {
        font-size: 10px;
        min-width: 550px;
    }

    .badge {
        font-size: 9px;
        padding: 3px 6px;
    }

    .btn-primary {
        width: 100%;
        text-align: center;
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

    @php
$roleLabels = [
    'admin' => 'ADMIN USER',
    'supplies' => 'PROVINCIAL COFFEE SUPPLIES',
    'ticket' => 'UPPER MANAGEMENT USER',
    'user' => 'BRANCH EMPLOYEE USER',
    'portal' => 'INSURANCE CLAIM',
    'it' => 'IT TECH SUPPORT DEPARTMENT',
    'smm' => 'MARKETING DEPARTMENT',
    'od' => 'FRANCHISING DEPARTMENT',
    'om' => 'KI OPERATIONS DEPARTMENT',
    'hr' => 'HUMAN RESOURCES DEPARTMENT',
    'admin-secretary' => 'CORP ADMIN SECRETARY',
];
@endphp

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
@forelse($users as $type => $group)
    
    <tr class="group-header">
        <td colspan="6" class="fw-bold text-uppercase">
            {{ strtoupper($type) }}
        </td>
    </tr>

    @foreach($group as $user)
    <tr>
        <td>{{ strtoupper($user->name) }}</td>

        <td>{{ strtoupper($user->email) }}</td>

        <td>
            <span class="badge
                {{ $user->usertype === 'admin' ? 'bg-primary'
                : ($user->usertype === 'supplies' ? 'bg-info'
                : ($user->usertype === 'ticket' ? 'bg-warning text-dark'
                : ($user->usertype === 'portal' ? 'bg-success'
                : ($user->usertype === 'it' ? 'bg-dark'
                : ($user->usertype === 'smm' ? 'bg-danger'
                : ($user->usertype === 'od' ? 'bg-secondary'
                : ($user->usertype === 'om' ? 'bg-light text-dark'
                : ($user->usertype === 'hr' ? 'bg-primary-subtle text-dark'
                : ($user->usertype === 'admin-secretary' ? 'bg-info-subtle text-dark'
                : 'bg-secondary'))))))))) }}">
                {{ $roleLabels[$user->usertype] ?? strtoupper($user->usertype) }}
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
    @endforeach

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
    <a href="{{ route('admin.users.email') }}" class="btn btn-primary mt-4">
  <i class="fa-solid fa-envelope me-2"></i>Email a User
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
