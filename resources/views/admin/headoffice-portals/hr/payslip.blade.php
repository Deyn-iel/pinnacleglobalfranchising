<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HR • Payslip Manager</title>

<link rel="icon" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@vite(['resources/css/admin/shadcn-tables.css'])

<style>
:root{
  --bg:#f8fafc;
  --card:#fff;
  --border:#e5e7eb;
  --text:#0f172a;
  --muted:#6b7280;
  --accent:#2563eb;
  --radius:14px;
}

body{
  background:var(--bg);
  font-family:Inter, system-ui;
}

/* HEADER */
.page-header{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:20px;
  margin-bottom:20px;
}

.page-header h4{
  font-weight:700;
}
.page-header small{
  color:var(--muted);
}

/* PANEL */
.panel{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:18px;
}

.panel-title{
  font-weight:700;
  font-size:15px;
}

.panel-sub{
  font-size:13px;
  color:var(--muted);
}

/* FORM */
.form-control, .form-select{
  border-radius:10px;
  border:1px solid var(--border);
}

/* UPLOAD BOX */
.upload-box{
  border:2px dashed var(--border);
  border-radius:12px;
  padding:25px;
  text-align:center;
  transition:.2s;
}
.upload-box:hover{
  border-color:var(--accent);
  background:#f1f5ff;
}

/* FOLDER */
.folder-card{
  border:1px solid var(--border);
  border-radius:12px;
  padding:14px;
  transition:.2s;
}
.folder-card:hover{
  box-shadow:0 8px 20px rgba(0,0,0,.05);
}

.folder-name{
  font-weight:600;
}

/* TABLE */
.table-wrapper{
  border:1px solid var(--border);
  border-radius:var(--radius);
  overflow:hidden;
}

thead{
  background:#f1f5f9;
}

th{
  font-size:12px;
  color:var(--muted);
  text-transform:uppercase;
}

td{
  font-size:13px;
  vertical-align:middle;
}

/* BUTTON */
.btn{
  border-radius:10px;
}

.action-menu-wrap{
  display:inline-flex;
  flex-direction:column;
  align-items:flex-end;
}

.action-menu-toggle{
  width:38px;
  height:38px;
  border:1px solid var(--border);
  border-radius:12px;
  background:#fff;
  color:var(--text);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  box-shadow:0 8px 18px rgba(15,23,42,.08);
}

.action-menu-toggle:hover,
.action-menu-toggle.show{
  background:var(--text);
  border-color:var(--text);
  color:#fff;
}

.action-menu{
  min-width:160px;
  padding:8px;
  border:1px solid var(--border);
  border-radius:14px;
  box-shadow:0 18px 42px rgba(15,23,42,.14);
}

.action-menu.show{
  margin-top:8px !important;
}

.action-menu form{ margin:0; }

.action-menu .btn{
  width:100%;
  min-height:36px;
  display:flex;
  align-items:center;
  justify-content:flex-start;
  gap:8px;
  font-weight:800;
  margin-bottom:6px;
}

.action-menu form:last-child .btn,
.action-menu .btn:last-child{ margin-bottom:0; }

/* MOBILE */
@media(max-width:768px){
  .panel{ padding:14px; }
}

</style>
</head>

<body>

@include('admin.headoffice-portals.hr.hr-partials.sidebar')

<div class="container py-4">

<!-- HEADER -->
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
  <div>
    <h4>Payslip Manager</h4>
    <small>Manage payroll files and employee payslips</small>
  </div>

  <span class="badge bg-dark">
    {{ now()->format('M d, Y') }}
  </span>
</div>

<div class="row g-3">

<!-- LEFT PANEL (UPLOAD + FOLDERS) -->
<div class="col-lg-4">

<!-- UPLOAD -->
<div class="panel mb-3">

<div class="panel-title mb-2">
<i class="fa fa-upload me-2"></i>Upload Payslips
</div>

<form id="uploadForm"
method="POST"
action="{{ route('admin.portals.hr.payslip.upload') }}"
enctype="multipart/form-data">

@csrf

<div class="row g-2 mb-2">

<div class="col-4">
<select name="month" class="form-select" required>
@for($m=1;$m<=12;$m++)
<option value="{{ $m }}">{{ date('F',mktime(0,0,0,$m,1)) }}</option>
@endfor
</select>
</div>

<div class="col-4">
<input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
</div>

<div class="col-4">
<select name="cutoff" class="form-select" required>
<option value="1">10 - 25</option>
<option value="2">26 - 10</option>
</select>
</div>

</div>




<div class="upload-box mb-2">
<i class="fa fa-cloud-upload fa-lg mb-2 text-muted"></i>
<input type="file" name="files[]" multiple class="form-control" required>
<small class="text-muted">Allowed: PDF / Images / DOC / ZIP. You can upload multiple files.</small>
</div>

<button id="uploadBtn" class="btn btn-primary w-100">
<i class="fa fa-upload"></i> Upload
</button>

</form>

</div>

<!-- FOLDERS -->
<div class="panel">

<div class="panel-title mb-3">
<i class="fa fa-folder me-2"></i>Folders
</div>

<div class="row g-2">

@foreach($folders as $f)

<div class="col-12">
<a href="{{ route('admin.portals.hr.payslip') }}?folder={{ $f['key'] }}"
class="text-decoration-none text-dark">

<div class="folder-card d-flex justify-content-between align-items-center">

<div>
<div class="folder-name">{{ $f['label'] }}</div>
<small class="text-muted">{{ $f['key'] }}</small>
</div>

<span class="badge bg-light text-dark">{{ $f['count'] }}</span>

</div>

</a>
</div>

@endforeach

</div>

</div>

</div>

<!-- RIGHT PANEL (FILES) -->
<div class="col-lg-8">

<div class="panel">

<div class="d-flex justify-content-between align-items-center mb-3">
<div class="panel-title">
<i class="fa fa-file me-2"></i>Payslip Files
</div>

<small class="text-muted">
{{ $payslips->total() }} files
</small>
</div>

<div class="table-wrapper">

<div class="table-responsive">

<table class="table table-hover mb-0">

<thead>
<tr>
<th>File</th>
<th>Folder</th>
<th>Date</th>
<th class="text-end">Action</th>
</tr>
</thead>

<tbody>

@forelse($payslips as $p)

<tr>

<td>
<strong>{{ $p->original_name }}</strong><br>
<small class="text-muted">
</small>
</td>

<td>
<span class="badge bg-light text-dark">
{{ $p->folder_key }}
</span>
</td>

<td>{{ $p->created_at->format('M d Y') }}</td>

<td class="text-end">
<div class="dropdown action-menu-wrap">
<button class="action-menu-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open actions">
<i class="fa fa-ellipsis"></i>
</button>
<div class="dropdown-menu dropdown-menu-end action-menu">
<a href="{{ route('admin.portals.hr.payslip.download',$p->id) }}"
class="btn btn-sm btn-outline-primary">
<i class="fa fa-download"></i>
Download
</a>

<form method="POST"
action="{{ route('admin.portals.hr.payslip.delete',$p->id) }}">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-outline-danger">
<i class="fa fa-trash"></i>
Delete
</button>

</form>
</div>
</div>
</td>

</tr>

@empty

<tr>
<td colspan="4" class="text-center text-muted p-4">
No payslips uploaded
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<div class="mt-3">
{{ $payslips->links() }}
</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){

    const form = document.getElementById('uploadForm');
    const btn = document.getElementById('uploadBtn');

    if(form){
        form.addEventListener('submit', function(){

            btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Uploading';

        });
    }

});
</script>

</body>
</html>


