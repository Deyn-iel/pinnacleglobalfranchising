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
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
}

/* ================= BODY ================= */
body {
    min-height: 100vh;
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 28px;
    color: #1f2937;
}

/* ================= CONTAINER ================= */
.select-container {
    width: 100%;
    max-width: 1050px;
    background: #ffffff;
    border-radius: 26px;
    padding: 48px 54px;
    box-shadow: 0 40px 90px rgba(15,23,42,0.12);
    animation: fadeUp 0.45s ease;
}

/* ================= HEADER ================= */
.select-container h2 {
    text-align: center;
    font-size: 34px;
    font-weight: 900;
    color: #0f172a;
}

.subtitle {
    text-align: center;
    margin-top: 8px;
    margin-bottom: 18px;
    font-size: 15px;
    color: #64748b;
}

/* ================= NOTICE ================= */
.notice {
    background: linear-gradient(135deg, #fff7ed, #fffbeb);
    border-left: 5px solid #f59e0b;
    padding: 14px 18px;
    border-radius: 12px;
    font-size: 14px;
    color: #92400e;
    margin-bottom: 42px;
    display: flex;
    gap: 10px;
    align-items: center;
}

/* ================= GRID ================= */
.exam-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 320px));
    justify-content: center;
    gap: 30px;
}

/* ================= CARD ================= */
.exam-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 30px;
    text-align: center;
    border: 1px solid #e5e7eb;
    position: relative;
    transition: all 0.28s ease;
}

/* TOP BAR */
.exam-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 5px;
    width: 100%;
    border-radius: 22px 22px 0 0;
}

/* ICON */
.exam-card .icon {
    width: 58px;
    height: 58px;
    margin: 16px auto 10px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #1e40af);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
    box-shadow: 0 14px 35px rgba(99,102,241,0.35);
}

.exam-card h3 {
    margin-top: 16px;
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
}

.exam-card p {
    margin-top: 8px;
    font-size: 14px;
    color: #64748b;
    margin-bottom: 26px;
}

/* ================= BUTTON ================= */
.exam-card a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 30px;
    border-radius: 999px;
    background: linear-gradient(135deg, #6366f1, #1e40af);
    color: #ffffff;
    font-weight: 800;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.25s ease;
}

.exam-card a:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(99,102,241,0.45);
    background: linear-gradient(135deg, #4f46e5, #1e3a8a);
}

/* ================= HOVER ================= */
.exam-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 35px 80px rgba(99,102,241,0.25);
}

/* ================= EMPTY ================= */
.empty {
    text-align: center;
    padding: 40px 0;
}

.empty h2 {
    font-size: 26px;
}

.empty p {
    margin-top: 12px;
    font-size: 15px;
    color: #6b7280;
}

/* ================= MOBILE ================= */
@media (max-width: 640px) {
    .select-container {
        padding: 32px 22px;
        border-radius: 20px;
    }

    .select-container h2 {
        font-size: 26px;
    }
}

/* ================= ANIMATION ================= */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<div class="select-container">

    <h2>Select an Exam</h2>
    <p class="subtitle">Choose an exam to begin your assessment</p>

    @if($exams->isEmpty())
        <div class="empty">
            <h2>No Exam Available</h2>
            <p>Please check again later.</p>
        </div>
    @else
        <div class="exam-grid">
            @foreach($exams as $exam)
                <div class="exam-card">
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>{{ $exam->title }}</h3>
                    <p>{{ $exam->questions_count }} questions</p>

                    <a href="{{ route('exam.start', $exam->id) }}">
                        Start Exam <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>

<script>
history.pushState(null, "", location.href);
window.addEventListener("popstate", function () {
    location.replace(location.href);
});
</script>




</body>
</html>
