<aside class="col-md-3 col-lg-2 sidebar p-0">
    <div class="sidebar-brand">
        <span>Company Portal</span>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('tickets.dashboard') }}" class="active">
            <i class="bi bi-life-preserver"></i>
            <span>Support Tickets</span>
        </a>

        {{--
        <a href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>User Dashboard</span>
        </a>
        --}}

        <a href="{{ route('custom.logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
    </nav>

    <form id="logout-form" method="POST" action="{{ route('custom.logout') }}" class="d-none">
        @csrf
    </form>
</aside>
