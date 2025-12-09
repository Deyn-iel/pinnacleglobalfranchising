<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" onclick="openSidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">

            <ul class="navbar-nav text-center">

                <li class="nav-item">
                    <a href="{{ url('/') }}" 
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}">HOME</a>
                </li>

                <!-- ABOUT -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" 
                        href="#" id="aboutDropdown" data-bs-toggle="dropdown">
                        ABOUT
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item{{ request()->is('franchisability/*') ? 'active' : '' }}" href="{{ url('/about/pinnacle') }}">Pinnacle Global</a></li>
                        <li><a class="dropdown-item" href="{{ url('/about/why') }}">Why Pinnacle?</a></li>
                        <li><a class="dropdown-item" href="{{ url('/about/franchise') }}">Franchise Consultant</a></li>
                        <li><a class="dropdown-item" href="{{ url('/about/clients') }}">Clients</a></li>
                    </ul>
                </li>

                <!-- SERVICES -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" 
                        href="#" data-bs-toggle="dropdown">
                        OUR SERVICES
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('our_service#services') }}">Services</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service#strategic-planning') }}">Strategic Planning</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service#legal-documentation') }}">Legal Documentation</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service#franchise-sales-training') }}">Franchise Sales Training</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service#operations-services') }}">Operations Services</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service#franchise-marketing') }}">Franchise Marketing Ser.</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service#special-services') }}">Special Services</a></li>
                    </ul>
                </li>

                <!-- FRANCHISABILITY -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" 
                        href="#" id="franchiseDropdown" data-bs-toggle="dropdown">
                        FRANCHISABILITY TEST
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/franchisability/franchise_test') }}">Franchise Test</a></li>
                        <li><a class="dropdown-item" href="{{ url('/franchisability/8_keys') }}">8 Keys to Franchisability</a></li>
                        <li><a class="dropdown-item" href="{{ url('/franchisability/franchising_checklist') }}">Franchising Checklist</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/contact') }}" 
                        class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
                        CONTACT US
                    </a>
                </li>


            </ul>
            
        </div>

    </div>
</nav>
<!-- MOBILE SIDEBAR -->
<div id="sidebarMenu" class="sidebar">

    <span class="sidebar-close" onclick="closeSidebar()">&times;</span>

    <a class="nav-link" href="{{ url('/') }}">HOME</a>

    <!-- ABOUT DROPDOWN -->
    <div class="sidebar-dropdown" onclick="toggleSidebarDropdown('aboutMenu')">
        ABOUT ▾
    </div>
    <div id="aboutMenu" class="sidebar-submenu">
        <a href="{{ url('/about/pinnacle') }}">Pinnacle Global</a>
        <a href="{{ url('/about/why') }}">Why Pinnacle?</a>
        <a href="{{ url('/about/franchise') }}">Franchise Consultant</a>
        <a href="{{ url('/about/clients') }}">Clients</a>
    </div>

    <!-- SERVICES DROPDOWN -->
    <div class="sidebar-dropdown" onclick="toggleSidebarDropdown('servicesMenu')">
        OUR SERVICES ▾
    </div>
    <div id="servicesMenu" class="sidebar-submenu">
        <a href="{{ url('our_service#services') }}">Services</a>
        <a href="{{ url('our_service#strategic-planning') }}">Strategic Planning</a>
        <a href="{{ url('our_service#legal-documentation') }}">Legal Documentation</a>
        <a href="{{ url('our_service#franchise-sales-training') }}">Franchise Sales Training</a>
        <a href="{{ url('our_service#operations-services') }}">Operations Services</a>
        <a href="{{ url('our_service#franchise-marketing') }}">Franchise Marketing Services</a>
        <a href="{{ url('our_service#special-services') }}">Special Services</a>
    </div>

    <!-- FRANCHISABILITY DROPDOWN -->
    <div class="sidebar-dropdown" onclick="toggleSidebarDropdown('franchisabilityMenu')">
        FRANCHISABILITY TEST ▾
    </div>
    <div id="franchisabilityMenu" class="sidebar-submenu">
        <a href="{{ url('/franchisability/franchise_test') }}">Franchise Test</a>
        <a href="{{ url('/franchisability/8_keys') }}">8 Keys to Franchisability</a>
        <a href="{{ url('/franchisability/franchising_checklist') }}">Franchising Checklist</a>
    </div>

    <a class="nav-link mt-3" href="{{ url('/contact') }}">CONTACT US</a>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openSidebar() {
        document.getElementById("sidebarMenu").classList.add("open");
    }

    function closeSidebar() {
        document.getElementById("sidebarMenu").classList.remove("open");
    }

    function toggleSidebarDropdown(id) {
        let submenu = document.getElementById(id);

        submenu.style.display = submenu.style.display === "block"
            ? "none"
            : "block";
    }
</script>


