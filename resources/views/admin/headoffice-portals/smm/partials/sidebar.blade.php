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
  transition:0.2s;
}

.logout-btn:hover{
  background:#ef4444;
  color:white;
}
</style>

<div class="sidebar-overlay" id="overlay"></div>

<div class="sidebar" id="sidebar">

<h4>
<i class="fa-solid fa-user-tie"></i>
SMM PANEL
</h4>

<a href="{{ route('admin.portals.smm') }}"
class="nav-link {{ request()->routeIs('admin.portals.smm') ? 'active' : '' }}">

<i class="fa-solid fa-chart-line"></i>
<span>Dashboard</span>

</a>


<a href="#">
<i class="fa-solid fa-bell"></i>
Notifications
</a>

{{-- <a href="#">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a> --}}

<a href="{{ route('admin.portals.smm.tickets') }}"
class="nav-link {{ request()->routeIs('admin.portals.smm.tickets') ? 'active' : '' }}">

<i class="fa-solid fa-ticket"></i>
<span>Tickets</span>

</a>

<a href="#">
                <i class="fas fa-user-gear"></i>
                <span>Profile</span>
            </a>

<form method="POST" action="{{ route('custom.logout') }}">
@csrf
<button class="logout-btn w-100 text-start">
<i class="fas fa-right-from-bracket me-2"></i>
Logout
</button>
</form>

</div>