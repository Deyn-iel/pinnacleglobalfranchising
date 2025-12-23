<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite(['resources/css/user-dashboard/app.css' ,
            
            // js files
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
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            
            <span class="logo-text">
                {{ ucwords(strtolower(Auth::user()->name)) }}'s Dashboard
            </span>
            <i class="fas fa-times close-btn" id="closeSidebar"></i>
        </div>

        <ul>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proceed') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Exam</span>
                </a>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-edit"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li>
                <a href="{{ route('ordering.supplies') }}">
                    <i class="fas fa-box"></i>
                    <span>Order</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                </a>
            </li>

            <!-- LOGOUT -->
            <li class="logout-item">
                <form method="POST" action="{{ route('custom.logout') }}" onsubmit="handleLogout(event)">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>


    <div class="main">
        <div class="topbar">
            <i class="fas fa-bars menu-btn" id="menuBtn"></i>

            <!-- RIGHT SIDE -->
            <div class="profile">
                <span>Hi, {{ ucwords(strtolower(Auth::user()->name)) }}</span>
                <img src="data:image/svg+xml;utf8,
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%239ca3af'>
                <circle cx='12' cy='8' r='4'/>
                <path d='M4 20c0-4 4-6 8-6s8 2 8 6'/>
                </svg>">

            </div>
        </div>
        

        <div class="content">
            @if (session('error'))
            <div class="alert-error" id="alertError">
                {{ session('error') }}
            </div>
        @endif
            <div class="cards">
                <div class="card"><h4>Active Users</h4><h2>0</h2></div>
                <div class="card"><h4>Pending Tasks</h4><h2>0</h2></div>
                <div class="card"><h4>Notifications</h4><h2>0</h2></div>
                <div class="card">
                <h4>Status</h4>
                <h2 class="status-online">
                    <span class="dot-online"></span>
                    Online
                </h2>
            </div>

            </div>

            <div class="sections">
                <!-- ACTIVITY -->
                <div class="activity">
                    <h3>Recent Activity</h3>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-sign-in-alt"></i></div>
                        <div class="activity-content">
                            <p>Logged in successfully</p>
                            <span id="loginTimeText">Just now</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-user-edit"></i></div>
                        <div class="activity-content">
                            <p>Updated profile information</p>
                            <span>10 minutes ago</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="activity-content">
                            <p>Completed a task</p>
                            <span>1 hour ago</span>
                        </div>
                    </div>
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