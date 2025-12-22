<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Secure Exam</title>

<style>
/* ================= RESET ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

body {
    background: linear-gradient(135deg, #eef2f7, #f8fafc);
    min-height: 100vh;
    padding: 20px;
}

/* ================= WARNING ================= */
.warning {
    max-width: 900px;
    margin: 0 auto 25px;
    background: #fff7ed;
    color: #92400e;
    padding: 18px 20px;
    border-radius: 14px;
    border-left: 6px solid #f59e0b;
    font-size: 15px;
    line-height: 1.6;
}

/* ================= EXAM CARD ================= */
.exam-container,
#result-page {
    max-width: 520px;
    margin: auto;
    background: #ffffff;
    padding: 28px;
    border-radius: 18px;
    box-shadow: 0 20px 45px rgba(0,0,0,0.1);
}

/* ================= HEADER ================= */
.exam-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.exam-header h2 {
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
}

/* ================= TIMER ================= */
#timer {
    background: #0d3553;
    color: #ffffff;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
}

/* ================= QUESTION ================= */
#question-box h3 {
    font-size: 17px;
    margin-bottom: 18px;
    color: #1f2937;
}

/* ================= ANSWERS ================= */
.answer {
    padding: 14px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.25s ease;
    font-size: 15px;
}

.answer:hover {
    background: #f1f5ff;
    border-color: #2563eb;
}

.answer.selected {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
}

/* ================= BUTTON ================= */
button {
    width: 100%;
    padding: 14px;
    margin-top: 18px;
    background: #2563eb;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
}

button:hover {
    background: #1e40af;
}

button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ================= RESULT ================= */
#result-page h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 10px;
}

#score-text {
    text-align: center;
    font-size: 16px;
    margin-bottom: 20px;
}

/* ================= UTIL ================= */
.hidden {
    display: none;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 480px) {
    .exam-container,
    #result-page {
        padding: 22px;
    }

    .warning {
        font-size: 14px;
    }

    .exam-header h2 {
        font-size: 18px;
    }
}
</style>
</head>

<body>
<form id="submitForm" method="POST" action="{{ route('exam.submit') }}">
    @csrf
    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
    <input type="hidden" name="answers" id="answersInput">
</form>

<div class="warning">
    <strong>Important:</strong> Do not take screenshots, record the screen, or switch tabs during the exam.
    Any form of cheating will automatically submit your exam.
</div>

<div class="exam-container">
    <div class="exam-header">
        <h2>Multiple Choice Exam</h2>
        <div id="timer">⏱ <span id="time">{{ $exam->timer ?? 60 }}</span>s</div>
    </div>

    <div id="question-box"></div>

    <button id="next-btn" onclick="nextQuestion()" disabled>Next Question</button>
</div>

<!-- RESULT PAGE -->
<div id="result-page" class="hidden">
    <h2>Exam Completed</h2>
    <p id="score-text"></p>
    <button id="dashboardBtn" disabled>
    Submitting result...
</button>



</div>

<script>
let userAnswers = {};
let exam = @json($exam);
let questions = exam.questions;
let timerValue = exam.timer;

let current = 0;
let timeLeft = timerValue;
let timer;

function startExam() {
    loadQuestion();
    startTimer();
}

function loadQuestion() {
    const nextBtn = document.getElementById("next-btn");
    nextBtn.disabled = true;

    let q = questions[current];
    let box = document.getElementById("question-box");
    box.innerHTML = `<h3>${q.question}</h3>`;

    q.options.forEach((opt, i) => {
        box.innerHTML += `
            <div class="answer" onclick="selectAnswer(this, ${i})">
                ${opt.option_text}
            </div>
        `;
    });

    // change button text on last question
    nextBtn.textContent =
        current === questions.length - 1
            ? "Submit Exam"
            : "Next Question";
}

function selectAnswer(el, index) {
    document.querySelectorAll(".answer").forEach(a =>
        a.classList.remove("selected")
    );
    el.classList.add("selected");

    // store answer
    userAnswers[current] = index + 1;

    document.getElementById("next-btn").disabled = false;
}

function startTimer() {
    timeLeft = timerValue;
    document.getElementById("time").innerText = timeLeft;

    timer = setInterval(() => {
        timeLeft--;
        document.getElementById("time").innerText = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(timer);
            nextQuestion();
        }
    }, 1000);
}

function nextQuestion() {
    clearInterval(timer);

    if (current === questions.length - 1) {
        finishExam();
        return;
    }

    current++;
    loadQuestion();
    startTimer();
}

/* ✅ FINAL & ONLY finishExam() */
function finishExam() {
    document.querySelector(".exam-container").classList.add("hidden");
    document.getElementById("result-page").classList.remove("hidden");

    const displayScore = Object.values(userAnswers).filter(
        (ans, i) => ans === questions[i].correct_option
    ).length;

    document.getElementById("score-text").innerText =
        `You scored ${displayScore} out of ${questions.length}`;

    document.getElementById("answersInput").value =
        JSON.stringify(userAnswers);

    const btn = document.getElementById("dashboardBtn");

    setTimeout(() => {
        btn.disabled = false;
        btn.textContent = "Return to Dashboard";
        btn.onclick = () => window.location.href = "{{ route('dashboard') }}";

        document.getElementById("submitForm").submit();
    }, 3000);
}


startExam();
</script>


</body>
</html>
