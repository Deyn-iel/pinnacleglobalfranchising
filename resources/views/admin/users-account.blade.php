<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Users</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@vite([
    'resources/css/admin/app.css',
])
    <style>
        body { background: #f5f6fa; }
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
.btn-primary {
    background: black;
    border: none;
    font-weight: 600;
}

.alert.hide {
    opacity: 0;
    max-height: 0;
    margin-top: 0;
    margin-bottom: 0;
    padding-top: 0;
    padding-bottom: 0;
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

    </style>
</head>

<body>

<!-- NAV -->
    @include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar') {{-- reusable sidebar --}}

<main class="container mt-4" style="margin-left:260px;">

    <h2 class="mb-4"><i class="fas fa-user"></i>
 Users Accounts</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ❌ {{ session('error') }}
    </div>
@endif


        


   <table class="table table-hover table-bordered shadow-sm bg-white">
    <thead class="table-dark">
        <tr>
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
            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>
                <span class="badge 
                    {{ $user->usertype === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                    {{ ucfirst($user->usertype) }}
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

    <a href="{{ route('admin.users.store') }}" 
   class="btn btn-primary mt-3">
    <i class="fas fa-add me-2"></i> Register a User
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
