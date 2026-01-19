<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · Upload Requirements</title>
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
.alert {
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.alert.fade:not(.show) {
    opacity: 0;
    transform: translateY(-10px);
}

    </style>
</head>

<body x-data="{ open:false }">

<!-- NAV -->
    @include('admin-sidebar.navbar')

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


        <h2 class="mb-4"><i class="fas fa-file-lines me-2"></i> Upload Requirements</h2>

        <p class="text-muted">
            Use this page to upload franchise-related requirements such as permits, IDs, or supporting documents.
            No applicant selection is required.
        </p>

        <hr>

        @if(session('success'))
<div id="uploadSuccessAlert"
     class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
     role="alert">
     
    <i class="fas fa-check-circle fs-5"></i>
    <strong>{{ session('success') }}</strong>
</div>
@endif


        <!-- UPLOAD FORM -->
        <div class="card shadow-sm p-4 mb-4">
            <h4><i class="fas fa-file me-2"></i> Upload File</h4>
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
        <h4 class="mb-3"><i class="fas fa-folder me-2"></i> Uploaded Files</h4>

        <table class="table table-bordered">
            <thead class="table-dark">
<tr>
    <th>Document Name</th>
    <th>Category</th>
    <th>Uploaded At</th>
    <th>Action</th>
</tr>
</thead>


            <tbody>
@if($requirements->count())
    @foreach($requirements as $req)
        <tr>
            <td>{{ $req->document_name }}</td>
            <td>{{ $req->category }}</td>
            <td>{{ $req->created_at->format('M d, Y h:i A') }}</td>
            <td>
    <div class="d-flex align-items-center gap-2">

        <!-- VIEW -->
        <a href="{{ asset('storage/'.$req->file_path) }}"
           target="_blank"
           class="btn btn-sm btn-primary">
            <i class="fas fa-eye"></i>
        </a>

        <!-- DOWNLOAD -->
        <a href="{{ asset('storage/'.$req->file_path) }}"
           download
           class="btn btn-sm btn-secondary">
            <i class="fas fa-download"></i>
        </a>

        <!-- DELETE -->
        <form action="{{ route('admin.requirements.delete', $req->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this file?')"
              class="d-inline">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
            </button>
        </form>

    </div>
</td>

        </tr>
    @endforeach
@else
    <tr>
        <td colspan="4" class="text-center text-muted">
            No uploaded files yet...
        </td>
    </tr>
@endif
</tbody>


        </table>

    </main>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const alertBox = document.getElementById("uploadSuccessAlert");

    if (alertBox) {
        // wait 2.5 seconds then fade out
        setTimeout(() => {
            alertBox.classList.remove("show");
            alertBox.classList.add("fade");

            // fully remove after animation
            setTimeout(() => {
                alertBox.remove();
            }, 600);
        }, 2500);
    }
});
</script>

</body>

</html>
