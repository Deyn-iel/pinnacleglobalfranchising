<aside class="col-md-3 col-lg-2 sidebar p-0">
    <h5 class="text-center py-3 border-bottom">Company Portal</h5>

    <a href="{{ route('tickets.dashboard') }}" class="active">
        <i class="bi bi-life-preserver"></i>
        Support Tickets
    </a>

    {{-- Optional --}}
    {{-- 
    <a href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        User Dashboard
    </a>
    --}}

    <a href="{{ route('custom.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>

    <form id="logout-form" method="POST" action="{{ route('custom.logout') }}" class="d-none">
        @csrf
    </form>
</aside>
