@php
    $portal = $portal ?? 'it';

    $portalNames = [
        'it' => 'IT',
        'hr' => 'HR',
        'od' => 'OD',
        'om' => 'OM',
        'smm' => 'SMM',
        'admin-secretary' => 'Admin',
    ];

    $panelName = $panelName ?? ($portalNames[$portal] ?? strtoupper($portal)) . ' Panel';
    $companyFilesActive = request()->routeIs('portal.company-files*') && request()->route('department') === $portal;

    $navItems = [
        [
            'label' => 'Dashboard',
            'icon' => 'fa-solid fa-chart-line',
            'route' => "admin.portals.$portal",
            'active' => request()->routeIs("admin.portals.$portal"),
        ],
        [
            'label' => 'Company Files',
            'icon' => 'fa-solid fa-file-lines',
            'route' => 'portal.company-files',
            'params' => [$portal],
            'active' => $companyFilesActive,
        ],
    ];

    if ($portal === 'hr') {
        $navItems[] = [
            'label' => 'Payslip',
            'icon' => 'fa-solid fa-receipt',
            'route' => 'admin.portals.hr.payslip',
            'active' => request()->routeIs('admin.portals.hr.payslip*'),
        ];
        $navItems[] = [
            'label' => 'Registration',
            'icon' => 'fa-solid fa-user-plus',
            'route' => 'admin.portals.hr.registration',
            'active' => request()->routeIs('admin.portals.hr.registration'),
        ];
    }

    if ($portal === 'od') {
        $navItems[] = [
            'label' => 'Submitted Forms',
            'icon' => 'fa-solid fa-file-signature',
            'route' => 'admin.portals.od.register-franchise',
            'active' => request()->routeIs('admin.portals.od.register-franchise*'),
        ];
    }

    $navItems[] = [
        'label' => 'Notifications',
        'icon' => 'fa-solid fa-bell',
        'url' => '#',
        'active' => false,
    ];
    $navItems[] = [
        'label' => 'Tickets',
        'icon' => 'fa-solid fa-ticket',
        'route' => "admin.portals.$portal.tickets",
        'active' => request()->routeIs("admin.portals.$portal.tickets"),
    ];
    $navItems[] = [
        'label' => 'Profile',
        'icon' => 'fa-solid fa-user-gear',
        'url' => '#',
        'active' => false,
    ];
@endphp

