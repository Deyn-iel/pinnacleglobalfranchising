<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Tutorial</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/user-dashboard/app.css', 'resources/css/video/app.css', 'resources/js/user-dashboard/app.js'])


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

            <div class="content tutorial-wrapper">
                <div class="tutorial-page">

                    <div class="bg-shape one"></div>
                    <div class="bg-shape two"></div>

                    <header class="page-header">
                        <h1>Video Tutorial</h1>
                        <p>
                            Please watch the tutorial video carefully. If you are already familiar with the instructions
                            or do not need the video, you may skip it and proceed directly to the exam.
                        </p>
                    </header>

                    <section class="video-section">
                        <div class="video-wrapper">
                            <video id="tutorialVideo" controls controlsList="nodownload">
                                <source src="{{ asset('img/copy_EEE3EA5B-4EDB-4351-9714-4A2524705B38.mov') }}"
                                    type="video/mp4">
                            </video>
                        </div>
                    </section>

                    <div class="action-area">
                        <form method="GET" action="{{ route('proceed') }}">
                            <button type="submit" class="btn" id="proceedBtn">
                                Proceed
                            </button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        const video = document.getElementById("tutorialVideo");
        const proceedBtn = document.getElementById("proceedBtn");

        video.addEventListener("ended", () => {
            proceedBtn.disabled = false;
            proceedBtn.classList.add("enabled");
        });
    </script>





</body>

</html>
