<!doctype html>
<html lang="en">
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
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Search -->
    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search user name or email...">
    </form>
        


    <table class="table table-hover table-bordered shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered</th>
                <th width="20%">Remove Accounts</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>

                <td>{{ $user->name }}</td>

                <td>{{ $user->email }}</td>

                <td>
                    <span class="badge bg-primary">
                        {{ $user->is_admin ? 'Admin' : 'User' }}
                    </span>
                </td>

                <td>{{ $user->created_at->format('M d, Y') }}</td>

                <td class="d-flex gap-1">

                    <!-- Delete -->
                    <form action="{{ route('admin.users-account.destroy', $user->id) }}" method="POST">
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

</main>

</body>
</html>
