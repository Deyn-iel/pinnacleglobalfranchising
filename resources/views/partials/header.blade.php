<header class="site-header">
  <div class="header-container">

    <div class="logo">
  <a href="{{ url('/') }}" class="logo-link">
    <img src="{{ asset('img/logo1-removebg-preview.png') }}" alt="Logo">
    <span class="span">PINNACLE GLOBAL</span>
  </a>
</div>


    <nav class="nav-menu" id="navMenu">

      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'nav-active' : '' }}">
        <i class="ph ph-house"></i>
        HOME
    </a>

      <div class="nav-section {{ request()->is('about/*') ? 'active-parent' : '' }}">
      <div class="nav-section-title">
        <i class="ph ph-info"></i>
        ABOUT
      </div>
      <div class="nav-submenu">
        <a href="{{ url('/about/pinnacle') }}"
          class="{{ request()->is('about/pinnacle') ? 'submenu-active' : '' }}">
          Pinnacle Global
        </a>
        <a href="{{ url('/about/clients') }}"
          class="{{ request()->is('about/clients') ? 'submenu-active' : '' }}">
          Clients
        </a>
      </div>
    </div>


      <div class="nav-section {{ request()->is('our_service*') ? 'active-parent' : '' }}">
      <div class="nav-section-title">
        <i class="ph ph-briefcase"></i>
        OUR SERVICES
      </div>
      <div class="nav-submenu">
        <a href="{{ url('our_service#services') }}"
          class="{{ request()->is('our_service') ? 'submenu-active' : '' }}">
          Services
        </a>
        <a href="{{ url('our_service#strategic-planning') }}">Strategic Planning</a>
        <a href="{{ url('our_service#legal-documentation') }}">Legal Documentation</a>
        <a href="{{ url('our_service#franchise-sales-training') }}">Franchise Sales Training</a>
        <a href="{{ url('our_service#operations-services') }}">Operations Services</a>
        <a href="{{ url('our_service#franchise-marketing') }}">Franchise Marketing Ser.</a>
        <a href="{{ url('our_service#special-services') }}">Special Services</a>
      </div>
    </div>


      <div class="nav-section {{ request()->is('franchisability/*') ? 'active-parent' : '' }}">
      <div class="nav-section-title">
        <i class="ph ph-clipboard-text"></i>
        FRANCHISABILITY TEST
      </div>
      <div class="nav-submenu">
        <a href="{{ url('/franchisability/franchise_test') }}"
          class="{{ request()->is('franchisability/franchise_test') ? 'submenu-active' : '' }}">
          Franchise Test
        </a>
        <a href="{{ url('/franchisability/8_keys') }}"
          class="{{ request()->is('franchisability/8_keys') ? 'submenu-active' : '' }}">
          8 Keys to Franchisability
        </a>
        <a href="{{ url('/franchisability/franchising_checklist') }}"
          class="{{ request()->is('franchisability/franchising_checklist') ? 'submenu-active' : '' }}">
          Franchising Checklist
        </a>
      </div>
    </div>


      <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'nav-active' : '' }}">
          <i class="ph ph-phone"> </i>
          CONTACT US
      </a>

      <a href="{{ url('/login') }}" class="btn-primary">
        Get Started
      </a>

    </nav>

    <!-- TOGGLE -->
    <div class="menu-toggle" id="menuToggle">
      <span></span><span></span><span></span>
    </div>

  </div>
</header>
