<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Secure Exam</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f3f3f3;
        margin: 0;
        padding: 30px;
        text-align:center;
    }

    h1 {
        max-width: 800px;
        margin: 0 auto 25px auto;
        font-size: 18px;
        background: #fff3cd;
        padding: 15px;
        border-radius: 8px;
        border-left: 6px solid #ffcc00;
        text-align: left;
    }

    .exam-container, 
    #result-page {
        background: white;
        padding: 25px;
        border-radius: 10px;
        width: 450px;
        margin: 20px auto;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align:left;
    }

    .hidden { display: none; }

    #timer {
        font-size: 18px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .answer {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: 0.2s;
    }

    .answer:hover {
        background: #e7f0ff;
    }

    .selected {
        background: #4a90e2;
        color: white;
    }

    button {
        padding: 12px 20px;
        margin-top: 15px;
        cursor: pointer;
        background: #4a90e2;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        display:inline-block;
    }

    button:hover {
        background: #3577c8;
    }
</style>

</head>
<body>

<h1><b>Note:</b> Do not take screenshots or use any device to capture the exam content. Any form of cheating will result in consequences.</h1>

<div class="exam-container">
    <h2>Multiple Choice Exam</h2>
    <div id="timer">
    Time Left: <span id="time">{{ $exam->timer ?? 60 }}</span>s
</div>

    <div id="question-box"></div>

    <button id="next-btn" onclick="nextQuestion()" disabled>Next</button>
</div>

<!-- RESULT PAGE -->
<div id="result-page" class="hidden">
    <h2>Your Score</h2>
    <p id="score-text"></p>
    <button onclick="restartExam()">Retake Exam</button>
</div>

<script>
let exam = @json($exam);
let questions = exam.questions;
let timerValue = exam.timer;

let current = 0;
let score = 0;
let timeLeft = timerValue;
let timer;

function startExam() {
    loadQuestion();
    startTimer();
}

function loadQuestion() {
    document.getElementById("next-btn").disabled = true;

    let q = questions[current];
    let box = document.getElementById("question-box");
    box.innerHTML = `<h3>${q.question}</h3>`;

    q.options.forEach((opt, i) => {
        box.innerHTML += `
            <div class="answer" onclick="selectAnswer(this, ${i})">${opt.option_text}</div>
        `;
    });
}

function selectAnswer(element, index) {
    document.querySelectorAll(".answer").forEach(a => a.classList.remove("selected"));
    element.classList.add("selected");

    if (index + 1 === questions[current].correct_option) score++;

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

    current++;
    if (current >= questions.length) {
        finishExam();
        return;
    }

    loadQuestion();
    startTimer();
}

function finishExam() {
    document.querySelector(".exam-container").classList.add("hidden");
    document.getElementById("result-page").classList.remove("hidden");

    document.getElementById("score-text").innerText =
        `You scored ${score} out of ${questions.length}`;
}

function restartExam() {
    current = 0;
    score = 0;

    document.getElementById("result-page").classList.add("hidden");
    document.querySelector(".exam-container").classList.remove("hidden");

    startExam();
}

startExam();

/* =====================================================
   HARD SCREENSHOT / CHEAT BLOCK (WORKING + CLEANED UP)
===================================================== */

function blackoutScreen() {
    document.body.innerHTML = `
        <div style="
            width:100vw; height:100vh;
            background:black; color:white;
            display:flex; flex-direction:column;
            justify-content:center; align-items:center;
            text-align:center; padding:20px;">
            
            <div style="font-size:25px; font-weight:bold; margin-bottom:20px;">
                ⚠ SCREENSHOT ATTEMPT DETECTED — EXAM LOCKED
            </div>

            <button onclick="location.reload()" style="
                padding:12px 25px; font-size:18px;
                border:none; border-radius:8px;
                background:#1e90ff; color:white;">
                OK — Return to Exam
            </button>
        </div>
    `;
}

// Right click
document.addEventListener("contextmenu", e => { e.preventDefault(); blackoutScreen(); });

// Print Screen
document.addEventListener("keyup", e => {
    if (e.key === "PrintScreen") {
        navigator.clipboard.writeText("");
        blackoutScreen();
    }
});

// Copy
document.addEventListener("copy", e => { e.preventDefault(); blackoutScreen(); });

// Devtools
document.addEventListener("keydown", e => {
    if (["F12"].includes(e.key) ||
       (e.ctrlKey && e.shiftKey && ["I","C"].includes(e.key)) ||
       (e.ctrlKey && e.key === "U")) {
        e.preventDefault();
        blackoutScreen();
    }
});

// Tab switch
document.addEventListener("visibilitychange", () => {
    if (document.hidden) blackoutScreen();
});

// Blur (focus lost)
window.addEventListener("blur", () => blackoutScreen());
</script>

</body>
</html>
