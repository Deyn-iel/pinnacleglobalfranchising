<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HR • Payslips</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>

body{
font-family:system-ui;
background:#f3f4f6;
}

.panel{
background:#fff;
border:1px solid #e5e7eb;
border-radius:14px;
margin-bottom:20px;
}

.panel-h{
padding:14px;
border-bottom:1px solid #e5e7eb;
font-weight:700;
}

.panel-b{
padding:16px;
}

.folder-item{
display:flex;
justify-content:space-between;
padding:10px 12px;
border:1px solid #e5e7eb;
border-radius:10px;
margin-bottom:8px;
text-decoration:none;
color:#111;
}

.folder-item:hover{
background:#f9fafb;
}

.pill{
padding:4px 8px;
border-radius:20px;
background:#f1f5f9;
font-size:12px;
font-weight:600;
}

.upload-box{
border:2px dashed #d1d5db;
border-radius:12px;
padding:20px;
text-align:center;
}

</style>
</head>

<body>

@include('admin.headoffice-portals.hr.hr-partials.sidebar')

<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-3">

<div>
<h4 class="mb-0 fw-bold">Payslip Manager</h4>
<small class="text-muted">Upload and manage employee payslips</small>
</div>

</div>


{{-- ================= UPLOAD SECTION ================= --}}
<div class="panel">

<div class="panel-h">
<i class="fa fa-upload"></i> Upload Payslips
</div>

<div class="panel-b">

<form method="POST"
action="{{ route('admin.portals.hr.payslip.upload') }}"
enctype="multipart/form-data">

@csrf

<div class="row g-3">

<div class="col-md-3">
<label class="form-label">Month</label>
<select name="month" class="form-select" required>
@for($m=1;$m<=12;$m++)
<option value="{{ $m }}">{{ date('F',mktime(0,0,0,$m,1)) }}</option>
@endfor
</select>
</div>

<div class="col-md-3">
<label class="form-label">Year</label>
<input type="number"
name="year"
class="form-control"
value="{{ date('Y') }}"
required>
</div>

<div class="col-md-6">
<label class="form-label">Batch Name</label>
<input type="text"
name="batch_name"
class="form-control"
placeholder="Example: Payroll Batch 1">
</div>

<div class="col-12">

<div class="upload-box">

<i class="fa fa-file-arrow-up fa-2x mb-2 text-muted"></i>

<p class="mb-2 fw-semibold">
Upload multiple payslips or ZIP file
</p>

<input
type="file"
name="files[]"
multiple
class="form-control"
required>

<small class="text-muted">
Supported: PDF, DOC, DOCX, JPG, PNG, ZIP
</small>

</div>

</div>

<div class="col-12 text-end">
<button class="btn btn-dark">
<i class="fa fa-upload"></i> Upload Payslips
</button>
</div>

</div>

</form>

</div>
</div>


{{-- ================= MAIN GRID ================= --}}
<div class="row g-3">


{{-- ===== LEFT FOLDERS ===== --}}
<div class="col-lg-4">

<div class="panel">

<div class="panel-h">
<i class="fa fa-folder"></i> Payslip Folders
</div>

<div class="panel-b">

<a href="{{ route('admin.portals.hr.payslip') }}"
class="folder-item">
All Folders
</a>

@foreach($folders as $f)

<a
href="{{ route('admin.portals.hr.payslip') }}?folder={{ $f['key'] }}"
class="folder-item">

<div>
<strong>{{ $f['label'] }}</strong><br>
<small class="text-muted">{{ $f['key'] }}</small>
</div>

<span class="pill">{{ $f['count'] }}</span>

</a>

@endforeach

</div>

</div>

</div>



{{-- ===== RIGHT FILE LIST ===== --}}
<div class="col-lg-8">

<div class="panel">

<div class="panel-h d-flex justify-content-between">

<span>
<i class="fa fa-file"></i>
Payslip Files
</span>

<span class="text-muted">
{{ $payslips->total() }} files
</span>

</div>

<div class="panel-b p-0">

<div class="p-3 border-bottom">

<form method="GET"
action="{{ route('admin.portals.hr.payslip') }}"
class="d-flex gap-2">

<input
type="text"
name="q"
value="{{ $q }}"
placeholder="Search payslip..."
class="form-control">

<button class="btn btn-dark">
<i class="fa fa-search"></i>
</button>

</form>

</div>

<div class="table-responsive">

<table class="table table-hover align-middle mb-0">

<thead>
<tr>
<th>File</th>
<th>Folder</th>
<th>Uploader</th>
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
Batch: {{ $p->batch_name ?? '-' }}
</small>
</td>

<td>
<span class="pill">{{ $p->folder_key }}</span>
</td>

<td>
{{ $p->uploader->name ?? '-' }}
</td>

<td>
{{ $p->created_at->format('M d Y') }}
</td>

<td class="text-end">

<a
href="{{ route('admin.portals.hr.payslip.download',$p->id) }}"
class="btn btn-sm btn-outline-dark">

<i class="fa fa-download"></i>

</a>

<form
method="POST"
action="{{ route('admin.portals.hr.payslip.delete',$p->id) }}"
class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-outline-danger">
<i class="fa fa-trash"></i>
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="5" class="text-center text-muted p-4">
No payslips uploaded yet
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<div class="p-3">

{{ $payslips->links() }}

</div>

</div>

</div>

</div>

</div>

</body>
</html>