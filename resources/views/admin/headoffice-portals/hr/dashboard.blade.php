<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HR Dashboard</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>

:root{
--sidebar:260px;
--primary:#0f172a;
--accent:#2563eb;
--bg:#f1f5f9;
--card:#ffffff;
--border:#e2e8f0;
--text:#0f172a;
--muted:#64748b;
}

body{
margin:0;
font-family:system-ui;
background:var(--bg);
color:var(--text);
overflow-x:hidden;
}

/* SIDEBAR */

.sidebar{
position:fixed;
top:0;
left:0;
width:var(--sidebar);
height:100vh;
background:#0f172a;
color:white;
padding:22px 18px;
transition:0.3s;
z-index:1000;
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
border-radius:10px;
text-decoration:none;
color:#cbd5f5;
font-weight:500;
margin-bottom:6px;
}

.sidebar a:hover{
background:#1e293b;
color:white;
}

.sidebar a.active{
background:#2563eb;
color:white;
}

/* MOBILE SIDEBAR */

.sidebar.mobile-hide{
left:-260px;
}

.sidebar-overlay{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.4);
z-index:900;
display:none;
}

.sidebar-overlay.active{
display:block;
}

/* MAIN */

main{
margin-left:var(--sidebar);
padding:28px;
transition:0.3s;
}

/* HEADER */

.page-header{
background:var(--card);
border:1px solid var(--border);
border-radius:12px;
padding:20px;
margin-bottom:20px;
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
gap:10px;
}

.page-header h3{
margin:0;
font-weight:700;
}

/* MOBILE HEADER */

.mobile-menu{
display:none;
font-size:20px;
background:#fff;
border:1px solid var(--border);
padding:8px 12px;
border-radius:8px;
}

/* STATS */

.stat-card{
background:var(--card);
border:1px solid var(--border);
border-radius:12px;
padding:18px;
display:flex;
justify-content:space-between;
align-items:center;
transition:.2s;
}

.stat-card:hover{
transform:translateY(-2px);
box-shadow:0 6px 20px rgba(0,0,0,.05);
}

.stat-title{
font-size:12px;
text-transform:uppercase;
color:var(--muted);
}

.stat-value{
font-size:24px;
font-weight:700;
}

.stat-icon{
width:40px;
height:40px;
border-radius:10px;
background:#f1f5f9;
display:flex;
align-items:center;
justify-content:center;
}

/* PANELS */

.panel{
background:var(--card);
border:1px solid var(--border);
border-radius:12px;
padding:20px;
}

.panel-title{
font-weight:600;
margin-bottom:15px;
}

/* TABLE */

table{
margin:0;
}

thead{
background:#f8fafc;
font-size:12px;
text-transform:uppercase;
color:var(--muted);
}

tbody td{
font-size:13px;
}

/* LOGOUT */

.logout-btn{
display:flex;
align-items:center;
gap:12px;
padding:12px 14px;
border-radius:10px;
background:none;
border:none;
color:#cbd5f5;
font-weight:500;
width:100%;
}

.logout-btn:hover{
background:#ef4444;
color:white;
}

/* TABLE RESPONSIVE */

.table-responsive{
overflow-x:auto;
}

/* RESPONSIVE */

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

</style>
</head>

<body>
@include('admin.headoffice-portals.hr.hr-partials.sidebar')



<main>

<div class="page-header">

<div class="d-flex align-items-center gap-2">

<button class="mobile-menu" id="menuBtn">
<i class="fa-solid fa-bars"></i>
</button>

<div>
<h3>HR Dashboard</h3>
<small class="text-muted">Human Resource Management Panel</small>
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
<div class="stat-value">120</div>
</div>
<div class="stat-icon">
<i class="fa-solid fa-users"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="stat-card">
<div>
<div class="stat-title">Payslips</div>
<div class="stat-value">350</div>
</div>
<div class="stat-icon">
<i class="fa-solid fa-file-invoice"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="stat-card">
<div>
<div class="stat-title">Registrations</div>
<div class="stat-value">25</div>
</div>
<div class="stat-icon">
<i class="fa-solid fa-user-check"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="stat-card">
<div>
<div class="stat-title">Tickets</div>
<div class="stat-value">8</div>
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

<tbody>

<tr>
<td>#TCK-001</td>
<td>John Doe</td>
<td>IT</td>
<td><span class="badge bg-warning text-dark">Pending</span></td>
<td>Mar 17 2026</td>
</tr>

<tr>
<td>#TCK-002</td>
<td>Maria Cruz</td>
<td>HR</td>
<td><span class="badge bg-primary">In Progress</span></td>
<td>Mar 16 2026</td>
</tr>

<tr>
<td>#TCK-003</td>
<td>Kevin Santos</td>
<td>Admin</td>
<td><span class="badge bg-success">Resolved</span></td>
<td>Mar 15 2026</td>
</tr>

</tbody>

</table>

</div>

</div>


<div class="panel">

<div class="panel-title">
Latest Registrations
</div>

<div class="table-responsive">

<table class="table table-hover">

<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>

<tbody>

<tr>
<td>Anna Garcia</td>
<td>anna@email.com</td>
<td><span class="badge bg-warning text-dark">Pending</span></td>
<td>Mar 16</td>
</tr>

<tr>
<td>Mark Reyes</td>
<td>mark@email.com</td>
<td><span class="badge bg-success">Approved</span></td>
<td>Mar 15</td>
</tr>

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