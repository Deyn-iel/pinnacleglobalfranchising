<header class="site-header">
  <div class="header-container">

    <!-- Logo -->
    <div class="logo">
      <img src="{{ asset('img/logo1-removebg-preview.png') }}" alt="Kape Ilokano">
      <span>Pinnacle Global</span>
    </div>

    <!-- Navigation -->
    <nav class="nav-menu" id="navMenu">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Services</a>
      <a href="#">Contact</a>
      <a href="{{ url('/login') }}" class="btn-primary">Get Started</a>
    </nav>

    <!-- Toggle -->
    <div class="menu-toggle" id="menuToggle">
      <span></span>
      <span></span>
      <span></span>
    </div>

  </div>
</header>

<script>
  const toggle = document.getElementById("menuToggle");
  const nav = document.getElementById("navMenu");

  toggle.addEventListener("click", () => {
    nav.classList.toggle("show");
  });
</script>