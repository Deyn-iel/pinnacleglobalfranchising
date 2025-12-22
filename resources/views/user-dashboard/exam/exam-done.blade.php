<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Access Denied</title>

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
    }

    .limit-card {
        max-width: 480px;
        width: 100%;
        background: #ffffff;
        border-radius: 22px;
        padding: 38px 32px;
        text-align: center;
        box-shadow: 0 30px 70px rgba(0,0,0,0.18);
        border-top: 6px solid #dc2626;
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

    h2 {
        font-size: 26px;
        font-weight: 800;
        color: #7f1d1d;
        margin-bottom: 12px;
        letter-spacing: 0.3px;
    }

    p {
        font-size: 15px;
        color: #374151;
        line-height: 1.7;
        margin-bottom: 18px;
    }

    .info-box {
        background: #fff1f2;
        padding: 16px;
        border-radius: 14px;
        font-size: 14px;
        color: #7f1d1d;
        margin-bottom: 20px;
        border: 1px solid #fecaca;
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

    <h2>ACCESS DENIED</h2>

    <p>
        You are no longer allowed to take or start any additional exams.
        This session has been permanently restricted.
    </p>

    <div class="info-box">
        <strong>Exam Locked</strong>
        The maximum number of allowed exam attempts has been reached.
        Any further action is strictly prohibited.
    </div>

    <div class="countdown">
        Redirecting to dashboard in <span id="time">5</span> seconds…
    </div>

    <a href="{{ route('dashboard') }}" class="btn">
        Return to Dashboard Now
    </a>
</div>

<script>
/* ================= AUTO REDIRECT ================= */
let seconds = 5;
const timeEl = document.getElementById("time");

const countdown = setInterval(() => {
    seconds--;
    timeEl.textContent = seconds;

    if (seconds <= 0) {
        clearInterval(countdown);
        window.location.replace("{{ route('dashboard') }}");
    }
}, 1000);

/* ================= BLOCK BACK BUTTON ================= */
history.pushState(null, "", location.href);
window.onpopstate = function () {
    history.pushState(null, "", location.href);
};

/* ================= HARD BLOCK INTERACTIONS ================= */
document.addEventListener("contextmenu", e => e.preventDefault());
document.addEventListener("keydown", e => {
    if (
        e.key === "F12" ||
        (e.ctrlKey && e.shiftKey && ["I","C","J"].includes(e.key)) ||
        (e.ctrlKey && e.key === "U")
    ) {
        e.preventDefault();
    }
});
</script>

</body>
</html>
