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
  :root{
    --sidebar-w: 260px;

    --bg: #f5f6fa;
    --text: #0f172a;
    --muted: #64748b;
    --border: rgba(15,23,42,.10);
    --card: rgba(255,255,255,.90);

    --shadow: 0 18px 45px rgba(15,23,42,.08);
    --shadow-hover: 0 28px 80px rgba(15,23,42,.16);
    --radius: 18px;

    --primary-dark: #0f172a;
    --danger: #dc2626;
    --warning: #f59e0b;
  }

  body{
    background:
      radial-gradient(1200px 650px at 18% 0%, rgba(13,110,253,.08), transparent 55%),
      radial-gradient(900px 520px at 95% 10%, rgba(34,197,94,.07), transparent 55%),
      var(--bg);
    overflow-x: hidden;
    color: var(--text);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  }

  aside{
    width: var(--sidebar-w);
    z-index: 999;
  }

  /* ================= MAIN ================= */
  main{
    margin-left: var(--sidebar-w);
    padding: clamp(16px, 2.2vw, 34px);
    max-width: calc(100vw - var(--sidebar-w));
    min-width: 0;
  }

  @media (max-width: 991.98px){
    main{
      margin-left: 0;
      max-width: 100%;
      padding: 16px;
    }
  }

  /* ================= HEADER ================= */
  .page-header{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: clamp(16px, 2vw, 22px);
    box-shadow: var(--shadow);
    margin-bottom: 16px;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .page-header::after{
    content:"";
    position:absolute;
    right:-90px; top:-90px;
    width: 260px; height: 260px;
    background: radial-gradient(circle, rgba(13,110,253,.18), transparent 60%);
    pointer-events:none;
  }

  .page-header h4{
    font-weight: 900;
    margin-bottom: 4px;
    letter-spacing: -.02em;
  }
  .page-header p{
    color: var(--muted);
    margin: 0;
  }

  /* ================= CARD ================= */
  .card{
    border-radius: 20px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    background: var(--card);
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .card-pad{
    padding: clamp(14px, 1.6vw, 20px);
  }

  .section-title{
    font-weight: 900;
    letter-spacing: -.01em;
  }

  /* ================= FORM ================= */
  .form-label{
    font-weight: 800;
    font-size: 12.5px;
    color: #374151;
    margin-bottom: 6px;
  }

  .help-mini{
    font-size: 12px;
    color: var(--muted);
    margin-top: 6px;
  }

  /* ================= TABLE ================= */
  .table-wrapper{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    backdrop-filter: blur(10px);
  }

  .table-responsive{
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  table{
    width: 100%;
    font-size: 14px;
    margin-bottom: 0;
    min-width: 960px; /* scroll on small screens */
  }

  th{
    white-space: nowrap;
  }

  th, td{
    vertical-align: middle;
  }

  .table-hover tbody tr{
    transition: background .15s ease;
  }
  .table-hover tbody tr:hover{
    background: rgba(13,110,253,.05);
  }

  /* ================= IMAGE ================= */
  .supply-img{
    width: 54px;
    height: 54px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid rgba(15,23,42,.10);
    background: #fff;
  }

  .no-image{
    width: 54px;
    height: 54px;
    border-radius: 12px;
    display:grid;
    place-items:center;
    border: 1px dashed rgba(15,23,42,.18);
    color: var(--muted);
    font-size: 12px;
    background: rgba(255,255,255,.8);
  }

  /* ================= BUTTONS ================= */
  .btn{
    font-weight: 800;
    border-radius: 999px;
  }

  .btn-primary{
    background: var(--primary-dark);
    border: none;
  }
  .btn-primary:hover{
    background: #111827;
  }

  .btn-warning{
    background: rgba(245,158,11,.16);
    border: 1px solid rgba(245,158,11,.25);
    color: #92400e;
  }
  .btn-warning:hover{
    background: rgba(245,158,11,.22);
    border-color: rgba(245,158,11,.35);
    color: #78350f;
  }

  .btn-danger{
    background: rgba(220,38,38,.12);
    border: 1px solid rgba(220,38,38,.22);
    color: #991b1b;
  }
  .btn-danger:hover{
    background: rgba(220,38,38,.18);
    border-color: rgba(220,38,38,.32);
    color: #7f1d1d;
  }

  .btn-sm{
    padding: 6px 12px;
  }

  /* alert */
  .alert{
    border-radius: 14px;
    border: 1px solid rgba(34,197,94,.25);
    box-shadow: 0 12px 28px rgba(15,23,42,.08);
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
    <div class="alert alert-success mb-3 d-flex align-items-center gap-2">
      <i class="fa-solid fa-circle-check"></i>
      <div class="fw-semibold">✅ {{ session('success') }}</div>
    </div>
  @endif

  <!-- ADD SUPPLY -->
  <div class="card mb-4">
    <div class="card-pad">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h5 class="section-title mb-0">Add New Supply</h5>
        <div class="text-muted small">Fill in the details then click save.</div>
      </div>

      <form action="{{ route('admin.supplies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label">Supply Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label">Unit</label>
            <input type="text" name="unit" class="form-control" required>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label">Cost Price</label>
            <input type="number" step="0.01" name="cost_price" class="form-control" required>
          </div>

          <div class="col-12 col-md-3">
            <label class="form-label">Selling Price</label>
            <input type="number" step="0.01" name="selling_price" class="form-control" required>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Supply Image</label>
            <input type="file" name="image" class="form-control">
            <div class="help-mini">Optional: upload a clear product image.</div>
          </div>
        </div>

        <button class="btn btn-primary mt-3">
          <i class="fas fa-save me-1"></i> Save Supply
        </button>
      </form>
    </div>
  </div>

  <!-- CURRENT SUPPLIES -->
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <h5 class="section-title mb-0">Current Supplies</h5>
    <div class="text-muted small">Manage stock and pricing.</div>
  </div>

  <div class="table-wrapper">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th style="width: 90px;">Image</th>
            <th>Name</th>
            <th style="width: 140px;">Unit</th>
            <th style="width: 120px;">Stock</th>
            <th style="width: 160px;">Selling Price</th>
            <th style="width: 160px;">Date Added</th>
            <th class="text-center" style="width: 160px;">Actions</th>
          </tr>
        </thead>

        <tbody>
          @forelse($supplies as $supply)
          <tr>
            <td>
              @if($supply->image)
                <img src="{{ Storage::url($supply->image) }}" class="supply-img" alt="Supply">
              @else
                <div class="no-image">No img</div>
              @endif
            </td>

            <td class="fw-semibold">{{ $supply->name }}</td>
            <td>{{ $supply->unit }}</td>
            <td>{{ $supply->stock }}</td>
            <td class="fw-semibold">₱{{ number_format($supply->selling_price, 2) }}</td>
            <td class="text-muted">{{ $supply->created_at->format('M d, Y') }}</td>

            <td class="text-center">
              <div class="d-inline-flex justify-content-center gap-2">
                <a href="{{ route('admin.supplies.edit', $supply) }}"
                   class="btn btn-sm btn-warning"
                   aria-label="Edit">
                  <i class="fas fa-pen"></i>
                </a>

                <form action="{{ route('admin.supplies.destroy', $supply) }}"
                      method="POST"
                      class="m-0"
                      onsubmit="return confirm('Delete this supply?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" aria-label="Delete">
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
