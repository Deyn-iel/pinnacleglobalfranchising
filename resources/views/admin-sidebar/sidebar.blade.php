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

        {{-- <li class="nav-item">
            <a href="{{ route('admin.admin-portal') }}"
               class="nav-link {{ request()->routeIs('admin.admin-portal') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span>Third Party Admin</span>
            </a>
        </li> --}}

        <li class="nav-item disabled">
            <a href="javascript:void(0)" class="nav-link">
                <i class="fas fa-building"></i>
                <span>Third Party Admin</span>
                <small>soon</small>
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

<li class="nav-item" x-data="{ open: true }">
@if($hrAccess)

  <!-- TOGGLE -->
  <a href="#"
     class="nav-link d-flex justify-content-between align-items-center"
     @click.prevent="open = !open"
     :aria-expanded="open.toString()">

    <span>
      <i class="fas fa-user-tie me-2"></i>
      HR-Folder
    </span>

    <i class="fa-solid fa-chevron-down small"
       :style="open
          ? 'transform: rotate(180deg); transition: transform .25s ease;'
          : 'transform: rotate(0deg); transition: transform .25s ease;'">
    </i>
  </a>

  <div class="sb-dd" :class="open ? 'is-open' : ''">
    <ul class="nav flex-column ms-4 mt-2">

      <li class="nav-item">
        <a href="{{ route('hr.dashboard') }}"
           class="nav-link {{ request()->routeIs('hr.dashboard') ? 'active' : '' }}">
          <i class="fa-solid fa-file-invoice-dollar me-2"></i>  
          Upload Payslip
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.registration') }}"
           class="nav-link {{ request()->routeIs('admin.registration') ? 'active' : '' }}">
          <i class="fa-solid fa-pen-to-square me-2"></i>
          Registration
        </a>
      </li>

    </ul>
  </div>

@else
  <a class="nav-link nav-disabled" href="javascript:void(0)">
    <i class="fas fa-user-tie me-2"></i>
    HR-Folder
    <small class="soon ms-1">Hr access required</small>
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
            <a href="{{ route('admin.attendance') }}"
               class="nav-link {{ request()->routeIs('admin.attendance') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        </li>

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

        {{-- <li class="nav-item">
            <a href="{{ route('admin.registration') }}"
               class="nav-link {{ request()->routeIs('admin.registration') ? 'active' : '' }}">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Registration</span>
            </a>
        </li> --}}

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



