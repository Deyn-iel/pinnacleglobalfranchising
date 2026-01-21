<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Access Denied</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    body {
        min-height: 100vh;
        background: radial-gradient(circle at top, #fee2e2, #f8fafc 60%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow: hidden;
    }

    .limit-card {
        max-width: 480px;
        width: 100%;
        background: #ffffff;
        border-radius: 22px;
        padding: 38px 32px;
        text-align: center;
        box-shadow: 0 30px 70px rgba(0,0,0,0.18);
        border-top  : 6px solid #dc2626;
        animation: shake 0.4s ease-in-out;
    }

    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-4px); }
        50% { transform: translateX(4px); }
        75% { transform: translateX(-4px); }
        100% { transform: translateX(0); }
    }

    .icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 22px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        font-weight: 800;
        box-shadow: 0 12px 30px rgba(220,38,38,0.45);
    }

    /* ================= TITLE ================= */
h2 {
    font-size: 26px;
    font-weight: 800;
    color: #7f1d1d;
    letter-spacing: 0.4px;
    margin-bottom: 14px;
}

/* ================= TEXT ================= */
p {
    font-size: 15px;
    color: #374151;
    line-height: 1.7;
    margin-bottom: 22px;
}

/* ================= INFO BOX ================= */
.info-box {
    background: #fff1f2;
    border: 1px solid #fecaca;
    border-radius: 14px;
    padding: 18px;
    font-size: 14px;
    color: #7f1d1d;
    margin-bottom: 26px;
}

    .countdown {
        font-size: 14px;
        font-weight: 700;
        color: #991b1b;
        margin-bottom: 25px;
    }

    .btn {
        display: inline-block;
        width: 100%;
        padding: 15px;
        border-radius: 14px;
        background: #0f172a;
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn:hover {
        background: #020617;
    }

    @media (max-width: 480px) {
        .limit-card {
            padding: 30px 22px;
        }

        h2 {
            font-size: 23px;
        }
    }
</style>
</head>

<body>

<div class="limit-card">
    <div class="icon">⛔</div>

    <h2>ACCESS RESTRICTED</h2>

    <p>
        You are no longer allowed to take or start any additional exams.
        This session has been permanently restricted.
    </p>

    <div class="info-box">
        <strong>Exam Locked</strong>
        The maximum number of allowed exam attempts has been reached.
        Any further action is strictly prohibited.
    </div>

    <a href="{{ route('dashboard') }}" class="btn">
        Return to Dashboard
    </a>
</div>

<script>
/* ================= CLEAR HISTORY ================= */
// remove previous page so back button does nothing
window.history.replaceState(null, "", window.location.href);

/* ================= OPTIONAL HARDENING ================= */
// disable right click
document.addEventListener("contextmenu", e => e.preventDefault());

// block basic devtools shortcuts
document.addEventListener("keydown", e => {
    if (
        e.key === "F12" ||
        (e.ctrlKey && e.shiftKey && ["I","C","J"].includes(e.key)) ||
        (e.ctrlKey && e.key.toUpperCase() === "U")
    ) {
        e.preventDefault();
    }
});
</script>




</body>
</html>
