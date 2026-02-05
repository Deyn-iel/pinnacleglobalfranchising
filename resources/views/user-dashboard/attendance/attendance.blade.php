<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Attendance | Kape Ilokano</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite([
        'resources/css/user-dashboard/app.css',
        'resources/js/user-dashboard/app.js',

        'resources/css/attendance/app.css',
        'resources/js/attendance/app.js'
    ])

</head>

<body>

@include('user-dashboard.partials-dashboard.sidebar')
@include('user-dashboard.partials-dashboard.header')
<div class="attendance-wrapper">
    
<div class="main">


<div class="content fade-up">

<div class="attendance-container">

<div class="attendance-info">
    <h1>Attendance</h1>
    <p>Take a selfie before logging attendance</p>

    <div class="actions">
        <button class="btn btn-secondary" onclick="startCamera()">
            <i class="fas fa-camera"></i> Open Camera
        </button>

        <button class="btn btn-secondary" onclick="capturePhoto()">
            <i class="fas fa-image"></i> Capture Selfie
        </button>
    </div>

    <div class="actions">
        <button class="btn btn-success" onclick="submitAttendance('morning_in')">
            Morning In
        </button>
        <button class="btn btn-warning" onclick="submitAttendance('morning_out')">
            Morning Out
        </button>
    </div>

    <div class="actions">
        <button class="btn btn-success" onclick="submitAttendance('afternoon_in')">
            Afternoon In
        </button>
        <button class="btn btn-warning" onclick="submitAttendance('afternoon_out')">
            Afternoon Out
        </button>
    </div>

    <div class="time-display" id="timeDisplay"></div>
</div>

<div class="camera-box">
    <video id="video" autoplay playsinline></video>
    <canvas id="canvas" hidden></canvas>
    <div class="camera-placeholder" id="placeholder">Camera Preview</div>
</div>

</div>
</div>
</div>
</div>

</body>
</html>
