<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Receiving Orders</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { background: #f5f6fa; }
        .sidebar-link:hover { background: #1f2937 !important; }
        .sidebar-link { text-decoration: none; }
        aside { z-index: 999; }
        main { transition: margin-left 0.3s; }
    </style>
</head>

<body x-data="{ open:false }">

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex align-items-center">

            <button @click="open = !open" class="btn btn-outline-light d-md-none me-3">☰</button>


            <div class="ms-auto text-white me-3">
                {{ Auth::user()->name }}
            </div>

            <form method="POST" action="{{ route('custom.logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <!-- SIDEBAR -->
    @include('admin-sidebar.sidebar')

    <div class="container">
        <h1>Contacts Here</h1>
    </div>


</body>
</html>
