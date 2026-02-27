<div class="topbar">
    <i class="fas fa-bars menu-btn" id="menuBtn"></i>

    <div class="profile">
        <span>Hi, {{ ucwords(strtolower(Auth::user()->name)) }}</span>
        <img src="data:image/svg+xml;utf8,
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%239ca3af'>
            <circle cx='12' cy='8' r='4'/>
            <path d='M4 20c0-4 4-6 8-6s8 2 8 6'/>
        </svg>">
    </div>
</div>
