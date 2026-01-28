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

<h2 class="mb-3"><i class="fas fa-boxes-stacked me-2"></i> Supplies Management</h2>
<p class="text-muted">Add and manage supplies available to partners.</p>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm p-4 mb-4">
<h4>Add New Supply</h4>

<form action="{{ route('admin.supplies.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label class="form-label">Supply Name</label>
<input type="text" name="name" class="form-control mb-3" required>

<label class="form-label">Unit (pc / box / kg)</label>
<input type="text" name="unit" class="form-control mb-3" required>

<label class="form-label">Cost Price</label>
<input type="number" step="0.01" name="cost_price" class="form-control mb-3" required>

<label class="form-label">Selling Price</label>
<input type="number" step="0.01" name="selling_price" class="form-control mb-3" required>

<label class="form-label">Stock on Hand</label>
<input type="number" name="stock" class="form-control mb-3" required>

<label class="form-label">Supply Image</label>
<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-primary">Save Supply</button>
</form>
</div>

<h4>Current Supplies</h4>
<table class="table table-striped shadow-sm">
<thead class="table-dark">
<tr>
  <th>Name</th>
  <th>Unit</th>
  <th>Stock</th>
  <th>Selling Price</th>
  <th>Date Added</th>
  <th>Image</th>
  <th>Actions</th>
</tr>
</thead>
<tbody>
@forelse($supplies as $supply)
<tr>
  <td>
    @if($supply->image)
  <img src="{{ Storage::url($supply->image) }}"
       width="50" height="50"
       style="object-fit:cover;border-radius:6px;">
@else
  <span class="text-muted">No image</span>
@endif

  </td>

  <td>{{ $supply->name }}</td>
  <td>{{ $supply->unit }}</td>
  <td>{{ $supply->stock }}</td>
  <td>₱{{ number_format($supply->selling_price,2) }}</td>
  <td>{{ $supply->created_at->format('M d, Y') }}</td>

  <td class="d-flex gap-2">
    <a href="{{ route('admin.supplies.edit', $supply) }}"
       class="btn btn-sm btn-warning">
       Edit
    </a>
    <form action="{{ route('admin.supplies.destroy', $supply) }}"
          method="POST"
          onsubmit="return confirm('Delete this supply?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">Delete</button>
    </form>
  </td>
</tr>
@empty
<tr>
  <td colspan="7" class="text-center text-muted">No supplies yet</td>
</tr>
@endforelse

</tbody>
</table>

</main>


</body>
</html>
