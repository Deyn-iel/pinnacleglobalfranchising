<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Upload Requirements</title>

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

            <span class="navbar-brand fw-bold">📊 Admin Dashboard</span>

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

    <!-- OVERLAY -->
    <div 
        class="position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-md-none"
        x-show="open"
        @click="open = false"
        style="z-index: 998;"
    ></div>

    <!-- MAIN CONTENT -->
    <main class="container mt-4" style="margin-left:260px;">

        <h2 class="mb-4">📄 Upload Requirements</h2>

        <p class="text-muted">
            Use this page to upload franchise-related requirements such as permits, IDs, or supporting documents.
            No applicant selection is required.
        </p>

        <hr>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ <strong>{{ session('success') }}</strong>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- UPLOAD FORM -->
        <div class="card shadow-sm p-4 mb-4">
            <h4>📤 Upload File</h4>
            <p class="text-muted mb-3">Allowed formats: PDF, JPG, PNG, DOCX, ZIP</p>

            <form action="{{ route('admin.requirements') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="form-label">Document Name *</label>
                <input type="text" name="document_name" class="form-control mb-3" required>

                <label class="form-label">Select File *</label>
                <input type="file" name="file" class="form-control mb-3" required>

                <label class="form-label">Category *</label>
                <select name="category" class="form-select mb-3" required>
                    <option value="">Select Category</option>
                    <option>Government ID</option>
                    <option>Business Permit</option>
                    <option>Franchise Agreement</option>
                    <option>Financial Document</option>
                    <option>Other Requirement</option>
                </select>

                <button class="btn btn-success px-4">Upload</button>
            </form>
        </div>

        <hr>

        <!-- Optional: Uploaded Files Display -->
        <h4 class="mb-3">📁 Uploaded Files</h4>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>File Name</th>
                    <th>Category</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="text-muted">No uploaded files yet...</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </main>

</body>
</html>
