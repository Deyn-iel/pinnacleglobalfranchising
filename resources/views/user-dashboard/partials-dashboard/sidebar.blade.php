<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <span class="logo-text">
            {{ ucwords(strtolower(Auth::user()->name)) }}'s Dashboard
        </span>
        <i class="fas fa-times close-btn" id="closeSidebar"></i>
    </div>

    <ul>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @php $disabled = true; @endphp
        <li style="{{ $disabled ? 'opacity:0.5; cursor:not-allowed;' : '' }}">
            <a href="{{ $disabled ? 'javascript:void(0)' : route('attendance') }}"
            style="{{ $disabled ? 'pointer-events:none;' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>



        {{-- <li class="{{ request()->routeIs('attendance') ? 'active' : '' }}">
            <a href="{{ route('attendance') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li> --}}

        <li class="{{ request()->routeIs('video') ? 'active' : '' }}" >
            <a href="{{ route('video') }}">
                <i class="fas fa-file-alt"></i>
                <span>Exam</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-gear"></i></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('notification') ? 'active' : '' }}">
            <a href="{{ route('notification') }}">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>

        {{-- LOGOUT --}}
        <li class="logout-item">
            <form method="POST" action="{{ route('custom.logout') }}" onsubmit="handleLogout()">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </li>
    </ul>
    <hr class="sidebar-divider">

<div class="sidebar-footer">
    Pinnacle Global Franchising &copy; {{ date('Y') }}
</div>

</aside>
