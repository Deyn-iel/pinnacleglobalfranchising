<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Secure Exam</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
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
    overscroll-behavior: none;
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
/* ================= ESSAY ================= */
.essay-wrapper {
    margin-top: 10px;
    padding: 18px;
    border-radius: 16px;
    background: linear-gradient(180deg, #f8fafc, #ffffff);
    border: 1px solid #e5e7eb;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.03);
    animation: fadeUp 0.4s ease;
}

.essay-wrapper label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 700;
    color: #1e40af;
    margin-bottom: 10px;
    font-size: 14px;
}

.essay-wrapper label span {
    background: #e0e7ff;
    color: #1e3a8a;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
}

.essay-wrapper textarea {
    width: 100%;
    min-height: 140px;
    resize: vertical;
    padding: 14px 16px;
    font-size: 15px;
    border-radius: 14px;
    border: 1px solid #c7d2fe;
    outline: none;
    line-height: 1.6;
    background: #ffffff;
    transition: all 0.25s ease;
}

.essay-wrapper textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37,99,235,0.15);
}

.essay-hint {
    margin-top: 10px;
    font-size: 13px;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 6px;
}

.essay-hint strong {
    color: #0f172a;
}

/* WORD COUNT */
.word-count {
    margin-top: 8px;
    font-size: 12px;
    color: #64748b;
    text-align: right;
}

</style>
</head>

<body>
<form id="submitForm" method="POST" action="{{ route('exam.submit') }}">
    @csrf
    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
    <input type="hidden" name="answers" id="answersInput">
    <input type="hidden" name="cheated" id="cheatedInput" value="0">

    {{-- <input type="hidden" id="serverTimeLeft" value="{{ $remainingTime ?? $exam->timer }}"> --}}

</form>


<div class="warning">
    <strong>Godbless</strong> you.
</div>

<div class="exam-container">
    <div class="exam-header">
        <div class="progress"><span id="progressBar"></span></div>
        <h2>{{ $exam->title }}</h2>
        <div id="timer">
            ⏱ <span id="time">{{ $remainingTime ?? $exam->timer }}</span>s
            </div>

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
/* ===============================
   STATE
================================ */
let userAnswers = {};
let exam = @json($exam);
let questions = exam.questions;

let current = 0;
const TIME_PER_QUESTION = {{ $exam->timer }};
let timeLeft = TIME_PER_QUESTION;

let timer;

/* ===============================
   DEVICE DETECTION
================================ */
const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

/* ===============================
   GLOBAL FLAGS
================================ */
let examStarted = false;
let cheatTriggered = false;
let userInteracted = false;

/* ===============================
   MARK REAL USER INTERACTION
================================ */
["click", "touchstart", "keydown"].forEach(evt => {
    document.addEventListener(evt, () => {
        userInteracted = true;
    }, { once: true });
});

/* ===============================
   START EXAM
================================ */
startExam();
enableCheatSystem();

function startExam() {
    if (!questions || questions.length === 0) {
        document.getElementById("question-box").innerHTML =
            "<p>No questions available.</p>";
        return;
    }

    loadQuestion();
    startTimer();
}

/* ===============================
   ENABLE CHEAT SYSTEM (DELAYED)
   prevents mobile false trigger
================================ */
function enableCheatSystem() {
    setTimeout(() => {
        examStarted = true;
        lockBackNavigation(); // 🔒 lock after exam really starts
    }, 2000);
}

/* ===============================
   HARD BACK-BLOCK (ANDROID + IOS)
================================ */

// Seed history stack (important for iOS)
function lockBackNavigation() {
    history.pushState({ exam: true }, "", location.href);
    history.pushState({ exam: true }, "", location.href);
}

// Detect hardware / browser back
window.addEventListener("popstate", () => {
    if (!examStarted || cheatTriggered) return;

    lockBackNavigation(); // re-lock
    triggerCheat("Back navigation detected");
});


/* ===============================
   iOS SWIPE-BACK DETECTION
================================ */

let touchStartX = 0;

window.addEventListener(
    "touchstart",
    (e) => {
        if (!examStarted || cheatTriggered) return;
        touchStartX = e.touches[0].clientX;
    },
    { passive: true }
);

