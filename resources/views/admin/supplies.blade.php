<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Supplies Management</title>

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
        box-shadow: 0 10px 28px rgba(15,23,42,.08);
        margin-bottom: 22px;
    }

    /* ================= CARD ================= */
    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 10px 25px rgba(15,23,42,.08);
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

    /* Column widths – desktop safe */
    th:nth-child(1) { width: 80px; }
    th:nth-child(2) { width: 220px; }
    th:nth-child(3) { width: 120px; }
    th:nth-child(4) { width: 100px; }
    th:nth-child(5) { width: 140px; }
    th:nth-child(6) { width: 140px; }
    th:nth-child(7) { width: 150px; }

    /* ================= IMAGE ================= */
    .supply-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    /* ================= BUTTONS ================= */
    .btn-primary {
        background: #000;
        border: none;
        font-weight: 600;
    }

    .btn-warning,
    .btn-danger {
        font-size: 13px;
        padding: 5px 10px;
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
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- HEADER -->
    <div class="page-header">
        <h4 class="fw-bold mb-1">
            <i class="fas fa-boxes-stacked me-2"></i>Supplies Management
        </h4>
        <p class="text-muted mb-0">
            Add and manage supplies available to partners.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- ADD SUPPLY -->
    <div class="card p-4 mb-4">
        <h5 class="fw-semibold mb-3">Add New Supply</h5>

        <form action="{{ route('admin.supplies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Supply Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Unit</label>
                    <input type="text" name="unit" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Cost Price</label>
                    <input type="number" step="0.01" name="cost_price" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Selling Price</label>
                    <input type="number" step="0.01" name="selling_price" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Supply Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

            <button class="btn btn-primary mt-3">
                <i class="fas fa-save me-1"></i> Save Supply
            </button>
        </form>
    </div>

    <!-- CURRENT SUPPLIES -->
    <h5 class="fw-semibold mb-3">Current Supplies</h5>

    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Selling Price</th>
                        <th>Date Added</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($supplies as $supply)
                    <tr>
                        <td>
                            @if($supply->image)
                                <img src="{{ Storage::url($supply->image) }}"
                                     class="supply-img">
                            @else
                                <span class="text-muted small">No image</span>
                            @endif
                        </td>

                        <td class="fw-semibold">{{ $supply->name }}</td>
                        <td>{{ $supply->unit }}</td>
                        <td>{{ $supply->stock }}</td>
                        <td>₱{{ number_format($supply->selling_price, 2) }}</td>
                        <td>{{ $supply->created_at->format('M d, Y') }}</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.supplies.edit', $supply) }}"
                                   class="btn btn-sm btn-warning">
                                   <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.supplies.destroy', $supply) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this supply?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            No supplies added yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>

</body>
</html>
