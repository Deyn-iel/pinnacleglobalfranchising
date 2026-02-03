<div class="header d-flex justify-content-between align-items-center">
    <div class="header-left">
        <h5 class="mb-0">@yield('page-title')</h5>
        <small class="header-sub">Support Management</small>
    </div>

    <div class="header-right d-flex align-items-center gap-3">
        <div class="dark-toggle" id="darkToggle" title="Toggle dark mode">
            <i class="bi bi-moon-stars-fill"></i>
        </div>

        <div class="user-pill">
            <i class="bi bi-person-circle"></i>
            <span>{{ Auth::user()->name }}</span>
        </div>
    </div>
</div>
