<!-- HEADER -->
<div class="header">
  <div class="header-left">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <h1><i class="fas fa-boxes-stacked"></i> Supplies Dashboard</h1>
  </div>

  <form method="POST" action="{{ route('custom.logout') }}">
    @csrf
    <button class="logout-btn">Log out</button>
  </form>
</div>
