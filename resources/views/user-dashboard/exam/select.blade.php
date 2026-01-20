<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Exam</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
/* ================= RESET ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
}

/* ================= BODY ================= */
body {
    min-height: 100vh;
    background: #f4f6fb;
    padding: 40px 16px;
    color: #111827;
}

/* ================= WRAPPER ================= */
.wrapper {
    max-width: 1100px;
    margin: auto;
    background: #ffffff;
    border-radius: 18px;
    padding: 36px 40px 44px;
    box-shadow: 0 20px 60px rgba(15,23,42,0.12);
}

/* ================= HEADER ================= */
.header {
    margin-bottom: 28px;
}

.header h1 {
    font-size: 24px;
    font-weight: 800;
}

.header p {
    margin-top: 6px;
    font-size: 14px;
    color: #6b7280;
}

/* ================= GRID ================= */
.exam-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 22px;
}

/* ================= CARD ================= */
.exam-card {
    position: relative;
    background: #ffffff;
    border-radius: 16px;
    padding: 22px;
    border: 1px solid #e5e7eb;
    cursor: pointer;
    min-height: 170px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* SELECTED (simple highlight only) */
.exam-card.selected {
    border-color: #6366f1;
    background: #f5f7ff;
}

/* ================= CHECK ================= */
.check {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    border: 2px solid #d1d5db;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    background: #fff;
}

.exam-card.selected .check {
    background: #6366f1;
    border-color: #6366f1;
}

.exam-card.selected .check::after {
    content: "\f00c";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    color: #fff;
}

/* ================= CONTENT ================= */
.exam-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 16px;
}

.exam-title {
    margin-top: 14px;
    font-size: 16px;
    font-weight: 700;
}

.exam-meta {
    margin-top: 6px;
    font-size: 13px;
    color: #6b7280;
}

/* ================= FOOTER ================= */
.footer {
    margin-top: 34px;
    display: flex;
    justify-content: flex-end;
}

/* PROCEED BUTTON */
.proceed-btn {
    padding: 14px 34px;
    border-radius: 999px;
    border: none;
    background: #6366f1;
    color: #fff;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.proceed-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* ================= EMPTY ================= */
.empty {
    text-align: center;
    padding: 60px 0;
}

.empty h2 {
    font-size: 22px;
    font-weight: 700;
}

.empty p {
    margin-top: 8px;
    font-size: 14px;
    color: #6b7280;
}

/* ================= MOBILE ================= */
@media (max-width: 640px) {
    .wrapper {
        padding: 26px 20px 32px;
    }

    .footer {
        justify-content: center;
    }

    .proceed-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
</head>

<body>

<div class="wrapper">

    <div class="header">
        <h1 class="logo"
            style="
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 1.4rem;
                font-weight: 700;
                margin: 0;
            ">
            <img src="{{ asset('img/logo1-removebg-preview.png') }}"
                alt="Logo"
                style="
                    width: 40px;
                    height: auto;
                    object-fit: contain;
                ">
            Select Exam
        </h1>
        <p>Choose one exam to continue</p>
    </div>

    @if($exams->isEmpty())
        <div class="empty">
            <h2>No exams available</h2>
            <p>Please check again later.</p>
        </div>
    @else

        <div class="exam-grid">
            @foreach($exams as $exam)
                <div class="exam-card"
                     data-url="{{ route('exam.start', $exam->id) }}"
                     onclick="selectExam(this)">
                     
                    <div class="check"></div>

                    <div>
                        
                        <div class="exam-icon">
                            <i class="fas fa-file-lines"></i>
                        </div>
                        <div class="exam-title">
                            {{ $exam->title }}
                        </div>

                        <div class="exam-meta">
                            {{ $exam->questions_count }} questions
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="footer">
            <button id="proceedBtn" class="proceed-btn" disabled>
                Proceed <i class="fas fa-arrow-right"></i>
            </button>
        </div>

    @endif

</div>

<script>
let selectedUrl = null;

function selectExam(card) {
    document.querySelectorAll('.exam-card').forEach(c => {
        c.classList.remove('selected');
    });

    card.classList.add('selected');
    selectedUrl = card.dataset.url;

    document.getElementById('proceedBtn').disabled = false;
}

document.getElementById('proceedBtn')?.addEventListener('click', () => {
    if (selectedUrl) {
        window.location.href = selectedUrl;
    }
});
</script>

</body>
</html>
