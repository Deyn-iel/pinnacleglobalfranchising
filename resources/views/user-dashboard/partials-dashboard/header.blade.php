<div class="topbar">
    <i class="fas fa-bars menu-btn" id="menuBtn"></i>

    <div class="profile">
        <a href="{{ route('notification') }}" class="notification-icon" aria-label="Notifications">
            <i class="fa-solid fa-bell"></i>

            @if(($unreadCount ?? 0) > 0)
                <span class="notif-badge">
                    {{ ($unreadCount ?? 0) > 99 ? '99+' : ($unreadCount ?? 0) }}
                </span>
            @endif
        </a>

        <img src="data:image/svg+xml;utf8,
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%239ca3af'>
            <circle cx='12' cy='8' r='4'/>
            <path d='M4 20c0-4 4-6 8-6s8 2 8 6'/>
        </svg>">
    </div>
</div>