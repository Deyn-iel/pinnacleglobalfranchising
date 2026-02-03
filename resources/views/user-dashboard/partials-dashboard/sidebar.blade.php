<aside class="user-sidebar" id="sidebar">
    <!-- HEADER -->
    <div class="sidebar-header">
        <div class="user-info">
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="user-text">
                <strong>{{ ucwords(strtolower(Auth::user()->name)) }}'s</strong>
                <small>Dashboard</small>
            </div>
        </div>
        <i class="fas fa-times close-btn" id="closeSidebar"></i>
    </div>

    <!-- NAV -->
    <ul class="sidebar-nav">

        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-house"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('attendance') ? 'active' : '' }}">
            <a href="{{ route('attendance') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>
        
        {{-- @php $disabled = true; @endphp
        <li class="{{ $disabled ? 'disabled' : '' }}">
            <a href="{{ $disabled ? 'javascript:void(0)' : route('attendance') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
                @if($disabled)
                    <small>soon</small>
                @endif
            </a>
        </li> --}}

        <li class="{{ request()->routeIs('video') ? 'active' : '' }}">
            <a href="{{ route('video') }}">
                <i class="fas fa-file-pen"></i>
                <span>Exam</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('notification') ? 'active' : '' }}">
            <a href="{{ route('notification') }}">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        
        <li class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-gear"></i>
                <span>Profile</span>
            </a>
        </li>

        <!-- LOGOUT -->
        <li class="logout-item">
            <form method="POST" action="{{ route('custom.logout') }}" onsubmit="handleLogout()">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-arrow-right-from-bracket"></i>
                    <span>Log out</span>
                </button>
            </form>
        </li>

    </ul>

    <hr class="sidebar-divider">

    <!-- FOOTER -->
    <div class="sidebar-footer">
        Pinnacle Global Franchising © {{ date('Y') }}
    </div>
</aside>

{{-- <li class="{{ request()->routeIs('notification') ? 'active' : '' }}">
            <a href="{{ route('notification') }}">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li> --}}

        {{-- <li class="{{ request()->routeIs('attendance') ? 'active' : '' }}">
            <a href="{{ route('attendance') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li> --}}