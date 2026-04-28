<style>
    .dropdown-menu.action-menu,
    .dropdown-menu.actions-menu,
    .dropdown-menu.file-actions-menu,
    .dropdown-menu.table-action-menu {
        z-index: 1080 !important;
    }

    @media (min-width: 769px) and (max-width: 1399.98px) {
        .table-responsive {
            overflow-x: visible !important;
        }

        .table-responsive table,
        table.table,
        .files-table {
            min-width: 0 !important;
            table-layout: fixed !important;
            width: 100% !important;
        }

        .table-responsive th,
        .table-responsive td,
        .files-table th,
        .files-table td {
            width: auto !important;
            min-width: 0 !important;
            max-width: none !important;
            padding: 10px 8px !important;
            font-size: 12px !important;
            white-space: normal !important;
            overflow-wrap: anywhere !important;
            word-break: normal !important;
        }

        .concern-cell,
        .description-box,
        .file-name,
        .file-info {
            min-width: 0 !important;
            max-width: none !important;
        }

        .badge,
        .badge-pill,
        .inline-code {
            max-width: 100%;
            white-space: normal !important;
            overflow-wrap: anywhere !important;
        }
    }
</style>

<script>
    (() => {
        const initResponsivePortalTableLabels = () => {
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

        const initFloatingPortalActionDropdowns = () => {
            if (!window.bootstrap) return;

            const dropdowns = document.querySelectorAll([
                '.action-wrap.dropdown',
                '.action-menu-wrap.dropdown',
                '.actions.dropdown',
                '.file-actions.dropdown',
                '.table-action.dropdown',
            ].join(','));

            dropdowns.forEach(dropdown => {
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
                initResponsivePortalTableLabels();
                initFloatingPortalActionDropdowns();
            });
        } else {
            initResponsivePortalTableLabels();
            initFloatingPortalActionDropdowns();
        }
    })();
</script>
