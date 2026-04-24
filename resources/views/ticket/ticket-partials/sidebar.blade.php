

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header" style="display:flex; justify-content:space-between; align-items:center;">

    <div class="logo-area">
        <div class="logo-icon">
            <img src="{{ asset('img/logo1-removebg-preview.png') }}" alt="Logo">
        </div>
        <div class="logo-text">
            <h2>PinnacleSupport</h2>
            <span>Your Support Desk</span>
        </div>
    </div>

    <button id="closeSidebarBtn" style="
    position:absolute;
    top:16px;
    right:16px;
    border:none;
    background:#f1f5f9;
    width:36px;
    height:36px;
    border-radius:50%;
    font-size:18px;
    cursor:pointer;
    display:none;
    z-index:2000;
">
    <i class="fas fa-xmark"></i>
</button>

</div>
        
    
           <div class="nav-menu"> 

    <a href="{{ route('tickets.dashboard') }}" 
        class="nav-item {{ request()->routeIs('tickets.dashboard') ? 'active' : '' }}">
        <i class="fas fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('tickets.myTickets') }}" 
        class="nav-item {{ request()->routeIs('tickets.myTickets') ? 'active' : '' }}">
        <i class="fas fa-ticket"></i>
        <span>Tickets</span>
    </a>

    <a href="{{ route('tickets.coupon') }}" 
        class="nav-item {{ request()->routeIs('tickets.coupon') ? 'active' : '' }}">
        <i class="fas fa-tags"></i>
        <span>Coupon's</span>
    </a>

    <a href="javascript:void(0)" class="nav-item disabled" style="color: #b6b6b6;">
        <i class="fa-solid fa-bullhorn" style="color: #b6b6b6;"></i>
        <span>Announcements</span>
        <small>soon</small>
    </a>

    <form method="POST" action="{{ route('custom.logout') }}">
        @csrf
        <button type="submit" class="nav-item logout-btn">
            <i class="fas fa-right-from-bracket"></i>
            <span>Logout</span>
        </button>
    </form>

</div> 
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="avatar">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="user-details">
                    <p>{{ ucwords(strtolower(Auth::user()->name)) }}</p>
                    <small>{{ Auth::user()->email }}</small>
                </div>
            </div>
        </div>
    </aside>