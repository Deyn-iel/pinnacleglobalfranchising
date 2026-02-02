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
        box-shadow: 0 10px 30px rgba(15,23,42,.08);
        margin-bottom: 22px;
    }

    /* ================= CARD / FORM ================= */
    .content-card {
        background: #ffffff;
        border-radius: 14px;
        padding: clamp(20px, 2vw, 28px);
        box-shadow: 0 10px 28px rgba(15,23,42,.08);
        margin-bottom: 24px;
    }

    /* ================= TABLE WRAPPER ================= */
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

    /* Column widths (desktop safe) */
    th:nth-child(1) { width: 220px; }
    th:nth-child(2) { width: 200px; }
    th:nth-child(3) { width: 200px; }
    th:nth-child(4) { width: 120px; }

    /* ================= BUTTONS ================= */
    .btn-sm {
        padding: 5px 10px;
        font-size: 13px;
    }

    /* ================= SUCCESS ================= */
    .success-msg {
        background: #dcfce7;
        color: #166534;
        border-left: 5px solid #22c55e;
        padding: 12px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: opacity .5s ease;
        margin-bottom: 16px;
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

    /* ================= EMPTY ================= */
    .no-hover {
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
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fas fa-file-lines me-2"></i>Upload Requirements
            </h4>
            <p class="text-muted mb-0">
                Upload franchise-related documents and requirements.
            </p>
        </div>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div id="successMsg" class="success-msg">
            ✔ {{ session('success') }}
        </div>
    @endif

    <!-- UPLOAD FORM -->
    <div class="content-card">
        <h5 class="fw-bold mb-3">
            <i class="fas fa-upload me-2"></i>Upload File
        </h5>

        <form action="{{ route('admin.requirements') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Document Name *</label>
                    <input type="text" name="document_name" class="form-control" required>
                </div>

                <div class="col-md-6">
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

                <div class="col-md-12">
                    <label class="form-label">Select File *</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>

            <div class="mt-4">
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
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ asset('storage/'.$req->file_path) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ asset('storage/'.$req->file_path) }}"
                                   download
                                   class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-download"></i>
                                </a>

                                <form action="{{ route('admin.requirements.delete', $req->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this file?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
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
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000);
</script>

</body>
</html>
