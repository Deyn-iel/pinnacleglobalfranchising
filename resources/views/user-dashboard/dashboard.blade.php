<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ ucwords(strtolower(Auth::user()->name)) }}'s Dashboard</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite([
    'resources/css/user-dashboard/app.css',
    'resources/js/user-dashboard/app.js'
])
</head>

<body>

<div class="login-overlay" id="loginOverlay">
    <div class="login-box">
        <i class="fas fa-user-check"></i>
        <h2>Welcome, {{ ucwords(strtolower(Auth::user()->name)) }}!</h2>
        <p>Loading dashboard...</p>
    </div>
</div>


<div class="wrapper">

    @include('user-dashboard.partials-dashboard.sidebar')

    <div class="main">

        @include('user-dashboard.partials-dashboard.header')

        <div class="content fade-up">

            @if (session('error'))
                <div class="alert-error" id="alertError">
                    {{ session('error') }}
                </div>
            @endif

            <div class="cards">
                
                <div class="card">
                <h4>Active Users</h4>
                <h2>{{ $activeUsers }}</h2>
            </div>
            <div class="card">
                <h4>Exam</h4>
                <h2>
                    <a href="{{ route('video') }}" style="text-decoration: none; color:#0d3553; font-size:20px;"><i class="fas fa-arrow-right"></i> Take Exam</a>
                </h2>
            </div>

            <div class="card">
                <h4>Attendance</h4>
                <h2>
                    <a href="{{ route('attendance') }}" style="text-decoration: none; color:#0d3553; font-size:20px;"><i class="fas fa-arrow-right"></i> Mark Attendance</a>
                </h2>
            </div>

            {{-- <div class="card">
                <h4>Register</h4>
                <h2>
                    <a href="{{ route('registration') }}" style="text-decoration: none; color:#0d3553; font-size:20px;"><i class="fas fa-arrow-right"></i> Register</a>
                </h2>
            </div> --}}

                <div class="card">
                    <h4>Status</h4>
                    <h2 class="status-online">
                        <span class="dot-online"></span> Online
                    </h2>
                </div>
            </div>

            <div class="sections">
                <div class="activity">
                    <h3>Recent Activity</h3>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-sign-in-alt"></i></div>
                        <div class="activity-content">
                            <p>Logged in successfully</p>
                            <span id="loginTimeText">Just now</span>
                        </div>
                    </div>
                    {{-- <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-user-edit"></i></div>
                        <div class="activity-content">
                            <p>Updated profile information</p>
                            <span>Soon...</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="activity-content">
                            <p>Completed a task</p>
                            <span>Soon...</span>
                        </div>
                    </div> --}}
                </div>

                <!-- PROFILE -->
                <div class="profile-card">
                    <img src="data:image/svg+xml;utf8,
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%239ca3af'>
                <circle cx='12' cy='8' r='4'/>
                <path d='M4 20c0-4 4-6 8-6s8 2 8 6'/>
                </svg>">
                    <h3>{{ ucwords(strtolower(Auth::user()->name)) }}</h3>
                    <p>Active Member</p>
                    <div class="progress"><span></span></div>
                </div>
            </div>

        </div>
    </div>
    
</div>

</body>
</html>
