<!-- ================= TOP NAVBAR ================= -->
<nav class="admin-topbar">
    <div class="topbar-left">
        <i class="fas fa-shield-halved"></i>
        <span><a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color:#ffffffff;">Admin Panel</a></span>
    </div>

    <div class="topbar-right">
        <div class="admin-user">
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <span class="name">
                {{ ucwords(strtolower(Auth::user()->name)) }}
            </span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">
                <i class="fas fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</nav>