window.addEventListener(
    "touchmove",
    (e) => {
        if (!examStarted || cheatTriggered) return;

        const moveX = e.touches[0].clientX;

        // iOS edge swipe (real back gesture)
        if (touchStartX < 20 && moveX > 60) {
            e.preventDefault();
            triggerCheat("Swipe back gesture detected");
        }
    },
    { passive: false }
);



/* ===============================
   QUESTION RENDER
================================ */
function loadQuestion() {
    timeLeft = TIME_PER_QUESTION;
    document.getElementById("time").innerText = timeLeft;

    document.getElementById("progressBar").style.width =
        ((current + 1) / questions.length) * 100 + "%";

    const q = questions[current];
    const box = document.getElementById("question-box");
    const nextBtn = document.getElementById("next-btn");

    nextBtn.disabled = true;
    box.innerHTML = `<h3>${q.question}</h3>`;

    const options = q.options ? Object.values(q.options) : [];

    // MCQ
    if (options.length > 0) {
        options.forEach(opt => {
            box.innerHTML += `
                <div class="answer"
                     onclick="selectAnswer(this, ${opt.id})">
                    ${opt.option_text}
                </div>
            `;
        });
    }
    // TRUE / FALSE
    else if (q.type === 'true_false') {
        box.innerHTML += `
            <div class="answer" onclick="selectAnswer(this, 1)">True</div>
            <div class="answer" onclick="selectAnswer(this, 0)">False</div>
        `;
    }
    // ESSAY
    else {
        const saved = userAnswers[q.id] ?? '';
        box.innerHTML += `
            <div class="essay-wrapper">
                <label>
                    Essay Answer <span>Manual Checking</span>
                </label>
                <textarea oninput="handleEssayInput(this)">${saved}</textarea>
                <div class="word-count" id="wordCount">0 words</div>
            </div>
        `;
        nextBtn.disabled = saved.trim() === '';
    }

    restoreSelection(q.id);

    nextBtn.textContent =
        current === questions.length - 1 ? "Submit Exam" : "Next Question";
}

/* ===============================
   ANSWERS
================================ */
function selectAnswer(el, value) {
    document.querySelectorAll(".answer")
        .forEach(a => a.classList.remove("selected"));

    el.classList.add("selected");
    userAnswers[questions[current].id] = value;

    document.getElementById("next-btn").disabled = false;
}

function handleEssayInput(el) {
    const value = el.value;
    userAnswers[questions[current].id] = value;

    const words = value.trim()
        ? value.trim().split(/\s+/).length
        : 0;

    const wc = document.getElementById("wordCount");
    if (wc) wc.innerText = `${words} word${words !== 1 ? "s" : ""}`;

    document.getElementById("next-btn").disabled = value.trim() === "";
}


function restoreSelection(questionId) {
    const saved = userAnswers[questionId];
    if (saved === undefined) return;

    document.querySelectorAll(".answer").forEach(el => {
        const fn = el.getAttribute("onclick");
        if (!fn) return;
        const val = fn.match(/,\s*(\d+)\)/);
        if (val && String(val[1]) === String(saved)) {
            el.classList.add("selected");
            document.getElementById("next-btn").disabled = false;
        }
    });
}

/* ===============================
   TIMER
================================ */
function startTimer() {
    clearInterval(timer);

    timer = setInterval(() => {
        timeLeft--;
        document.getElementById("time").innerText = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(timer);
            current === questions.length - 1
                ? finishExam()
                : nextQuestion(true);
        }
    }, 1000);
}

/* ===============================
   NAVIGATION
================================ */
function nextQuestion(auto = false) {
    clearInterval(timer);

    if (!auto && userAnswers[questions[current].id] == null) return;

    if (current === questions.length - 1) {
        finishExam();
        return;
    }

    current++;
    loadQuestion();
    startTimer();
}

/* ===============================
   FINISH EXAM
================================ */
function finishExam() {
    examStarted = false;
    cheatTriggered = true;

    document.querySelector(".exam-container").classList.add("hidden");
    document.getElementById("result-page").classList.remove("hidden");

    const autoGraded = questions.filter(q => q.type !== 'essay');
    const score = autoGraded.filter(q =>
        String(userAnswers[q.id]) === String(q.correct_option)
    ).length;

    document.getElementById("score-text").innerText =
        `You scored ${score} out of ${autoGraded.length}`;

    document.getElementById("answersInput").value =
        JSON.stringify(userAnswers);

    setTimeout(() => {
        document.getElementById("submitForm").submit();
    }, 3000);
}

