<div class="topbar">
  <div class="topbar-left">
    <div class="toggle-btn" id="toggleBtn" aria-label="Toggle sidebar">
      <i class="fas fa-bars"></i>
    </div>
    <h1><i class="fas fa-boxes-stacked me-2"></i>Supplies</h1>
  </div>

  
  <form method="POST" action="{{ route('custom.logout') }}">
    @csrf
    <button class="logout" type="submit" aria-label="Logout">
      <i class="fas fa-arrow-right-from-bracket"></i>
    </button>
  </form>
</div>