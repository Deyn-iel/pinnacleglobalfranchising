<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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
                    <a class="nav-link dropdown-toggle {{ request()->is('about/*') ? 'active' : '' }}" 
                        href="#" id="aboutDropdown" data-bs-toggle="dropdown">
                        ABOUT
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/about/pinnacle') }}">Pinnacle Global</a></li>
                        <li><a class="dropdown-item" href="{{ url('/about/why') }}">Why Pinnacle?</a></li>
                        <li><a class="dropdown-item" href="{{ url('/about/franchise') }}">Franchise Consultant</a></li>
                        <li><a class="dropdown-item" href="{{ url('/about/clients') }}">Clients</a></li>
                    </ul>
                </li>

                <!-- SERVICES -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('our_service/*') ? 'active' : '' }}" 
                        href="#" data-bs-toggle="dropdown">
                        OUR SERVICES
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('our_service/#') }}">Services</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service/#') }}">Strategic Planning</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service/#') }}">Legal Documentation</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service/#') }}">Franchise Sales Training</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service/#') }}">Operations Services</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service/#') }}">Franchise Marketing Ser.</a></li>
                        <li><a class="dropdown-item" href="{{ url('our_service/#') }}">Special Services</a></li>
                    </ul>
                </li>

                <!-- FRANCHISABILITY -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('franchisability/*') ? 'active' : '' }}" 
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
