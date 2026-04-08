<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OM Dashboard</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite([
        'resources/css/chatbot/app.css',
            
            // js files
            'resources/js/chatbot/app.js'])
<style>

/* ================= ROOT DESIGN ================= */
:root{
--sidebar:260px;
--primary:#0f172a;
--accent:#3b82f6;
--bg:#f8fafc;
--card:#ffffff;
--border:#eef2f6;
--text:#0f172a;
--muted:#64748b;
--transition:all .25s ease;
}

body{
margin:0;
font-family:'Inter', system-ui;
background:var(--bg);
color:var(--text);
overflow-x:hidden;
}

/* ================= SIDEBAR UPGRADE ================= */
.sidebar{
position:fixed;
top:0;
left:0;
width:var(--sidebar);
height:100vh;
background:linear-gradient(145deg,#0f172a,#020617);
color:white;
padding:22px 18px;
transition:.3s;
z-index:1000;
box-shadow:8px 0 25px rgba(0,0,0,0.08);
}

.sidebar h4{
font-weight:700;
margin-bottom:30px;
}

.sidebar a{
display:flex;
align-items:center;
gap:12px;
padding:12px 14px;
border-radius:14px;
text-decoration:none;
color:#cbd5f5;
font-weight:500;
margin-bottom:6px;
transition:var(--transition);
}

.sidebar a:hover{
background:rgba(59,130,246,0.2);
color:white;
}

.sidebar a.active{
background:#3b82f6;
color:white;
box-shadow:0 6px 14px rgba(59,130,246,0.3);
}

/* ================= MAIN ================= */
main{
margin-left:var(--sidebar);
padding:28px;
transition:.3s;
}

/* ================= HEADER (GLASS STYLE) ================= */
.page-header{
background:rgba(255,255,255,0.85);
backdrop-filter:blur(8px);
border:1px solid rgba(255,255,255,0.6);
border-radius:22px;
padding:20px 24px;
margin-bottom:25px;
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
gap:10px;
box-shadow:0 4px 12px rgba(0,0,0,0.03);
}

.page-header h3{
margin:0;
font-weight:800;
}

/* ================= MOBILE ================= */
.mobile-menu{
display:none;
font-size:20px;
background:#fff;
border:1px solid var(--border);
padding:8px 12px;
border-radius:12px;
}

/* ================= STAT CARDS ================= */
.stat-card{
background:var(--card);
border-radius:22px;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;
transition:.3s;
border:1px solid var(--border);
box-shadow:0 2px 6px rgba(0,0,0,0.02);
}

.stat-card:hover{
box-shadow:0 20px 30px -12px rgba(0,0,0,0.08);
}

.stat-title{
font-size:11px;
text-transform:uppercase;
color:var(--muted);
font-weight:600;
}

.stat-value{
font-size:28px;
font-weight:800;
}

.stat-icon{
width:50px;
height:50px;
border-radius:18px;
background:#eff6ff;
display:flex;
align-items:center;
justify-content:center;
font-size:18px;
color:#3b82f6;
}

/* ================= PANEL ================= */
.panel{
background:var(--card);
border-radius:22px;
padding:20px;
border:1px solid var(--border);
box-shadow:0 4px 12px rgba(0,0,0,0.02);
}

.panel-title{
font-weight:700;
margin-bottom:15px;
border-left:4px solid var(--accent);
padding-left:10px;
}

/* ================= TABLE ================= */
.table{
border-collapse:separate;
border-spacing:0 8px;
}

thead th{
background:#f1f5f9;
font-size:11px;
text-transform:uppercase;
color:var(--muted);
border:none !important;
padding:12px;
}

tbody tr{
background:white;
border-radius:14px;
transition:.2s;
}



tbody td{
padding:12px;
border:none !important;
}

/* ================= BADGE MODERN ================= */
.badge{
border-radius:50px !important;
padding:6px 12px;
font-size:11px;
font-weight:600;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 991px){

main{
margin-left:0;
padding:18px;
}

.mobile-menu{
display:inline-block;
}

.sidebar{
left:-260px;
}

.sidebar.show{
left:0;
}

}

/* ================= LOGOUT ================= */
.logout-btn{
display:flex;
align-items:center;
gap:12px;
padding:12px 14px;
border-radius:14px;
background:none;
border:none;
color:#cbd5f5;
width:100%;
transition:0.2s;
}

.logout-btn:hover{
background:#ef4444;
color:white;
}

</style>
</head>

<body>
@include('admin.headoffice-portals.om.partials.sidebar')



<main>

<div class="page-header">

<div class="d-flex align-items-center gap-2">

<button class="mobile-menu" id="menuBtn">
<i class="fa-solid fa-bars"></i>
</button>

<div>
<h3>OM Dashboard</h3>
<small class="text-muted">Operations Manager Panel</small>
</div>

</div>

<div>
<span class="badge bg-dark">
<i class="fa-solid fa-calendar"></i>
{{ now()->format('M d, Y') }}
</span>
</div>

</div>


<div class="row g-3 mb-4">

<div class="col-lg-3 col-md-6">
<div class="stat-card">
<div>
<div class="stat-title">Employees</div>
<div class="stat-value">{{ \App\Models\User::count() }}</div>
</div>
<div class="stat-icon">
<i class="fa-solid fa-users"></i>
</div>
</div>
</div>


<div class="col-lg-3 col-md-6">
<div class="stat-card">
<div>
<div class="stat-title">Tickets</div>
<div class="stat-value">{{ \App\Models\Ticket::where('department', 'om')->count() }}</div>
</div>
<div class="stat-icon">
<i class="fa-solid fa-ticket"></i>
</div>
</div>
</div>

</div>


<div class="panel mb-4">

<div class="panel-title">
Recent Support Tickets
</div>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>
<tr>
<th>Ticket #</th>
<th>User</th>
<th>Department</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>

@php
use App\Models\Ticket;

$tickets = Ticket::with('user')
    ->where('department','om')
    ->latest()
    ->take(5)
    ->get();
@endphp
<tbody>

@forelse($tickets as $ticket)

<tr>
<td>{{ $ticket->ticket_no }}</td>

<td>
{{ $ticket->user->name ?? 'Unknown' }}
</td>

<td>
{{ strtoupper($ticket->department) }}
</td>

<td>
@php
  $isRequesting = $ticket->status === 'in_progress' && $ticket->approval_requested;
@endphp

<span class="badge
{{ $ticket->status === 'pending' ? 'bg-warning text-dark'
: ($isRequesting ? 'bg-warning text-dark'
: ($ticket->status === 'in_progress' ? 'bg-primary'
: ($ticket->status === 'resolved' ? 'bg-success'
: 'bg-secondary'))) }}">

{{ $isRequesting 
    ? 'Requesting' 
    : ucwords(str_replace('_',' ',$ticket->status)) }}

</span>
</td>

<td>
{{ $ticket->created_at->format('M d Y') }}
</td>

</tr>

@empty

<tr>
<td colspan="5" class="text-center text-muted">
No tickets found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>


</main>

<script>

const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");

menuBtn.onclick = () => {
sidebar.classList.toggle("show");
overlay.classList.toggle("active");
};

overlay.onclick = () => {
sidebar.classList.remove("show");
overlay.classList.remove("active");
};

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>