<style>
    :root {
        --sidebar: clamp(232px, 18vw, 268px);
        --primary: #0f172a;
        --accent: #2563eb;
        --bg: #f1f5f9;
        --card: #ffffff;
        --border: #e2e8f0;
        --text: #0f172a;
        --muted: #64748b;
    }

    body {
        margin: 0;
        font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background: var(--bg);
        color: var(--text);
        overflow-x: hidden;
    }

    .sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        width: var(--sidebar);
        height: 100dvh;
        padding: 18px 14px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        background:
            radial-gradient(circle at 20% 0%, rgba(37, 99, 235, .22), transparent 34%),
            linear-gradient(180deg, #111827 0%, #0f172a 42%, #020617 100%);
        color: #ffffff;
        border-right: 1px solid rgba(148, 163, 184, .16);
        box-shadow: none;
        transition: transform .28s ease, left .28s ease;
        z-index: 1050;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, .35);
        border-radius: 999px;
    }

    .portal-sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        min-height: 54px;
        padding: 10px 10px 16px;
        border-bottom: 1px solid rgba(148, 163, 184, .18);
    }

    .portal-brand-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .portal-brand-title {
        margin: 0;
        color: #f8fafc;
        font-size: 17px;
        font-weight: 800;
        line-height: 1.05;
        letter-spacing: 0;
    }

    .portal-brand-subtitle {
        display: block;
        margin-top: 4px;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
    }

    .portal-sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding: 2px 2px 0;
    }

    .sidebar a,
    .logout-btn {
        width: 100%;
        min-height: 44px;
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 12px;
        border: 0;
        border-radius: 12px;
        background: transparent;
        color: #cbd5e1;
        text-align: left;
        text-decoration: none;
        font-size: 14px;
        font-weight: 650;
        line-height: 1.2;
        transition: background .2s ease, color .2s ease, transform .2s ease;
    }

    .sidebar a i,
    .logout-btn i {
        width: 20px;
        min-width: 20px;
        text-align: center;
        color: #93c5fd;
        font-size: 14px;
        transition: color .2s ease;
    }

    .sidebar a:hover,
    .sidebar a:focus-visible {
        background: rgba(37, 99, 235, .16);
        color: #ffffff;
        transform: translateX(2px);
        outline: none;
    }

    .sidebar a.active {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
    }

    .sidebar a.active i,
    .sidebar a:hover i,
    .sidebar a:focus-visible i {
        color: #ffffff;
    }

    .portal-sidebar-footer {
        margin-top: auto;
        padding: 12px 2px 0;
        border-top: 1px solid rgba(148, 163, 184, .18);
    }

    .portal-user-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 10px;
        margin-bottom: 8px;
        border-radius: 12px;
        background: rgba(15, 23, 42, .58);
        border: 1px solid rgba(148, 163, 184, .14);
    }

    .portal-user-avatar {
        width: 30px;
        height: 30px;
        flex: 0 0 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e0f2fe;
        color: #0369a1;
        font-size: 12px;
        font-weight: 800;
    }

    .portal-user-name {
        max-width: 160px;
        color: #f8fafc;
        font-size: 12px;
        font-weight: 750;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .portal-user-role {
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .55px;
    }

    .sidebar form {
        margin: 0;
    }

    .logout-btn {
        cursor: pointer;
        color: #fecaca;
    }

    .logout-btn i {
        color: #fca5a5;
    }

    .logout-btn:hover,
    .logout-btn:focus-visible {
        background: rgba(239, 68, 68, .15);
        color: #ffffff;
        transform: translateX(2px);
        outline: none;
    }

    .logout-btn:hover i,
    .logout-btn:focus-visible i {
        color: #ffffff;
    }

    .sidebar-overlay {
        position: fixed;
        inset: 0;
        display: none;
        background: rgba(2, 6, 23, .58);
        backdrop-filter: blur(3px);
        z-index: 1040;
    }

    .sidebar-overlay.active {
        display: block;
    }

    .portal-sidebar-toggle {
        position: fixed;
        top: 14px;
        left: 14px;
        width: 42px;
        height: 42px;
        display: none;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(226, 232, 240, .9);
        border-radius: 12px;
        background: #ffffff;
        color: #0f172a;
        z-index: 1030;
    }

    .mobile-menu#menuBtn {
        display: none !important;
    }

    .portal-sidebar-close {
        width: 34px;
        height: 34px;
        margin-left: auto;
        display: none;
        align-items: center;
        justify-content: center;
        flex: 0 0 34px;
        border: 1px solid rgba(148, 163, 184, .18);
        border-radius: 10px;
        background: rgba(255, 255, 255, .06);
        color: #e5e7eb;
        cursor: pointer;
        transition: background .18s ease, border-color .18s ease, color .18s ease;
    }

    .portal-sidebar-close:hover,
    .portal-sidebar-close:focus-visible {
        background: rgba(255, 255, 255, .12);
        border-color: rgba(255, 255, 255, .18);
        color: #ffffff;
        outline: none;
    }

    .page-header,
    .stat-card,
    .panel,
    .user-card,
    .content-card,
    .table-wrapper,
    .table-wrap,
    .card,
    .alert,
    .modal-content,
    .action-menu,
    .action-menu-toggle,
    .dropdown-menu {
        box-shadow: none !important;
    }

    .stat-card:hover,
    .user-card:hover,
    .card:hover {
        box-shadow: none !important;
    }

    .modal-dialog {
        width: min(900px, calc(100vw - 24px));
        max-width: calc(100vw - 24px) !important;
        margin: 12px auto !important;
    }

    .modal-dialog.modal-lg {
        width: min(900px, calc(100vw - 24px));
    }

    .modal-dialog.modal-xl {
        width: min(1140px, calc(100vw - 24px));
    }

    .modal-content {
        max-height: calc(100dvh - 24px);
        display: flex;
        flex-direction: column;
        border-radius: 14px !important;
        overflow: hidden;
    }

    .modal-header,
    .modal-footer {
        flex: 0 0 auto;
        gap: 10px;
        flex-wrap: wrap;
    }

    .modal-body {
        flex: 1 1 auto;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }

    .modal-body img,
    .modal-body table,
    .modal-body iframe {
        max-width: 100%;
    }

    @media (max-width: 1199.98px) {
        :root {
            --sidebar: 236px;
        }

        .sidebar a,
        .logout-btn {
            font-size: 13.5px;
            padding: 10px 11px;
        }
    }

    @media (max-width: 991.98px) {
        :root {
            --sidebar: min(284px, 86vw);
        }

        .sidebar {
            left: 0 !important;
            transform: translateX(-105%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .portal-sidebar-toggle {
            display: inline-flex;
        }

        .portal-sidebar-close {
            display: inline-flex;
        }
    }

    @media (max-width: 575.98px) {
        .sidebar {
            padding: 16px 12px;
        }

        .portal-brand-title {
            font-size: 16px;
        }

        .modal-dialog {
            width: calc(100vw - 12px) !important;
            max-width: calc(100vw - 12px) !important;
            min-height: auto !important;
            margin: 6px auto !important;
        }

        .modal-content {
            max-height: calc(100dvh - 12px);
            border-radius: 12px !important;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 14px !important;
        }

        .modal-title {
            font-size: 16px !important;
            line-height: 1.25 !important;
        }
    }
</style>

<button class="portal-sidebar-toggle" id="portalSidebarToggle" type="button" aria-label="Open sidebar">
    <i class="fa-solid fa-bars"></i>
</button>

<div class="sidebar-overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar" aria-label="{{ $panelName }} navigation">
    <div class="portal-sidebar-brand">
        <div class="portal-brand-icon">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div>
            <h4 class="portal-brand-title">{{ $panelName }}</h4>
            <span class="portal-brand-subtitle">Head Office Portal</span>
        </div>
        <button class="portal-sidebar-close" id="portalSidebarClose" type="button" aria-label="Close sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="portal-sidebar-nav">
        @foreach ($navItems as $item)
            <a href="{{ isset($item['route']) ? route($item['route'], $item['params'] ?? []) : $item['url'] }}"
                class="nav-link {{ $item['active'] ? 'active' : '' }}">
                <i class="{{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="portal-sidebar-footer">
        @auth
            @php
                $name = auth()->user()->name ?? 'Admin';
                $initials = collect(explode(' ', trim($name)))
                    ->filter()
                    ->take(2)
                    ->map(fn($part) => substr($part, 0, 1))
                    ->implode('');
            @endphp
            <div class="portal-user-chip">
                <span class="portal-user-avatar">{{ strtoupper($initials ?: 'A') }}</span>
                <div>
                    <div class="portal-user-name">{{ $name }}</div>
                    <div class="portal-user-role">{{ $portalNames[$portal] ?? 'Portal' }}</div>
                </div>
            </div>
        @endauth

        <form method="POST" action="{{ route('custom.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    (() => {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggles = [
            document.getElementById('portalSidebarToggle'),
            document.getElementById('menuBtn'),
        ].filter(Boolean);
        const closeButton = document.getElementById('portalSidebarClose');

        if (!sidebar) return;

        const closeSidebar = () => {
            sidebar.classList.remove('show');
            overlay?.classList.remove('active');
        };

        const toggleSidebar = () => {
            sidebar.classList.toggle('show');
            overlay?.classList.toggle('active', sidebar.classList.contains('show'));
        };

        toggles.forEach((toggle) => {
            if (toggle.dataset.portalSidebarBound === 'true') return;
            toggle.dataset.portalSidebarBound = 'true';
            toggle.addEventListener('click', toggleSidebar);
        });

        overlay?.addEventListener('click', closeSidebar);
        closeButton?.addEventListener('click', closeSidebar);

        sidebar.querySelectorAll('a.nav-link').forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 991) closeSidebar();
            });
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 991) closeSidebar();
        });
    })();
</script>

@include('admin.headoffice-portals.partials.floating-action-dropdowns')
