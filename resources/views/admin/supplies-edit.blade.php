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
    --primary-soft: rgba(13,110,253,.12);
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

  /* ================= FORM CARD ================= */
  .form-card{
    max-width: 860px;
    margin: 0 auto;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: clamp(16px, 2vw, 26px);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
  }

  .form-card .card-title{
    font-weight: 900;
    letter-spacing: -.01em;
  }

  /* ================= FORM ================= */
  label{
    font-weight: 800;
    font-size: 12.5px;
    margin-bottom: 6px;
    color: #374151;
  }

  .form-control{
    border-radius: 14px;
    padding: 10px 12px;
    font-size: 14px;
    border: 1px solid rgba(15,23,42,.12);
  }

  .form-control:focus{
    border-color: rgba(13,110,253,.45);
    box-shadow: 0 0 0 4px rgba(13,110,253,.14);
  }

  .hint{
    font-size: 12px;
    color: var(--muted);
    margin-top: 6px;
  }

  /* ================= IMAGE ================= */
  .current-wrap{
    display:flex;
    align-items:center;
    gap: 12px;
    padding: 12px;
    border-radius: 16px;
    border: 1px dashed rgba(15,23,42,.18);
    background: rgba(255,255,255,.65);
  }

  .current-image{
    width: 72px;
    height: 72px;
    object-fit: cover;
    border-radius: 16px;
    border: 1px solid rgba(15,23,42,.10);
    background: #fff;
  }

  /* ================= BUTTONS ================= */
  .btn{
    font-weight: 900;
    border-radius: 999px;
    padding: 10px 18px;
  }

  .btn-primary{
    background: var(--primary-dark);
    border: none;
  }
  .btn-primary:hover{
    background: #111827;
  }

  .btn-secondary{
    border-radius: 999px;
    font-weight: 900;
  }

  /* error alert */
  .alert-danger{
    border-radius: 14px;
    border: 1px solid rgba(220,38,38,.22);
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
    <h4 class="fw-bold mb-0">
      <i class="fas fa-pen-to-square me-2"></i>Edit Supply
    </h4>
    <p class="text-muted mb-0">
      Update supply details and stock information.
    </p>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <div class="fw-bold mb-1">Please fix the following:</div>
      <ul class="mb-0 small">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- FORM CARD -->
  <div class="form-card">

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
      <div>
        <div class="card-title">Supply Information</div>
        <div class="hint">Edit the fields then click “Update Supply”.</div>
      </div>
      <div class="text-muted small">
        ID: <span class="fw-semibold text-dark">{{ $supply->id }}</span>
      </div>
    </div>

    <form method="POST"
          action="{{ route('admin.supplies.update', $supply) }}"
          enctype="multipart/form-data">

      @csrf
      @method('PUT')

      <div class="row g-3">

        <div class="col-12 col-md-6">
          <label>Supply Name</label>
          <input type="text"
                 name="name"
                 class="form-control"
                 value="{{ old('name', $supply->name) }}"
                 required>
        </div>

        <div class="col-12 col-md-6">
          <label>Unit (pc / box / kg)</label>
          <input type="text"
                 name="unit"
                 class="form-control"
                 value="{{ old('unit', $supply->unit) }}"
                 required>
        </div>

        <div class="col-12 col-md-4">
          <label>Cost Price</label>
          <input type="number"
                 step="0.01"
                 name="cost_price"
                 class="form-control"
                 value="{{ old('cost_price', $supply->cost_price) }}"
                 required>
        </div>

        <div class="col-12 col-md-4">
          <label>Selling Price</label>
          <input type="number"
                 step="0.01"
                 name="selling_price"
                 class="form-control"
                 value="{{ old('selling_price', $supply->selling_price) }}"
                 required>
        </div>

        <div class="col-12 col-md-4">
          <label>Stock on Hand</label>
          <input type="number"
                 name="stock"
                 class="form-control"
                 value="{{ old('stock', $supply->stock) }}"
                 required>
        </div>

        <div class="col-12">
          <label>Supply Image</label>
          <input type="file" name="image" class="form-control">
          <div class="hint">Optional: upload a new image to replace the current one.</div>
        </div>

        @if($supply->image)
          <div class="col-12">
            <div class="current-wrap">
              <img src="{{ Storage::url($supply->image) }}" class="current-image" alt="Current supply image">
              <div>
                <div class="fw-bold">Current Image</div>
                <div class="hint">This will be replaced only if you upload a new file.</div>
              </div>
            </div>
          </div>
        @endif

      </div>

      <div class="d-flex gap-2 flex-wrap mt-4">
        <button class="btn btn-primary">
          <i class="fas fa-save me-1"></i> Update Supply
        </button>

        <a href="{{ route('admin.supplies') }}" class="btn btn-secondary">
          Cancel
        </a>
      </div>

    </form>
  </div>

</main>

</body>
</html>