/* ===============================
   CHEAT HANDLER (SAFE)
================================ */
function triggerCheat(reason) {
    if (cheatTriggered) return;
    cheatTriggered = true;

    clearInterval(timer);

    document.getElementById("cheatedInput").value = "1";
    document.getElementById("answersInput").value =
        JSON.stringify(userAnswers);

    document.querySelector(".exam-container").style.display = "none";
    document.querySelector(".warning").style.display = "none";

    const overlay = document.createElement("div");
    overlay.style.cssText = `
        position:fixed;
        inset:0;
        background:#0d3553;
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
            <p style="margin-top:10px">
                Cheating detected:<br><strong>${reason}</strong>
            </p>
            <p style="opacity:.7;margin-top:15px">
                Submitting exam…
            </p>
        </div>
    `;

    document.body.appendChild(overlay);

    setTimeout(() => {
        document.getElementById("submitForm").submit();
    }, 1000);
}

/* ===============================
   MOBILE-SAFE DETECTORS
================================ */
document.addEventListener("visibilitychange", () => {
    if (!examStarted || cheatTriggered) return;

    // MOBILE: trigger immediately
    if (document.hidden) {
        triggerCheat("App minimized or tab switched");
    }
});


/* ===============================
   DESKTOP-ONLY STRICT MODE
================================ */
if (!isMobile) {
    document.addEventListener("contextmenu", e => {
        e.preventDefault();
        triggerCheat("Right-click detected");
    });

    document.addEventListener("keydown", e => {
        if (
            e.key === "F12" ||
            (e.ctrlKey && e.shiftKey && ["I","C","J"].includes(e.key)) ||
            (e.ctrlKey && ["U","S"].includes(e.key.toUpperCase()))
        ) {
            e.preventDefault();
            triggerCheat("Developer tools detected");
        }
    });
}

/* ===============================
   SCREENSHOT DETECTION (DESKTOP ONLY)
   LIMITATION: works on PrintScreen key only
================================ */

if (!isMobile) {
    document.addEventListener("keyup", function (e) {
        // Windows / Linux PrintScreen
        if (e.key === "PrintScreen") {
            triggerCheat("Screenshot detected");
        }
    });
}
/* ===============================
   REFRESH / RELOAD DETECTION
   DESKTOP + MOBILE SAFE
================================ */

// ⛔ Block keyboard refresh
document.addEventListener("keydown", function (e) {
    if (!examStarted || cheatTriggered) return;

    // F5
    if (e.key === "F5") {
        e.preventDefault();
        triggerCheat("Page refresh detected (F5)");
    }

    // Ctrl + R / Cmd + R
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === "r") {
        e.preventDefault();
        triggerCheat("Page refresh detected (Ctrl/Cmd + R)");
    }

    // Ctrl + Shift + R (hard reload)
    if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key.toLowerCase() === "r") {
        e.preventDefault();
        triggerCheat("Hard refresh detected");
    }
});

// ⛔ Browser reload (toolbar / swipe refresh)
window.addEventListener("beforeunload", function (e) {
    if (!examStarted || cheatTriggered) return;

    e.preventDefault();
    e.returnValue = ""; // required for Chrome
});

// ⛔ Detect reload AFTER it already happened (fallback)
setTimeout(() => {
    const nav = performance.getEntriesByType("navigation")[0];
    if (examStarted && nav && nav.type === "reload") {
        triggerCheat("Page reload detected");
    }
}, 1500);



/* ===============================
   VIEWPORT CHANGE DETECTION
================================ */

if (isMobile) {
    let lastHeight = window.innerHeight;

    window.addEventListener("resize", () => {
        if (!examStarted || cheatTriggered) return;

        if (Math.abs(window.innerHeight - lastHeight) > 120) {
            triggerCheat("Screen overlay / notification shade detected");
        }

        lastHeight = window.innerHeight;
    });
}
</script>




</body>
</html>
