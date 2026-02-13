<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/admin/app.css'])
    <style>
        :root{
            --bg:#f6f8fb;
            --card:#ffffff;
            --text:#0f172a;
            --muted:#64748b;
            --stroke:#e5e7eb;
            --stroke-strong:#d1d5db;
            --primary:#0d3553;
            --primary-soft: rgba(13,53,83,.10);
            --shadow: 0 10px 30px rgba(15,23,42,.08);
            --radius: 16px;
            --sidebar-w: 260px;
            --topbar-h: 68px;
        }

        html,body{ height:100%; }
        body{
            margin:0;
            background: var(--bg);
            color: var(--text);
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
        }

        /* Layout */
        .adm-shell{
            min-height: 100vh;
            display:grid;
            grid-template-columns: var(--sidebar-w) 1fr;
        }

        .adm-sidebar{
            position: sticky;
            top:0;
            height: 100vh;
            background: #0b2a42;
            color: rgba(255,255,255,.92);
            padding: 18px 14px;
            border-right: 1px solid rgba(255,255,255,.06);
        }

        .adm-brand{
            display:flex;
            align-items:center;
            gap: 10px;
            padding: 10px 10px 14px;
            border-bottom: 1px solid rgba(255,255,255,.10);
            margin-bottom: 12px;
        }

        .adm-logo{
            width:42px;height:42px;
            border-radius: 14px;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.14);
            display:grid;
            place-items:center;
            overflow:hidden;
            flex:0 0 auto;
        }
        .adm-logo img{ width:100%; height:100%; object-fit:contain; padding:7px; }

        .adm-brand strong{ display:block; font-size:14px; letter-spacing:.2px; }
        .adm-brand span{ display:block; font-size:12px; color: rgba(255,255,255,.70); }

        .adm-nav{
            display:flex;
            flex-direction:column;
            gap: 4px;
            padding: 8px 6px;
        }

        .adm-link{
            display:flex;
            align-items:center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            color: rgba(255,255,255,.86);
            text-decoration:none;
            border: 1px solid transparent;
            transition: background .12s ease, border-color .12s ease, transform .12s ease;
        }
        .adm-link i{ width:18px; text-align:center; opacity:.95; }
        .adm-link:hover{
            background: rgba(255,255,255,.08);
            border-color: rgba(255,255,255,.10);
            transform: translateY(-1px);
        }
        .adm-link.active{
            background: rgba(255,255,255,.12);
            border-color: rgba(255,255,255,.14);
            color:#fff;
        }

        .adm-sidefoot{
            position:absolute;
            left: 14px;
            right: 14px;
            bottom: 14px;
            font-size: 12px;
            color: rgba(255,255,255,.65);
            border-top: 1px solid rgba(255,255,255,.10);
            padding-top: 12px;
        }

        .adm-main{
            min-width: 0;
            display:flex;
            flex-direction:column;
        }

        .adm-topbar{
            height: var(--topbar-h);
            position: sticky;
            top:0;
            z-index: 5;
            background: rgba(246,248,251,.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--stroke);
        }

        .adm-topinner{
            height: 100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 12px;
            padding: 0 20px;
        }

        .adm-search{
            width: min(520px, 100%);
            position:relative;
        }
        .adm-search i{
            position:absolute;
            left:12px;
            top:50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events:none;
        }
        .adm-search input{
            width:100%;
            border-radius: 999px;
            border: 1px solid var(--stroke-strong);
            background: #fff;
            padding: 10px 12px 10px 36px;
            outline:none;
        }
        .adm-search input:focus{
            border-color: rgba(13,53,83,.45);
            box-shadow: 0 0 0 4px rgba(13,53,83,.10);
        }

        .adm-user{
            display:flex;
            align-items:center;
            gap: 10px;
        }
        .adm-pill{
            display:inline-flex;
            align-items:center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 999px;
            border: 1px solid var(--stroke);
            background: #fff;
            font-size: 13px;
            color: var(--text);
        }
        .adm-avatar{
            width:34px;height:34px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary);
            display:grid;
            place-items:center;
            border: 1px solid rgba(13,53,83,.12);
        }

        .adm-content{
            padding: 20px;
        }

        .adm-wrap{
            width: min(1200px, 100%);
            margin: 0 auto;
        }

        .adm-pagehead{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap: 14px;
            margin-bottom: 14px;
        }

        .adm-title{
            margin:0;
            font-size: clamp(20px, 2.2vw, 28px);
            letter-spacing:-.3px;
        }
        .adm-subtitle{
            margin:6px 0 0 0;
            color: var(--muted);
            font-size: 13.5px;
            line-height: 1.45;
        }

        .adm-actions{
            display:flex;
            flex-wrap:wrap;
            gap: 10px;
        }

        .adm-btn{
            border-radius: 999px;
            border: 1px solid rgba(13,53,83,.22);
            padding: 10px 14px;
            font-size: 13px;
            cursor:pointer;
            background: var(--primary);
            color:#fff;
            box-shadow: 0 8px 18px rgba(13,53,83,.15);
            transition: transform .12s ease, filter .12s ease;
        }
        .adm-btn:hover{ transform: translateY(-1px); filter: brightness(1.05); }
        .adm-btn:active{ transform: translateY(0); }

        .adm-btn-ghost{
            background:#fff;
            color: var(--primary);
            border: 1px solid rgba(13,53,83,.25);
            box-shadow:none;
        }
        .adm-btn-ghost:hover{ filter:none; background: rgba(13,53,83,.04); }

        .adm-grid{
            display:grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 16px;
            align-items:start;
        }

        .adm-card{
            background: var(--card);
            border: 1px solid var(--stroke);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 18px;
        }

        .adm-cardhead{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 10px;
            margin-bottom: 12px;
        }

        .adm-cardtitle{
            margin:0;
            font-size: 14px;
            letter-spacing:.2px;
            display:flex;
            align-items:center;
            gap: 8px;
        }
        .adm-cardtitle i{ color: var(--primary); }

        .adm-badge{
            display:inline-flex;
            align-items:center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 999px;
            border: 1px solid var(--stroke);
            background: #fff;
            font-size: 12px;
            color: var(--text);
        }
        .adm-badge .dot{
            width:8px;height:8px;border-radius:999px;
            background:#22c55e;
            box-shadow: 0 0 0 6px rgba(34,197,94,.14);
        }

        /* Form controls (Bootstrap + nice spacing) */
        .form-label{ color: var(--muted); font-size: 12.5px; }
        .form-control, .form-select{
            border-radius: 12px !important;
            border-color: var(--stroke-strong) !important;
            padding: 10px 12px !important;
        }
        .form-control:focus, .form-select:focus{
            border-color: rgba(13,53,83,.45) !important;
            box-shadow: 0 0 0 4px rgba(13,53,83,.10) !important;
        }

        .adm-note{
            border: 1px solid var(--stroke);
            background: #fafafa;
            border-radius: 14px;
            padding: 12px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        /* Table */
        .adm-tablewrap{
            border: 1px solid var(--stroke);
            border-radius: 14px;
            overflow:hidden;
        }
        .table{
            margin:0;
        }
        .table thead th{
            background:#f8fafc;
            color: #334155;
            font-weight: 600;
            font-size: 12.5px;
            border-bottom: 1px solid var(--stroke) !important;
        }
        .table td{
            vertical-align: middle;
            font-size: 13px;
            color: #0f172a;
        }
        .adm-pill-mini{
            display:inline-flex;
            align-items:center;
            padding: 5px 10px;
            border-radius:999px;
            border:1px solid var(--stroke);
            background:#fff;
            font-size: 12px;
            color: #334155;
        }

        /* Responsive (desktop/laptop focused; still ok on smaller) */
        @media (max-width: 1100px){
            :root{ --sidebar-w: 240px; }
        }
        @media (max-width: 980px){
            .adm-shell{ grid-template-columns: 1fr; }
            .adm-sidebar{
                position: static;
                height: auto;
                border-right: 0;
                border-bottom: 1px solid rgba(255,255,255,.08);
            }
            .adm-sidefoot{ position: static; margin-top: 10px; }
            .adm-grid{ grid-template-columns: 1fr; }
            .adm-topinner{ padding: 0 14px; }
        }
        @media (max-width: 640px){
            .adm-content{ padding: 14px; }
            .adm-search{ display:none; }
        }
    </style>
</head>
<body>
    @include('admin-sidebar.navbar')
    @include('admin-sidebar.sidebar')

    <!-- Main -->
        <div class="adm-main">

            <!-- Content -->
            <main class="adm-content">
                <div class="adm-wrap">
                    <div class="adm-pagehead">
                        <div>
                            <h1 class="adm-title">User Registration</h1>
                            <p class="adm-subtitle">Design-only admin dashboard view for reviewing and managing registration submissions.</p>
                        </div>

                        <div class="adm-actions">
                            <button class="adm-btn adm-btn-ghost" type="button">
                                <i class="fa-solid fa-download me-1"></i> Export
                            </button>
                            <button class="adm-btn" type="button">
                                <i class="fa-solid fa-plus me-1"></i> New Entry
                            </button>
                        </div>
                    </div>

                    <div class="adm-grid">
                        <!-- Left: Table/List -->
                        <section class="adm-card">
                            <div class="adm-cardhead">
                                <h2 class="adm-cardtitle"><i class="fa-solid fa-list-check"></i> Recent Submissions</h2>
                                <span class="adm-badge"><span class="dot"></span> Live</span>
                            </div>

                            <div class="adm-tablewrap">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width: 34%;">Applicant</th>
                                            <th style="width: 28%;">Email</th>
                                            <th style="width: 18%;">Status</th>
                                            <th style="width: 20%;" class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="adm-pill-mini"><i class="fa-regular fa-user me-1"></i> John Doe</span>
                                                </div>
                                            </td>
                                            <td class="text-muted">john@example.com</td>
                                            <td><span class="adm-pill-mini">Draft</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-secondary rounded-pill">
                                                    <i class="fa-regular fa-eye me-1"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary rounded-pill">
                                                    <i class="fa-regular fa-pen-to-square me-1"></i> Edit
                                                </button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><span class="adm-pill-mini"><i class="fa-regular fa-user me-1"></i> Maria Santos</span></td>
                                            <td class="text-muted">maria@sample.com</td>
                                            <td><span class="adm-pill-mini">Pending</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-secondary rounded-pill">
                                                    <i class="fa-regular fa-eye me-1"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary rounded-pill">
                                                    <i class="fa-regular fa-pen-to-square me-1"></i> Edit
                                                </button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><span class="adm-pill-mini"><i class="fa-regular fa-user me-1"></i> Daniel Cruz</span></td>
                                            <td class="text-muted">daniel@sample.com</td>
                                            <td><span class="adm-pill-mini">Approved</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-secondary rounded-pill">
                                                    <i class="fa-regular fa-eye me-1"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary rounded-pill">
                                                    <i class="fa-regular fa-pen-to-square me-1"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">Showing 3 of 3 (UI sample)</small>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill">Prev</button>
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill">Next</button>
                                </div>
                            </div>
                        </section>

                        <!-- Right: Details / Review -->
                        <aside class="adm-card">
                            <div class="adm-cardhead">
                                <h2 class="adm-cardtitle"><i class="fa-solid fa-file-lines"></i> Review Panel</h2>
                                <span class="adm-pill-mini">Design only</span>
                            </div>

                            <div class="adm-note mb-3">
                                <strong>Tip:</strong> Select a submission from the list to show details here (backend later).
                            </div>

                            <form action="javascript:void(0)" method="post" novalidate>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="a_first">First name</label>
                                        <input class="form-control" id="a_first" type="text" placeholder="John">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="a_last">Last name</label>
                                        <input class="form-control" id="a_last" type="text" placeholder="Doe">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label" for="a_email">Email</label>
                                        <input class="form-control" id="a_email" type="email" placeholder="john@example.com">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label" for="a_status">Status</label>
                                        <select class="form-select" id="a_status">
                                            <option selected>Draft</option>
                                            <option>Pending</option>
                                            <option>Approved</option>
                                            <option>Rejected</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="a_notes">Admin notes</label>
                                        <textarea class="form-control" id="a_notes" rows="4" placeholder="Write notes here..."></textarea>
                                    </div>

                                    <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
                                        <button class="adm-btn adm-btn-ghost" type="button">
                                            <i class="fa-solid fa-xmark me-1"></i> Clear
                                        </button>
                                        <button class="adm-btn" type="button">
                                            <i class="fa-solid fa-check me-1"></i> Update (UI only)
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </aside>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>