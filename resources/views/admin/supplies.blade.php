<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Receiving Orders</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite([
    'resources/css/admin/app.css',
])
    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { background: #f5f6fa; }
        .sidebar-link:hover { background: #1f2937 !important; }
        .sidebar-link { text-decoration: none; }
        aside { z-index: 999; }
        main { transition: margin-left 0.3s; }
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

<body x-data="{ open:false }">

    <!-- NAV -->
    @include('admin-sidebar.navbar')

    <!-- SIDEBAR -->
    @include('admin-sidebar.sidebar')

    <!-- OVERLAY -->
    <div class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none"
         x-show="open"
         @click="open = false"
         style="z-index: 998;"></div>

    <!-- MAIN CONTENT -->
    <main class="container mt-4" style="margin-left:260px;">
        
        <h2 class="mb-4"><i class="fas fa-box me-2"></i> Receiving Orders (Supplies)</h2>
        <p class="text-muted">This page will display all incoming supply orders from users.</p>

        <hr>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ <strong>{{ session('success') }}</strong>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- FORM: Record Received Order -->
        <div class="card shadow-sm p-4 mb-4">
            <h4><i class="fas fa-add me-2"></i> Record Received Supply Order</h4>

            <form action="{{ route('admin.supplies') }}" method="POST">
                @csrf

                <label class="form-label">Customer Name *</label>
                <input type="text" name="customer" class="form-control mb-3" required>

                <label class="form-label">Item Ordered *</label>
                <input type="text" name="item" class="form-control mb-3" required>

                <label class="form-label">Quantity *</label>
                <input type="number" name="quantity" class="form-control mb-3" required>

                <label class="form-label">Status *</label>
                <select name="status" class="form-select mb-3" required>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Delivered</option>
                    <option>Cancelled</option>
                </select>

                <button class="btn btn-primary px-4">Save Order</button>
            </form>
        </div>

        <hr>

        <!-- TABLE: Display Received Orders -->
        <h4><i class="fas fa-file-lines me-2"></i> Supply Orders Received</h4>

        <table class="table table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Received At</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="text-muted">No orders yet...</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </main>

</body>
</html>
