<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; }
        .sidebar-link:hover { background: #1f2937 !important; }
        .sidebar-link { text-decoration: none; }
        aside { z-index: 999; }
        main { transition: margin-left 0.3s; }
        .alert.auto-hide {
    overflow: hidden;
    will-change: opacity, max-height;

    transition:
        opacity 0.65s cubic-bezier(0.25, 0.1, 0.25, 1),
        max-height 0.6s cubic-bezier(0.25, 0.1, 0.25, 1),
        margin 0.6s ease,
        padding 0.6s ease;
}

.alert.hide {
    opacity: 0;
    max-height: 0;
    margin-top: 0;
    margin-bottom: 0;
    padding-top: 0;
    padding-bottom: 0;
}
    </style>
</head>

<body>

<!-- TOP NAVBAR -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex align-items-center">

            <button @click="open = !open" class="btn btn-outline-light d-md-none me-3">☰</button>

            <span class="navbar-brand fw-bold">Users Account</span>

            <div class="ms-auto text-white me-3">
                {{ Auth::user()->name }}
            </div>

            <form method="POST" action="{{ route('custom.logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </nav>
@include('admin-sidebar.sidebar') {{-- reusable sidebar --}}

<main class="container mt-4" style="margin-left:260px;">

    <h2 class="mb-4">👤 User Accounts</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ❌ {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif


        


   <table class="table table-hover table-bordered shadow-sm bg-white">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Registered</th>
            <th>Temp Password</th>
            <th width="15%">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>

            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>
                <span class="badge {{ $user->is_admin ? 'bg-primary' : 'bg-secondary' }}">
                    {{ $user->is_admin ? 'Admin' : 'User' }}
                </span>
            </td>

            <td>{{ $user->created_at->format('M d, Y') }}</td>

            <!-- TEMP PASSWORD COLUMN -->
            <td>
                @if($user->temp_password)
                    <span class="badge bg-warning text-dark">
                        {{ $user->temp_password }}
                    </span>
                @else
                    <span class="badge bg-success">
                    Logged in / Password changed
                </span>
                @endif
            </td>

            <!-- ACTIONS -->
            <td>
                <form action="{{ route('admin.users-account.destroy', $user->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    {{ $users->links() }}

    <a href="{{ route('admin.users.register.form') }}" 
   class="btn btn-primary mt-3">
    ➕ Register a User
</a>


</main>
    <script>
        setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (!alert) return;

    // smooth hide
    alert.classList.add('hide');

    // remove element completely (fix layout)
    setTimeout(() => {
        alert.remove();
    }, 400); // match CSS transition
}, 3000);
    </script>

</body>
</html>
