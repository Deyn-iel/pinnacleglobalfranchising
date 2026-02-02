<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin · Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite(['resources/css/admin/app.css'])

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
body {
    background: #f5f6fa;
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    additionally: hidden;
}

aside {
    width: 260px;
    z-index: 999;
}

/* ================= MAIN LAYOUT ================= */
main {
    margin-left: 260px;
    padding: clamp(24px, 2vw, 36px);
    max-width: calc(100vw - 260px);
    transition: margin-left .3s ease;
}

/* ================= PAGE HEADER ================= */
.page-header {
    background: #ffffff;
    border-radius: 18px;
    padding: 26px 30px;
    box-shadow: 0 18px 40px rgba(15,23,42,.08);
    margin-bottom: 32px;
}

.page-header h2 {
    font-weight: 800;
    margin-bottom: 6px;
}

.page-header i {
    color: #000000 !important;
}

.page-header p {
    margin-bottom: 0;
    color: #64748b;
}

/* ================= PROFILE GRID ================= */
.profile-grid {
    max-width: 760px;
}

/* ================= PROFILE CARD ================= */
.profile-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px 32px;
    box-shadow: 0 20px 45px rgba(15,23,42,.12);
}

/* TITLES INSIDE FORM */
.profile-card h3,
.profile-card h2 {
    font-weight: 800;
    font-size: 18px;
    margin-bottom: 6px;
    color: #0f172a;
}

.profile-card p {
    font-size: 13.5px;
    color: #64748b;
    margin-bottom: 18px;
}

/* ================= FORM INPUTS ================= */
.profile-card input[type="text"],
.profile-card input[type="email"],
.profile-card input[type="password"] {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    margin-top: 6px;
    transition: all .2s ease;
}

.profile-card input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37,99,235,.18);
}

/* ================= LABELS ================= */
.profile-card label {
    font-size: 13px;
    font-weight: 700;
    color: #374151;
}

/* ================= BUTTONS ================= */
.profile-card button,
.profile-card .primary-button {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #ffffff;
    border: none;
    padding: 11px 22px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    margin-top: 14px;
    transition: all .25s ease;
}

.profile-card button:hover,
.profile-card .primary-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 28px rgba(37,99,235,.4);
}

/* ================= STATUS TEXT ================= */
.profile-card .text-sm {
    font-size: 13px;
    margin-top: 8px;
}

.profile-card .text-green-600 {
    color: #16a34a;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 991px) {
    main {
        margin-left: 0;
        max-width: 100%;
    }
}
</style>
</head>

<body>

<!-- NAV -->
@include('admin-sidebar.navbar')

<!-- SIDEBAR -->
@include('admin-sidebar.sidebar')

<!-- MAIN CONTENT -->
<main>

    <!-- HEADER -->
    <div class="page-header">
        <h2>
            <i class="fas fa-user-gear text-primary me-2"></i>
            Admin Profile
        </h2>
        <p>Manage your account information and security settings</p>
    </div>

    <!-- PROFILE CONTENT -->
    <div class="profile-grid">

        <div class="profile-card">
            @include('admin.admin-profile.partials.update-admin-profile-information-form', [
                'user' => $user
            ])
        </div>

    </div>

</main>

</body>
</html>
