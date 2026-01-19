<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifications</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite([
    'resources/css/user-dashboard/app.css',
    'resources/css/notifications/app.css',
    'resources/js/user-dashboard/app.js'
])

</head>

<body>

{{-- LOGIN OVERLAY --}}
<div class="login-overlay" id="loginOverlay">
    <div class="login-box">
        <i class="fas fa-user-check"></i>
        <h2>Welcome, {{ ucwords(strtolower(Auth::user()->name)) }}!</h2>
        <p>Loading dashboard...</p>
    </div>
</div>

<div class="wrapper">

    {{-- ✅ SIDEBAR --}}
    @include('user-dashboard.partials-dashboard.sidebar')

    <div class="main">

        {{-- ✅ HEADER --}}
        @include('user-dashboard.partials-dashboard.header')

        {{-- ✅ MAIN CONTENT (NOTIFICATIONS) --}}
        <div class="content">

            <div class="notification-container">

                <div class="notification-header">
                    <h2>Notifications</h2>
                    <span>Design only for now</span>
                </div>

                <div class="notification-list">

                    <div class="notification-item unread">
                        <div class="notification-icon icon-info">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="notification-content">
                            <h4>System Update</h4>
                            <p>Your exam schedule has been updated. Please review the changes.</p>
                            <div class="notification-time">5 minutes ago</div>
                        </div>
                    </div>

                    <div class="notification-item">
                        <div class="notification-icon icon-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="notification-content">
                            <h4>Submission Successful</h4>
                            <p>Your project has been submitted successfully.</p>
                            <div class="notification-time">2 hours ago</div>
                        </div>
                    </div>

                    <div class="notification-item">
                        <div class="notification-icon icon-warning">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <div class="notification-content">
                            <h4>Reminder</h4>
                            <p>Your exam will start tomorrow at 9:00 AM.</p>
                            <div class="notification-time">Yesterday</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
