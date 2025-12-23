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
    background:
        radial-gradient(circle at top, #eaf1ff, #f8fafc);
    min-height: 100vh;
    padding: 20px;
}

/* ================= WARNING ================= */
.warning {
    max-width: 900px;
    margin: 0 auto 30px;
    background: linear-gradient(135deg, #fff7ed, #fffbeb);
    color: #92400e;
    padding: 18px 22px;
    border-radius: 16px;
    border-left: 6px solid #f59e0b;
    font-size: 15px;
    line-height: 1.6;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

/* ================= EXAM CARD ================= */
.exam-container,
#result-page {
    max-width: 560px;
    margin: auto;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(8px);
    padding: 32px;
    border-radius: 22px;
    box-shadow:
        0 25px 60px rgba(15,23,42,0.12),
        inset 0 1px 0 rgba(255,255,255,0.6);
}

/* ================= HEADER ================= */
.exam-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.exam-header h2 {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
}

/* ================= PROGRESS ================= */
.progress {
    height: 6px;
    background: #e5e7eb;
    border-radius: 999px;
    overflow: hidden;
    margin-bottom: 20px;
}

.progress span {
    display: block;
    height: 100%;
    width: 0%;
    background: linear-gradient(90deg, #2563eb, #38bdf8);
    transition: width 0.4s ease;
}

/* ================= TIMER ================= */
#timer {
    background: linear-gradient(135deg, #0d3553, #1e40af);
    color: #ffffff;
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 700;
    box-shadow: 0 8px 18px rgba(37,99,235,0.35);
}

/* ================= QUESTION ================= */
#question-box h3 {
    font-size: 17px;
    margin-bottom: 22px;
    color: #1f2937;
    line-height: 1.6;
}

/* ================= ANSWERS ================= */
.answer {
    padding: 15px 18px;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    margin-bottom: 14px;
    cursor: pointer;
    font-size: 15px;
    background: #ffffff;
    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        background 0.2s ease,
        border-color 0.2s ease;
}

.answer:hover {
    background: #f1f5ff;
    border-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(37,99,235,0.15);
}

.answer.selected {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #ffffff;
    border-color: transparent;
    box-shadow: 0 12px 28px rgba(37,99,235,0.45);
}

/* ================= BUTTON ================= */
button {
    width: 100%;
    padding: 15px;
    margin-top: 20px;
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #ffffff;
    border: none;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 800;
    cursor: pointer;
    letter-spacing: 0.3px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(37,99,235,0.45);
}

button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* ================= RESULT ================= */
#result-page h2 {
    text-align: center;
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 12px;
    color: #0f172a;
}

#score-text {
    text-align: center;
    font-size: 17px;
    margin-bottom: 24px;
    color: #334155;
}

/* ================= UTIL ================= */
.hidden {
    display: none;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 480px) {
    .exam-container,
    #result-page {
        padding: 24px;
    }

    .exam-header h2 {
        font-size: 18px;
    }

    #question-box h3 {
        font-size: 16px;
    }
}
</style>
</head>

<body>
<form id="submitForm" method="POST" action="{{ route('exam.submit') }}">
    @csrf
    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
    <input type="hidden" name="answers" id="answersInput">
    <input type="hidden" name="cheated" id="cheatedInput" value="0">
</form>


<div class="warning">
    <strong>Important:</strong> Do not take screenshots, record the screen, or switch tabs during the exam.
    Any form of cheating will automatically submit your exam.
</div>

<div class="exam-container">
    <div class="exam-header">
        <div class="progress"><span id="progressBar"></span></div>
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
    // update progress bar
document.getElementById("progressBar").style.width =
    ((current + 1) / questions.length) * 100 + "%";

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

/* ===============================
   ANTI-CHEAT PROTECTION
================================ */

// disable right click
document.addEventListener("contextmenu", e => {
    e.preventDefault();
    triggerCheat("Right-click detected");
});

// block common inspect shortcuts
document.addEventListener("keydown", e => {
    if (
        e.key === "F12" ||
        (e.ctrlKey && e.shiftKey && ["I", "C", "J"].includes(e.key)) ||
        (e.ctrlKey && e.key === "U") ||
        (e.ctrlKey && e.key === "S")
    ) {
        e.preventDefault();
        triggerCheat("Inspect shortcut detected");
    }
});

// detect tab change / minimize
document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
        triggerCheat("Tab switched or minimized");
    }
});

// detect screen capture / print screen (best-effort)
document.addEventListener("keyup", e => {
    if (e.key === "PrintScreen") {
        triggerCheat("Screenshot attempt detected");
    }
});

// detect devtools (size trick)
let devtoolsOpen = false;
setInterval(() => {
    if (
        window.outerWidth - window.innerWidth > 160 ||
        window.outerHeight - window.innerHeight > 160
    ) {
        if (!devtoolsOpen) {
            devtoolsOpen = true;
            triggerCheat("DevTools opened");
        }
    }
}, 1000);

/* ===============================
   CHEAT HANDLER
================================ */
function triggerCheat(reason) {
    if (window.__cheatTriggered) return;
    window.__cheatTriggered = true;

    console.warn("CHEATING:", reason);

    // stop timer
    if (typeof timer !== "undefined") clearInterval(timer);

    // mark cheated
    document.getElementById("cheatedInput").value = "1";

    // save answers
    document.getElementById("answersInput").value =
        JSON.stringify(userAnswers);

    // hide exam UI safely (DO NOT REMOVE FORM)
    document.querySelector(".exam-container").style.display = "none";
    document.querySelector(".warning").style.display = "none";

    // show termination overlay
    const overlay = document.createElement("div");
    overlay.style.cssText = `
        position:fixed;
        inset:0;
        background:#000;
        color:#fff;
        display:flex;
        justify-content:center;
        align-items:center;
        text-align:center;
        padding:20px;
        z-index:99999;
    `;

    overlay.innerHTML = `
        <div>
            <h2>⚠ EXAM TERMINATED</h2>
            <p style="margin-top:10px;font-size:16px;">
                Cheating detected:<br><strong>${reason}</strong>
            </p>
            <p style="opacity:.7;margin-top:15px;">
                Submitting your exam…
            </p>
        </div>
    `;

    document.body.appendChild(overlay);

    // ✅ SUBMIT (FORM STILL EXISTS)
    setTimeout(() => {
        document.getElementById("submitForm").submit();
    }, 3000);
}


</script>


</body>
</html>
