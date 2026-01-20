<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite([
    'resources/css/user-dashboard/app.css',
    'resources/css/profile/app.css',
    'resources/js/user-dashboard/app.js'
])
</head>
<body>

<div class="wrapper">

    @include('user-dashboard.partials-dashboard.sidebar')

    <div class="main">

        @include('user-dashboard.partials-dashboard.header')

        <div class="content profile-page">

            <div class="page-title">
                <h2><i class="fas fa-user-gear"></i> Profile Settings</h2>
                <p>Manage your personal information and account</p>
            </div>

            <div class="profile-grid">

    {{-- PROFILE INFO --}}
    <div class="profile-card">
        <h3>Personal Information</h3>
        @include('profile.partials.update-profile-information-form')
    </div>


</div>



        </div>
    </div>
</div>
<script>
document.addEventListener("click", function (e) {
    const icon = e.target.closest(".toggle-password");
    if (!icon) return;

    const wrapper = icon.closest(".password-wrapper");
    if (!wrapper) return;

    const input = wrapper.querySelector("input");
    if (!input) return;

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
});
</script>



</body>
</html>
