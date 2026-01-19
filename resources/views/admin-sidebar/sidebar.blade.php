<aside class="admin-sidebar position-fixed top-0 start-0 h-100">
    <!-- BRAND -->
    <div class="sidebar-brand">
        <i class="fas fa-shield-halved"></i>
    </div>

    <!-- NAV -->
    <ul class="sidebar-nav">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item" style="opacity:0.5; cursor:not-allowed;">
            <a href="javascript:void(0)"
            class="nav-link"
            onclick="return false;"
            style="pointer-events:none;">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{ route('admin.attendance') }}"
               class="nav-link {{ request()->routeIs('admin.attendance') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="{{ route('admin.application') }}"
               class="nav-link {{ request()->routeIs('admin.application') ? 'active' : '' }}">
                <i class="fas fa-folder-open"></i>
                <span>Applications</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.supplies') }}"
               class="nav-link {{ request()->routeIs('admin.supplies') ? 'active' : '' }}">
                <i class="fas fa-boxes-stacked"></i>
                <span>Supplies</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.admin-profile.edit') }}"
            class="nav-link {{ request()->routeIs('admin.admin-profile.edit') ? 'active' : '' }}">
                <i class="fas fa-user-gear"></i>
                <span>My Profile</span>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{ route('admin.requirements') }}"
               class="nav-link {{ request()->routeIs('admin.requirements') ? 'active' : '' }}">
                <i class="fas fa-file-lines"></i>
                <span>Requirements</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.contacts') }}"
               class="nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                <i class="fas fa-address-book"></i>
                <span>Contacts</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users-account') }}"
               class="nav-link {{ request()->routeIs('admin.users-account') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Users Accounts</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.uploading-exams') }}"
               class="nav-link {{ request()->routeIs('admin.uploading-exams') ? 'active' : '' }}">
                <i class="fas fa-file-pen"></i>
                <span>Upload Exams</span>
            </a>
        </li>


    </ul>
    <!-- 🔥 BOTTOM SECTION -->
    <div class="sidebar-bottom">
        <hr class="sidebar-divider">
        <div class="sidebar-footer">
            Pinnacle Global Franchising © {{ date('Y') }}
        </div>
    </div>
</aside>
