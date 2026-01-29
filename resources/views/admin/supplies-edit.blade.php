<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Supply</title>

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
    .form-card {
        max-width: 720px;
        background: #ffffff;
        border-radius: 16px;
        padding: 26px;
        box-shadow: 0 12px 30px rgba(15,23,42,.1);
    }

    label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37,99,235,.12);
    }

    /* ================= IMAGE ================= */
    .current-image {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    /* ================= BUTTONS ================= */
    .btn-primary {
        background: #000;
        border: none;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 10px;
    }

    .btn-secondary {
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
    }

    /* ================= SIDEBAR ================= */
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
        <h4 class="fw-bold mb-0">
            <i class="fas fa-pen-to-square me-2"></i>Edit Supply
        </h4>
        <p class="text-muted mb-0">
            Update supply details and stock information.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM CARD -->
    <div class="form-card">

        <form method="POST"
              action="{{ route('admin.supplies.update', $supply) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Supply Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $supply->name) }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label>Unit (pc / box / kg)</label>
                    <input type="text"
                           name="unit"
                           class="form-control"
                           value="{{ old('unit', $supply->unit) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label>Cost Price</label>
                    <input type="number"
                           step="0.01"
                           name="cost_price"
                           class="form-control"
                           value="{{ old('cost_price', $supply->cost_price) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label>Selling Price</label>
                    <input type="number"
                           step="0.01"
                           name="selling_price"
                           class="form-control"
                           value="{{ old('selling_price', $supply->selling_price) }}"
                           required>
                </div>

                <div class="col-md-4">
                    <label>Stock on Hand</label>
                    <input type="number"
                           name="stock"
                           class="form-control"
                           value="{{ old('stock', $supply->stock) }}"
                           required>
                </div>

                <div class="col-md-12">
                    <label>Supply Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                @if($supply->image)
                    <div class="col-md-12">
                        <small class="text-muted">Current Image</small><br>
                        <img src="{{ Storage::url($supply->image) }}"
                             class="current-image mt-2">
                    </div>
                @endif

            </div>

            <div class="d-flex gap-3 mt-4">
                <button class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Supply
                </button>

                <a href="{{ route('admin.supplies') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </div>

        </form>
    </div>

</main>

</body>
</html>
