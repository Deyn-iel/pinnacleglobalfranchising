<!-- ================= TOP NAVBAR ================= -->
<nav class="admin-topbar">
    <div class="topbar-left">
        <button class="admin-sidebar-toggle" id="adminSidebarToggle" type="button" aria-label="Open admin menu"
            aria-controls="adminSidebar" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>

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

<style>
    .dashboard-header,
    .dash-card,
    .dash-icon,
    .page-header,
    .stat-card,
    .content-card,
    .table-wrapper,
    .table-wrap,
    .panel,
    .card,
    .alert,
    .modal-content,
    .action-menu,
    .action-menu-toggle {
        box-shadow: none !important;
    }

    .dash-card:hover,
    .stat-card:hover,
    .folder-card:hover {
        box-shadow: none !important;
    }

    .modal-dialog {
        width: min(900px, calc(100vw - 24px));
        max-width: calc(100vw - 24px) !important;
        margin: 12px auto !important;
        min-height: calc(100dvh - 24px);
        display: flex;
        align-items: center;
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
        width: 100%;
        min-width: 0;
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
        min-height: 0;
    }

    .modal-body img,
    .modal-body table,
    .modal-body iframe {
        max-width: 100%;
    }

    .modal-content form,
    .modal-body form {
        min-height: 0;
        min-width: 0;
    }

    .modal-content>form {
        display: flex;
        flex: 1 1 auto;
        flex-direction: column;
        min-height: 0;
    }

    .modal-content>form>.modal-body {
        min-height: 0;
    }

    .modal .grid,
    .modal .row,
    .modal .form-group,
    .modal .modal-code,
    .modal .card,
    .modal .card-box,
    .modal .content-card {
        min-width: 0;
        max-width: 100%;
    }

    .modal input,
    .modal select,
    .modal textarea,
    .modal .form-control,
    .modal .form-select {
        max-width: 100%;
    }

    .modal .table-responsive,
    .modal .table-wrap,
    .modal .table-wrapper {
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .modal .modal-code,
    .modal .inline-code,
    .modal p,
    .modal small,
    .modal td,
    .modal th,
    .modal label,
    .modal strong {
        overflow-wrap: break-word;
    }

    @media (max-width: 575.98px) {
        .modal-dialog {
            width: calc(100vw - 12px) !important;
            max-width: calc(100vw - 12px) !important;
            min-height: auto !important;
            margin: 6px auto !important;
            align-items: flex-start;
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

        .modal .grid {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        .modal .grid>[class*="col-"] {
            grid-column: 1 / -1 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        .modal .row>[class*="col-"] {
            flex: 0 0 100% !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        .modal-footer {
            align-items: stretch !important;
            flex-direction: column-reverse !important;
        }

        .modal-footer .btn,
        .modal-footer .btn-custom,
        .modal-footer button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    (() => {
        const initAdminSidebar = () => {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminSidebarOverlay');
            const toggle = document.getElementById('adminSidebarToggle');
            const closeButton = document.getElementById('adminSidebarClose');

            if (!sidebar || !toggle) return;

            const setOpen = (open) => {
                sidebar.classList.toggle('is-open', open);
                overlay?.classList.toggle('is-active', open);
                document.body.classList.toggle('admin-sidebar-open', open);
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            };

            toggle.addEventListener('click', () => {
                setOpen(!sidebar.classList.contains('is-open'));
            });

            overlay?.addEventListener('click', () => setOpen(false));
            closeButton?.addEventListener('click', () => setOpen(false));

            sidebar.querySelectorAll('a.nav-link').forEach((link) => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 991) setOpen(false);
                });
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') setOpen(false);
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 991) setOpen(false);
            });
        };

        const initResponsiveTableLabels = () => {
            document.querySelectorAll('table').forEach(table => {
                if (table.dataset.responsiveLabels === 'true') return;

                const headings = Array.from(table.querySelectorAll('thead th')).map(th =>
                    th.textContent.replace(/\s+/g, ' ').trim()
                );

                if (!headings.length) return;

                table.querySelectorAll('tbody tr').forEach(row => {
                    Array.from(row.children).forEach((cell, index) => {
                        if (cell.tagName !== 'TD' || cell.hasAttribute('data-label')) return;
                        cell.setAttribute('data-label', headings[index] || '');
                    });
                });

                table.dataset.responsiveLabels = 'true';
            });
        };

        const initFloatingActionDropdowns = () => {
            if (!window.bootstrap) return;

            const actionDropdowns = document.querySelectorAll([
                '.action-group.dropdown',
                '.action-menu-wrap.dropdown',
                '.actions.dropdown',
                '.file-actions.dropdown',
                '.table-action.dropdown',
            ].join(','));

            actionDropdowns.forEach(dropdown => {
                if (dropdown.dataset.floatingActionDropdown === 'true') return;

                const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
                const menu = dropdown.querySelector('.dropdown-menu');

                if (!toggle || !menu) return;

                dropdown.dataset.floatingActionDropdown = 'true';

                let originalParent = null;
                let originalNext = null;

                bootstrap.Dropdown.getOrCreateInstance(toggle, {
                    boundary: document.body,
                    popperConfig(defaultConfig) {
                        return {
                            ...defaultConfig,
                            strategy: 'fixed',
                            modifiers: [
                                ...(defaultConfig.modifiers || []),
                                {
                                    name: 'preventOverflow',
                                    options: {
                                        boundary: document.body,
                                        padding: 12,
                                    },
                                },
                            ],
                        };
                    },
                });

                dropdown.addEventListener('show.bs.dropdown', () => {
                    if (menu.parentNode === document.body) return;

                    originalParent = menu.parentNode;
                    originalNext = menu.nextSibling;
                    document.body.appendChild(menu);
                });

                dropdown.addEventListener('hidden.bs.dropdown', () => {
                    if (!originalParent) return;

                    if (originalNext && originalNext.parentNode === originalParent) {
                        originalParent.insertBefore(menu, originalNext);
                    } else {
                        originalParent.appendChild(menu);
                    }
                });
            });
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                initAdminSidebar();
                initResponsiveTableLabels();
                initFloatingActionDropdowns();
            });
        } else {
            initAdminSidebar();
            initResponsiveTableLabels();
            initFloatingActionDropdowns();
        }
    })();
</script>
