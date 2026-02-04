<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Upload Requirements</title>

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
    letter-spacing: -.02em;
    margin-bottom: 4px;
  }
  .page-header p{
    color: var(--muted);
    margin: 0;
  }

  /* ================= CARD / FORM ================= */
  .content-card{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: clamp(16px, 2vw, 24px);
    box-shadow: var(--shadow);
    margin-bottom: 16px;
    backdrop-filter: blur(10px);
  }

  .section-title{
    font-weight: 900;
    letter-spacing: -.01em;
  }

  .form-label{
    font-weight: 800;
    font-size: 12.5px;
    color: #374151;
    margin-bottom: 6px;
  }

  .form-control,
  .form-select{
    border-radius: 14px;
    border: 1px solid rgba(15,23,42,.12);
    padding: 10px 12px;
    font-size: 14px;
  }

  .form-control:focus,
  .form-select:focus{
    border-color: rgba(13,110,253,.45);
    box-shadow: 0 0 0 4px rgba(13,110,253,.14);
  }

  /* ================= TABLE WRAPPER ================= */
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
    min-width: 820px; /* scroll on small screens */
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

  /* ================= BUTTONS ================= */
  .btn{
    font-weight: 900;
    border-radius: 999px;
  }

  .btn-sm{
    padding: 6px 12px;
    font-size: 13px;
  }

  /* ================= SUCCESS ================= */
  .success-msg{
    background: rgba(34,197,94,.12);
    color: #166534;
    border: 1px solid rgba(34,197,94,.25);
    border-left: 6px solid #22c55e;
    padding: 12px 14px;
    border-radius: 14px;
    font-weight: 900;
    box-shadow: 0 12px 28px rgba(15,23,42,.08);
    transition: opacity .5s ease, transform .5s ease;
    margin-bottom: 14px;
  }

  /* ================= EMPTY ================= */
  .no-hover{
    pointer-events: none;
    background: transparent !important;
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
      <i class="fas fa-file-lines me-2"></i>Upload Requirements
    </h4>
    <p class="text-muted mb-0">
      Upload franchise-related documents and requirements.
    </p>
  </div>

  <!-- SUCCESS -->
  @if(session('success'))
    <div id="successMsg" class="success-msg">
      <i class="fa-solid fa-circle-check me-1"></i>
      {{ session('success') }}
    </div>
  @endif

  <!-- UPLOAD FORM -->
  <div class="content-card">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
      <h5 class="section-title mb-0">
        <i class="fas fa-upload me-2"></i>Upload File
      </h5>
      <div class="text-muted small">Fill in document info then upload.</div>
    </div>

    <form action="{{ route('admin.requirements') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label">Document Name *</label>
          <input type="text" name="document_name" class="form-control" required>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Category *</label>
          <select name="category" class="form-select" required>
            <option value="">Select Category</option>
            <option>Government ID</option>
            <option>Business Permit</option>
            <option>Franchise Agreement</option>
            <option>Financial Document</option>
            <option>Other Requirement</option>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Select File *</label>
          <input type="file" name="file" class="form-control" required>
        </div>
      </div>

      <div class="mt-4 d-flex gap-2 flex-wrap">
        <button class="btn btn-success px-4">
          <i class="fas fa-cloud-upload-alt me-1"></i> Upload
        </button>
      </div>
    </form>
  </div>

  <!-- TABLE -->
  <div class="table-wrapper">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>Document</th>
            <th>Category</th>
            <th>Date Uploaded</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>

        <tbody>
          @forelse($requirements as $req)
          <tr>
            <td class="fw-semibold">{{ $req->document_name }}</td>
            <td>{{ $req->category }}</td>
            <td class="text-muted small">
              {{ $req->created_at->format('M d, Y · h:i A') }}
            </td>
            <td class="text-center">
              <div class="d-inline-flex justify-content-center gap-2">

                <a href="{{ asset('storage/'.$req->file_path) }}"
                   target="_blank"
                   class="btn btn-sm btn-outline-primary"
                   aria-label="View">
                  <i class="fas fa-eye"></i>
                </a>

                <a href="{{ asset('storage/'.$req->file_path) }}"
                   download
                   class="btn btn-sm btn-outline-secondary"
                   aria-label="Download">
                  <i class="fas fa-download"></i>
                </a>

                <form action="{{ route('admin.requirements.delete', $req->id) }}"
                      method="POST"
                      class="m-0"
                      onsubmit="return confirm('Delete this file?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger" aria-label="Delete">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>

              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center text-muted py-4 no-hover">
              No uploaded files yet.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</main>

<script>
  setTimeout(() => {
    const msg = document.getElementById('successMsg');
    if (msg) {
      msg.style.opacity = '0';
      msg.style.transform = 'translateY(-6px)';
      setTimeout(() => msg.remove(), 500);
    }
  }, 3000);
</script>

</body>
</html>
