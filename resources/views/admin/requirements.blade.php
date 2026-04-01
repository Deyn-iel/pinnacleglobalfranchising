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

  --bg: #f6f8fb;
  --text: #0f172a;
  --muted: #64748b;
  --border: rgba(15,23,42,.08);
  --card: rgba(255,255,255,.95);

  --primary: #2563eb;
  --primary-light: rgba(37,99,235,.08);

  --shadow: 0 10px 30px rgba(15,23,42,.06);
  --shadow-hover: 0 20px 50px rgba(15,23,42,.12);

  --radius: 16px;
}

/* BODY */
body{
  background: linear-gradient(135deg, #eef2ff, #f8fafc);
  color: var(--text);
  font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

/* MAIN */
main{
  margin-left: var(--sidebar-w);
  padding: 28px;
}

@media (max-width: 991px){
  main{
    margin-left: 0;
    padding: 16px;
  }
}

/* HEADER */
.page-header{
  background: var(--card);
  border-radius: var(--radius);
  padding: 20px 24px;
  box-shadow: var(--shadow);
  margin-bottom: 20px;
}

.page-header h4{
  font-weight: 900;
}

.page-header p{
  color: var(--muted);
}

/* CARD */
.content-card{
  background: var(--card);
  border-radius: var(--radius);
  padding: 20px;
  box-shadow: var(--shadow);
  margin-bottom: 20px;
}

/* FORM */
.form-control{
  border-radius: 12px;
  border: 1px solid var(--border);
  padding: 10px 12px;
}

.form-control:focus{
  border-color: var(--primary);
  box-shadow: 0 0 0 3px var(--primary-light);
}

/* BUTTON */
.btn{
  border-radius: 999px;
  font-weight: 600;
}

.btn-primary{
  background: var(--primary);
  border: none;
}

.btn-primary:hover{
  background: #1d4ed8;
}

/* SUCCESS */
.success-msg{
  background: #dcfce7;
  color: #166534;
  border-left: 5px solid #22c55e;
  padding: 12px;
  border-radius: 10px;
  margin-bottom: 15px;
}

/* ================= FOLDER GRID ================= */

.folder-grid{
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 16px;
}

/* FOLDER CARD */
.folder-card{
  background: var(--card);
  border-radius: var(--radius);
  padding: 18px;
  box-shadow: var(--shadow);
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
  color: var(--text);
  transition: all .2s ease;
  border: 1px solid var(--border);
}

.folder-card:hover{
  box-shadow: var(--shadow-hover);
  background: var(--primary-light);
}

/* ICON */
.folder-icon{
  font-size: 26px;
  color: #facc15;
}

/* NAME */
.folder-name{
  font-weight: 700;
  font-size: 14px;
  word-break: break-word;
}

/* EMPTY STATE */
.empty-state{
  text-align: center;
  padding: 40px 10px;
  color: var(--muted);
  font-size: 14px;
}

/* WRAPPER */
.folder-card-wrapper{
  position: relative;
}

/* DELETE BUTTON */
.delete-folder-btn{
  position: absolute;
  top: 8px;
  right: 8px;
  background: #ef4444;
  border: none;
  color: white;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  font-size: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  opacity: 0;
  transform: scale(0.8);
  transition: 0.2s;
}

/* SHOW ON HOVER */
.folder-card-wrapper:hover .delete-folder-btn{
  opacity: 1;
  transform: scale(1);
}

/* HOVER EFFECT */
.delete-folder-btn:hover{
  background: #dc2626;
  transform: scale(1.1);
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
      <i class="fas fa-file-lines me-2"></i>UPLOADING DOCUMENTS FOR VIEWING OF DEPARTMENT EMPLOYEES
    </h4>
    <p class="text-muted mb-0">
      PINNACLE GLOBAL FRANCHISING GROUP INC.
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
        <i class="fas fa-upload me-2"></i>Create Folder
      </h5>
      <div class="text-muted small">Create a new folder for organizing documents.</div>
    </div>

    <form action="{{ route('admin.folder.create') }}" method="POST">
@csrf

<div class="row g-3">

  <div class="col-12 col-md-6">
    <label class="form-label">Folder Name *</label>
    <input type="text" name="folder" class="form-control" required>
  </div>

</div>

<div class="mt-4">
  <button class="btn btn-primary px-4">
    <i class="fas fa-folder-plus me-1"></i> Create Folder
  </button>
</div>

</form>
  </div>

  <!-- TABLE -->
  <div class="content-card">

  <h5 class="section-title mb-3">
    <i class="fas fa-folder me-2"></i>Folders
  </h5>

  <div class="folder-grid">

    @forelse($folders as $folder)
  <div class="folder-card-wrapper">

    <a href="{{ route('admin.folder.view', $folder) }}" class="folder-card">
      <i class="fas fa-folder folder-icon"></i>
      <div class="folder-name">{{ $folder }}</div>
    </a>

    <!-- DELETE BUTTON -->
    <form action="{{ route('admin.folder.delete', $folder) }}" method="POST" class="delete-folder-form">
      @csrf
      @method('DELETE')
      <button type="submit" class="delete-folder-btn">
        <i class="fas fa-trash"></i>
      </button>
    </form>

  </div>
    @empty
      <div class="empty-state">
        <i class="fas fa-folder-open mb-2" style="font-size:30px;"></i><br>
        No folders yet
      </div>
    @endforelse

  </div>

</div>

</main>

<script>
  document.querySelectorAll('.delete-folder-form').forEach(form => {
  form.addEventListener('submit', function(e){
    if(!confirm('Delete this folder and all its files?')) {
      e.preventDefault();
    }
  });
});
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
