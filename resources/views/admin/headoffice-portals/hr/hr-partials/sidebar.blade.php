<div class="sidebar-overlay" id="overlay"></div>

<div class="sidebar" id="sidebar">

<h4>
<i class="fa-solid fa-user-tie"></i>
HR PANEL
</h4>

<a href="#" class="active">
<i class="fa-solid fa-chart-line"></i>
Dashboard
</a>

<a href="#">
<i class="fa-solid fa-receipt"></i>
Payslip
</a>

<a href="#">
<i class="fa-solid fa-user-plus"></i>
Registration
</a>

<a href="#">
<i class="fa-solid fa-bell"></i>
Notifications
</a>

<a href="{{ route('admin.portals.hr.tickets') }}"
class="nav-link {{ request()->routeIs('admin.portals.hr.tickets') ? 'active' : '' }}">

<i class="fa-solid fa-ticket"></i>
<span>Tickets</span>

</a>

<form method="POST" action="{{ route('custom.logout') }}">
@csrf
<button class="logout-btn w-100 text-start">
<i class="fas fa-right-from-bracket me-2"></i>
Logout
</button>
</form>

</div>