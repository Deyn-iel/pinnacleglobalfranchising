<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Exam</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite([
    'resources/css/user-dashboard-select/app.css'
])
</head>

<body>

<div class="wrapper">

    <div class="header">
        <h1>
            <img src="{{ asset('img/logo1-removebg-preview.png') }}" alt="Logo">
            Select Exam
        </h1>
        <p>Choose one exam to continue</p>
    </div>

    @if($exams->isEmpty())
        <div class="empty">
            <i class="fas fa-folder-open"></i>
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
                            <i class="fa-solid fa-file-circle-check"></i>

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
function selectExam(card) {document.querySelectorAll('.exam-card').forEach(c => {c.classList.remove('selected');});card.classList.add('selected');selectedUrl = card.dataset.url;document.getElementById('proceedBtn').disabled = false;}document.getElementById('proceedBtn')?.addEventListener('click', () => {if (selectedUrl) {window.location.href = selectedUrl;}});
</script>

</body>
</html>
