<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin · Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite([
    'resources/css/admin/app.css',
])
    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


    <style>
        body { background: #f5f6fa; }
        .sidebar-link:hover { background: #1f2937 !important; }
        .sidebar-link { text-decoration: none; }
        aside { z-index: 999; }
        main { transition: margin-left 0.3s; }

        /* Dashboard Cards */
        .dash-card {
            border-radius: 12px;
            transition: transform .2s, box-shadow .2s;
            cursor: pointer;
        }
        .dash-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .dash-icon {
            font-size: 40px;
            opacity: .8;
        }
        .sidebar-link {
    border-radius: 8px;
    transition: background 0.25s ease, padding-left 0.25s ease;
}

.sidebar-link:hover {
    background: rgba(255,255,255,0.1);
}

.sidebar-link.active {
    background: rgba(255,255,255,0.18);
    border-left: 4px solid #0d6efd;
    padding-left: 14px;
}

.sidebar-link.active i {
    color: #ffffff;
}

/* ================= PROFILE PAGE ================= */

.profile-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
    max-width: 720px;
}

/* CARD */
.profile-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 26px 28px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* CARD TITLE */
.profile-card h3,
.profile-card h2 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 6px;
    color: #0f172a;
}

.profile-card p {
    font-size: 13.5px;
    color: #64748b;
    margin-bottom: 18px;
}

/* FORM ELEMENTS (Jetstream override) */
.profile-card input[type="text"],
.profile-card input[type="email"],
.profile-card input[type="password"] {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    margin-top: 6px;
    transition: all 0.2s ease;
}

.profile-card input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
}

/* LABEL */
.profile-card label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

/* BUTTONS */
.profile-card button,
.profile-card .primary-button {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #ffffff;
    border: none;
    padding: 11px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    margin-top: 14px;
    transition: all 0.25s ease;
}

.profile-card button:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px rgba(37,99,235,0.4);
}

/* STATUS TEXT */
.profile-card .text-sm {
    font-size: 13px;
    margin-top: 8px;
}

/* SUCCESS TEXT */
.profile-card .text-green-600 {
    color: #16a34a;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    main {
        margin-left: 0 !important;
    }

    .profile-grid {
        max-width: 100%;
    }
}

    </style>
</head>

<body>

<!-- NAV -->
    @include('admin-sidebar.navbar')

{{-- SIDEBAR --}}
@include('admin-sidebar.sidebar')

{{-- MAIN CONTENT --}}
<main class="admin-main" style="margin-left:260px; padding:30px">

    <div class="page-title mb-4">
        <h2>
            <i class="fas fa-user-gear"></i> Admin Profile Settings
        </h2>
        <p>Manage your admin account information</p>
    </div>

    <div class="profile-grid">

        {{-- PROFILE + PASSWORD (COMBINED FORM) --}}
        <div class="profile-card">
            @include('admin.admin-profile.partials.update-admin-profile-information-form', [
                'user' => $user
            ])
        </div>

        

    </div>

</main>

</body>
</html>
