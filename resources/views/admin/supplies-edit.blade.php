<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supply</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/admin/app.css'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { background: #f5f6fa; }
        aside { z-index: 999; }
        main { transition: margin-left 0.3s; }
    </style>
</head>

<body x-data="{ open:false }">

<!-- NAVBAR -->
@include('admin-sidebar.navbar')

<!-- SIDEBAR -->
@include('admin-sidebar.sidebar')

<!-- OVERLAY (mobile) -->
<div class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none"
     x-show="open"
     @click="open = false"
     style="z-index: 998;"></div>

<!-- MAIN CONTENT -->
<main class="container mt-4" style="margin-left:260px; max-width:700px;">

    <h3 class="mb-4">
        <i class="fas fa-pen-to-square me-2"></i>Edit Supply
    </h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form method="POST"
              action="{{ route('admin.supplies.update', $supply) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <label class="form-label">Supply Name</label>
            <input type="text"
                   name="name"
                   class="form-control mb-3"
                   value="{{ old('name', $supply->name) }}"
                   required>

            <label class="form-label">Unit (pc / box / kg)</label>
            <input type="text"
                   name="unit"
                   class="form-control mb-3"
                   value="{{ old('unit', $supply->unit) }}"
                   required>

            <label class="form-label">Cost Price</label>
            <input type="number"
                   step="0.01"
                   name="cost_price"
                   class="form-control mb-3"
                   value="{{ old('cost_price', $supply->cost_price) }}"
                   required>

            <label class="form-label">Selling Price</label>
            <input type="number"
                   step="0.01"
                   name="selling_price"
                   class="form-control mb-3"
                   value="{{ old('selling_price', $supply->selling_price) }}"
                   required>

            <label class="form-label">Stock on Hand</label>
            <input type="number"
                   name="stock"
                   class="form-control mb-3"
                   value="{{ old('stock', $supply->stock) }}"
                   required>

            <label class="form-label">Supply Image</label>
            <input type="file" name="image" class="form-control mb-3">

            @if($supply->image)
                <div class="mb-3">
                    <small class="text-muted">Current Image</small><br>
                    <img src="{{ Storage::url($supply->image) }}"
       width="50" height="50"
       style="object-fit:cover;border-radius:6px;">
                </div>
            @endif

            <div class="d-flex gap-2">
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
