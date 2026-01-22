<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>403 | Access Denied</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<style>
/* ================= BASE ================= */
body {
    margin: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #063e69;
    font-family: 'Segoe UI', system-ui, sans-serif;
    color: #ffffff;
    
}

/* ================= PAGE WRAPPER ================= */
.page {
    max-width: 1100px;
    width: 100%;
    padding: 40px;
    overflow: hidden;
}

/* ================= CARD ================= */
.card-403 {
    background: transparent;
    border-radius: 24px;
}

/* ================= TEXT ================= */
.text-area h1 {
    font-size: clamp(32px, 6vw, 44px);
    font-weight: 800;
    margin-bottom: 10px;
}

.text-area h2 {
    font-size: clamp(22px, 4.5vw, 28px);
    font-weight: 600;
    margin-bottom: 18px;
}

.text-area p {
    max-width: 420px;
    color: rgba(255,255,255,0.9);
    font-size: clamp(14px, 3.5vw, 16px);
    line-height: 1.6;
    margin-bottom: 28px;
}

/* ================= BUTTON (NO HOVER AT ALL) ================= */
.btn-back {
    background: #ffffff;
    color: #1e3a8a;
    font-weight: 700;
    border-radius: 14px;
    padding: 12px 22px;
    border: none;

    /* 🔥 REMOVE ALL INTERACTION EFFECTS */
    transition: none !important;
}

.btn-back:hover,
.btn-back:focus,
.btn-back:active {
    background: #ffffff !important;
    color: #1e3a8a !important;
    box-shadow: none !important;
    transform: none !important;
    outline: none !important;
}

/* ================= ILLUSTRATION ================= */
.illustration {
    position: relative;
    text-align: center;
}

.browser {
    width: min(220px, 80vw);
    aspect-ratio: 22 / 14;
    background: #ffffff;
    border-radius: 16px;
    margin: 0 auto;
    position: relative;
    box-shadow: 0 20px 40px rgba(0,0,0,.25);
}

.browser::before {
    content: '';
    position: absolute;
    top: 10px;
    left: 14px;
    width: 10px;
    height: 10px;
    background: #ef4444;
    border-radius: 50%;
    box-shadow:
        16px 0 0 #facc15,
        32px 0 0 #22c55e;
}

.code {
    font-size: clamp(46px, 8vw, 50px);
    font-weight: 900;
    color: #ef4444;
    margin-top: 38px;
}

.person {
    margin-top: 20px;
    font-size: clamp(42px, 10vw, 60px);
    opacity: 0.9;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .page {
        padding: 24px;
        text-align: center;
    }

    .row {
        flex-direction: column-reverse;
    }

    .text-area p {
        margin-left: auto;
        margin-right: auto;
    }

    .btn-back {
        width: 100%;
        max-width: 320px;
    }

    .illustration {
        margin-bottom: 20px;
    }
}

@media (max-width: 768px) {
    .page {
        padding: 20px 16px;
    }
}
</style>

</head>

<body>

<div class="page">
    <div class="row align-items-center g-5 card-403">

        <!-- LEFT TEXT -->
        <div class="col-lg-6 text-area">
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

        <!-- RIGHT ILLUSTRATION -->
        <div class="col-lg-6 illustration">
            <div class="browser">
                <div class="code">403</div>
            </div>

            <div class="person">
                <i class="fas fa-user-lock"></i>
            </div>
        </div>

    </div>
</div>

</body>
</html>
