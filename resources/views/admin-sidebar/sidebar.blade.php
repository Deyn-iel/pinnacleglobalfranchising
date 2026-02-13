<aside class="admin-sidebar position-fixed top-0 start-0 h-100">

    <!-- BRAND -->
    <div class="sidebar-brand">
        <i class="fas fa-shield-halved"></i>
        <span>Admin Panel</span>
    </div>

    <!-- NAV -->
    <ul class="sidebar-nav">

        <li class="nav-section">MAIN</li>

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.attendance') }}"
               class="nav-link {{ request()->routeIs('admin.attendance') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>

        {{-- <li class="nav-item disabled">
            <a href="javascript:void(0)" class="nav-link">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
                <small>soon</small>
            </a>
        </li> --}}

        @php
        $hrAccess = auth()->user()->hr_access ?? false;
        @endphp

        <li class="nav-item">
        @if($hrAccess)
            <a href="{{ route('hr.dashboard') }}" class="nav-link {{ request()->routeIs('hr.dashboard') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i>
            <span>HR-Folder</span>
            </a>
        @else
            <a class="nav-link nav-disabled" href="javascript:void(0)" title="No access">
            <i class="fas fa-user-tie"></i>
            <span>HR-Folder</span>
            <small class="soon">Hr access required</small>
            </a>
        @endif
        </li>

        <li class="nav-section">ACCOUNT</li>

        <li class="nav-item">
            <a href="{{ route('admin.admin-profile.edit') }}"
               class="nav-link {{ request()->routeIs('admin.admin-profile.edit') ? 'active' : '' }}">
                <i class="fas fa-user-gear"></i>
                <span>My Profile</span>
            </a>
        </li>

        <li class="nav-section">MANAGEMENT</li>

        <li class="nav-item">
            <a href="{{ route('admin.application') }}"
               class="nav-link {{ request()->routeIs('admin.application') ? 'active' : '' }}">
                <i class="fas fa-folder-open"></i>
                <span>Applications</span>
            </a>
        </li>

        {{-- <li class="nav-item disabled">
            <a href="javascript:void(0)" class="nav-link">
                <i class="fas fa-boxes-stacked"></i>
                <span>Supplies</span>
                <small>soon</small>
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="{{ route('admin.supplies') }}"
               class="nav-link {{ request()->routeIs('admin.supplies') ? 'active' : '' }}">
                <i class="fas fa-boxes-stacked"></i>
                <span>Supplies</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.registration') }}"
               class="nav-link {{ request()->routeIs('admin.registration') ? 'active' : '' }}">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Registration</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{ route('admin.requirements') }}"
               class="nav-link {{ request()->routeIs('admin.requirements') ? 'active' : '' }}">
                <i class="fas fa-file-lines"></i>
                <span>Requirements</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="{{ route('admin.contacts') }}"
               class="nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                <i class="fas fa-address-book"></i>
                <span>Contacts</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.tickets.index') }}"
            class="nav-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
                <i class="fas fa-life-ring"></i>
                <span>Tickets</span>
            </a>
        </li>

        <li class="nav-section">USERS & EXAMS</li>

        <li class="nav-item">
            <a href="{{ route('admin.users-account') }}"
               class="nav-link {{ request()->routeIs('admin.users-account') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>User Accounts</span>
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

    <!-- FOOTER -->
    <div class="sidebar-bottom">
        <div class="sidebar-footer">
            Pinnacle Global Franchising  
            <small>© {{ date('Y') }}</small>
        </div>
    </div>

</aside>
