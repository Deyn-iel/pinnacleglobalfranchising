<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Exam</title>

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
    background: linear-gradient(180deg, #f9fafb 0%, #eef2f7 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 28px;
    color: #1f2937;
}

/* ================= CONTAINER ================= */
.select-container {
    width: 100%;
    max-width: 980px;
    background: #ffffff;
    border-radius: 22px;
    padding: 44px 48px;
    box-shadow:
        0 30px 60px rgba(15, 23, 42, 0.08),
        inset 0 1px 0 rgba(255,255,255,0.7);
}

/* ================= HEADER ================= */
.select-container h2 {
    text-align: center;
    font-size: 30px;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: 0.4px;
}

.select-container .subtitle {
    text-align: center;
    margin-top: 8px;
    margin-bottom: 42px;
    font-size: 15px;
    color: #6b7280;
}

/* ================= GRID ================= */
.exam-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 320px));
    justify-content: center;
    gap: 28px;
}

/* ================= CARD ================= */
.exam-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 28px;
    text-align: center;
    border: 1px solid #e5e7eb;
    position: relative;
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        border-color 0.25s ease;
}

/* TOP ACCENT */
.exam-card::before {
    content: "";
    position: absolute;
    inset: 0;
    height: 5px;
    background: linear-gradient(90deg, #2563eb, #38bdf8);
    border-radius: 18px 18px 0 0;
    opacity: 0.9;
}

/* HOVER */
.exam-card:hover {
    transform: translateY(-6px);
    border-color: #c7d2fe;
    box-shadow: 0 22px 50px rgba(37, 99, 235, 0.18);
}

/* ================= CARD CONTENT ================= */
.exam-card h3 {
    margin-top: 8px;
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
}

.exam-card p {
    margin-top: 10px;
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 26px;
}

/* ================= BUTTON ================= */
.exam-card a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 12px 26px;
    border-radius: 999px;
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        background 0.2s ease;

    box-shadow: 0 10px 26px rgba(37,99,235,0.35);
}

.exam-card a:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 34px rgba(37,99,235,0.5);
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
}

/* ================= MOBILE ================= */
@media (max-width: 640px) {
    .select-container {
        padding: 30px 22px;
        border-radius: 18px;
    }

    .select-container h2 {
        font-size: 24px;
    }

    .select-container .subtitle {
        font-size: 14px;
        margin-bottom: 30px;
    }

    .exam-card {
        padding: 24px;
    }
}
.select-container {
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>



</head>

<body>

<div class="select-container">

    @if($exams->isEmpty())
        <!-- NO EXAM STATE -->
        <h2>No Exam Available</h2>
        <p class="subtitle">
            There is currently no exam uploaded.<br>
            You will be redirected to your dashboard shortly.
        </p>

        <p style="text-align:center;color:#9ca3af;font-size:14px;">
            Redirecting…
        </p>

        <script>
            setTimeout(() => {
                window.location.href = "{{ route('dashboard') }}";
            }, 2500);
        </script>

    @else
        <!-- NORMAL STATE -->
        <h2>Select an Exam</h2>
        <p class="subtitle">
            Choose an exam to begin your assessment
        </p>

        <div class="exam-grid">
            @foreach($exams as $exam)
                <div class="exam-card">
                    <h3>{{ $exam->title }}</h3>
                    <p>{{ $exam->questions_count }} questions</p>

                    <a href="{{ route('exam.start', $exam->id) }}">
                        Start Exam
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>

</body>

</html>
