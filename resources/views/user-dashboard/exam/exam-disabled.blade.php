<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>403</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

   @vite(['resources/css/user-exam-disabled/app.css'
            ])
</head>

<body>

<div class="wrapper">
    <div class="layout">

        <!-- TEXT -->
        <div class="text-area">
            <h1>Oops..</h1>
            <h2>Access Denied!</h2>

            <p>
                The exam you are trying to access is currently
                <strong>disabled by the administrator</strong>.
                Please wait until it becomes available.
            </p>

            <a href="{{ route('dashboard') }}" class="btn btn-back">
                <i class="fas fa-arrow-left me-2"></i>
                Go Back
            </a>
        </div>

        <!-- SVG -->
        <div class="illustration">
            <img src="{{ asset('img/403 Error Forbidden-amico.svg') }}" alt="403 Forbidden">
        </div>

    </div>
</div>

</body>
</html>
