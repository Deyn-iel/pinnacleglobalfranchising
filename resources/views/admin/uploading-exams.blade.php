<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create Exam</title>
<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite([
    'resources/css/admin/app.css',
])
<style>
/* ================= BASE ================= */
body {
    background: linear-gradient(180deg, #eef2ff, #f8fafc);
    font-family: 'Segoe UI', system-ui, sans-serif;
}

.sidebar-link { text-decoration: none; }

/* ================= CONTENT WRAPPER (SIDEBAR FIT) ================= */
.content-wrapper {
    margin-left: 260px; /* SIDEBAR WIDTH */
    padding: 40px 40px 60px;
    transition: margin .3s ease;
}

/* ================= MAIN CARD ================= */
.exam-container {
    width: 100%;
    background: #ffffff;
    padding: 34px;
    border-radius: 20px;
    box-shadow:
        0 30px 60px rgba(30, 64, 175, 0.08),
        0 8px 20px rgba(0,0,0,0.06);
}

/* ================= HEADINGS ================= */
.exam-container h2 {
    color: #000000;
    font-weight: 500;
    letter-spacing: -0.4px;
}

.exam-container h3 {
    margin-top: 40px;
    font-weight: 700;
    color: #000000;
    position: relative;
    padding-left: 14px;
}



/* ================= LABELS ================= */
label {
    font-weight: 500;
    margin-top: 15px;
    font-size: 14px;
}

/* ================= INPUTS ================= */
input[type="text"],
input[type="number"],
select {
    border-radius: 12px;
    padding: 12px 14px;
    border: 1px solid #dbeafe;
    transition: all .25s ease;
}

input:focus,
select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37,99,235,.12);
}

/* ================= QUESTION CARD ================= */
.question-block {
    margin-top: 22px;
    padding: 22px;
    border-radius: 18px;
    background: linear-gradient(180deg, #f0f5ff, #ffffff);
    border: 1px solid #dbeafe;
    position: relative;
    transition: transform .25s ease, box-shadow .25s ease;
}

.question-block:hover {
    box-shadow: 0 16px 35px rgba(37,99,235,0.12);
}

/* ================= DELETE BUTTON ================= */
.delete-btn {
    position: absolute;
    top: 14px;
    right: 14px;
    background: #fee2e2;
    color: #b91c1c;
    border: none;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
}

.delete-btn:hover {
    background: #fecaca;
}

/* ================= BUTTONS ================= */
.btn-add {
    background: #000000;
    color: #fff;
    font-weight: 500;
    border-radius: 12px;
    padding: 10px 18px;
}

.btn-save {
    background: #000000;
    color: #fff;
    font-weight: 500;
    border-radius: 12px;
    padding: 10px 22px;
    border: none;
}

.btn-add:hover,
.btn-save:hover {
    background-color: #3f3f3f;
    color: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* ================= SUCCESS ================= */
.success-box {
    background: #d1fae5;
    color: #065f46;
    border-left: 6px solid #10b981;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
}

/* ================= EXAM LIST ================= */
.exam-list {
    margin-top: 60px;
    padding: 26px;
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e5e7eb;
}

.exam-item {
    padding: 18px;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    margin-bottom: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    transition: background .2s ease;
}

.exam-item:hover {
    background: #f8fafc;
}

/* ================= EXAM RESULTS BUTTON ================= */
.btn-results {
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .content-wrapper {
        margin-left: 0;
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .exam-item {
        flex-direction: column;
        align-items: stretch;
    }

    .exam-item div:last-child {
        width: 100%;
        display: flex;
        gap: 10px;
    }

    .exam-item button,
    .exam-item a {
        width: 100%;
    }
}
.sidebar-link {
    border-radius: 8px;
    transition: background 0.25s ease, padding-left 0.25s ease;
}

.sidebar-link:hover {
    background: rgba(255,255,255,0.1);
}

.sidebar-link.active {
    background: rgba(255,255,255,0.18);
    border-left: 4px solid #0d6efd;
    padding-left: 14px;
}

.sidebar-link.active i {
    color: #ffffff;
}
.alert {
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.alert.fade:not(.show) {
    opacity: 0;
    transform: translateY(-10px);
}

/* ================= SAVE EXAM BUTTON STATES ================= */


/* ================= SAVE EXAM BUTTON (FINAL FIX) ================= */



/* ENABLED hover */
.btn-save:not(:disabled):hover {
    transform: translateY(-1px);
    background: #444444;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* 🔥 DISABLED — FORCE OVERRIDE BOOTSTRAP */
.btn-save:disabled,
.btn-save[disabled] {
    background: #838383 !important;
    color: #ffffff !important;
    cursor: not-allowed !important;
    box-shadow: none !important;
    transform: none !important;
    opacity: 0.85;
    pointer-events: all; /* para makita pa rin cursor change */
}


</style>
</head>

<body>

<!-- NAV -->
    @include('admin-sidebar.navbar')

@include('admin-sidebar.sidebar')

<!-- ================= MAIN CONTENT ================= -->
<div class="content-wrapper">
    <div class="exam-container">

       
        @if(session('success'))
<div id="uploadSuccessAlert"
     class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
     role="alert">
     
    <i class="fas fa-check-circle fs-5"></i>
    <strong>{{ session('success') }}</strong>
</div>
@endif

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h2>Create New Exam</h2>
                <p class="text-muted mb-0">Set the exam details and add questions below.</p>
            </div>

            <a href="{{ route('admin.exam-results') }}" class="btn btn-outline-primary btn-results">
                 Exam Results
            </a>
        </div>

        <!-- CREATE EXAM FORM -->
        <form action="{{ route('admin.exams.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <label>Exam Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Timer (seconds)</label>
                    <input type="number" name="timer" class="form-control" value="60" required>
                </div>
            </div>

            <h3>Questions</h3>
            <div id="questions-area"></div>

            <div class="d-flex gap-3 mt-3 flex-wrap">
                <button type="button" class="btn btn-add" onclick="addQuestion()">+ Add Question</button>
                <button type="submit" class="btn btn-save" id="saveExamBtn" disabled>
                    Save Exam
                </button>
            </div>
        </form>

        <!-- UPLOADED EXAMS -->
        <div class="exam-list">
            <h3>Uploaded Exams</h3>

            @forelse($exams as $exam)
                <div class="exam-item">
                    <div>
                        <strong>{{ $exam->title }}</strong><br>
                        <span class="text-muted">{{ $exam->questions->count() }} questions</span>
                    </div>

                    <div class="d-flex gap-2">

                    <!-- ENABLE / DISABLE -->
                    <form action="{{ route('admin.exams.toggle', $exam->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button
                            class="btn btn-sm fw-semibold
                            {{ $exam->is_active ? 'btn-warning' : 'btn-success' }}">
                            
                            {{ $exam->is_active ? 'Disable' : 'Enable' }}
                        </button>
                    </form>

                    <!-- EDIT -->
                    <a href="{{ route('admin.exams.edit', $exam->id) }}"
                    class="btn btn-sm btn-primary fw-semibold">
                        <i class="fas fa-pen me-1"></i> Edit
                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('admin.exams.delete', $exam->id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this exam?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger fw-semibold">
                            Delete
                        </button>
                    </form>

                </div>

                </div>
            @empty
                <p class="text-muted">No exams uploaded yet.</p>
            @endforelse
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const alertBox = document.getElementById("uploadSuccessAlert");

    if (alertBox) {
        // wait 2.5 seconds then fade out
        setTimeout(() => {
            alertBox.classList.remove("show");
            alertBox.classList.add("fade");

            // fully remove after animation
            setTimeout(() => {
                alertBox.remove();
            }, 600);
        }, 2500);
    }
});

function addQuestion() {
    const id = Date.now();

    document.getElementById("questions-area").insertAdjacentHTML("beforeend", `
        <div class="question-block" id="q${id}">
            <button type="button" class="delete-btn"
                onclick="removeQuestion('q${id}')">Delete</button>

            <label>Question</label>
            <input type="text" name="questions[${id}]"
                   class="form-control" required>

            <label class="mt-2">Question Type</label>
            <select name="type[${id}]"
                    class="form-control mb-2"
                    onchange="toggleOptions(this)">
                <option value="mcq">Multiple Choice</option>
                <option value="true_false">True / False</option>
                <option value="essay">Essay</option>
            </select>

            <!-- ================= MCQ OPTIONS ================= -->
            <div class="mcq-options">
                <input type="text" name="options[${id}][]"
                       class="form-control mb-2" placeholder="Option A">
                <input type="text" name="options[${id}][]"
                       class="form-control mb-2" placeholder="Option B">
                <input type="text" name="options[${id}][]"
                       class="form-control mb-2" placeholder="Option C">
                <input type="text" name="options[${id}][]"
                       class="form-control mb-2" placeholder="Option D">

                <label>Correct Option</label>
                <input type="number" name="correct[${id}]"
                       class="form-control" min="1" max="4">
            </div>

            <!-- ================= TRUE / FALSE OPTIONS ================= -->
            <div class="tf-options d-none">
                <label class="fw-semibold">Correct Answer</label>

                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="correct[${id}]"
                           value="1">
                    <label class="form-check-label">True</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="correct[${id}]"
                           value="0">
                    <label class="form-check-label">False</label>
                </div>
            </div>
        </div>
    `);
}


function toggleOptions(select) {
    const block = select.closest('.question-block');

    const mcq = block.querySelector('.mcq-options');
    const tf  = block.querySelector('.tf-options');

    if (select.value === 'mcq') {
        mcq.style.display = 'block';
        tf.classList.add('d-none');
    }
    else if (select.value === 'true_false') {
        mcq.style.display = 'none';
        tf.classList.remove('d-none');
    }
    else {
        mcq.style.display = 'none';
        tf.classList.add('d-none');
    }
}


function removeQuestion(id) {
    const el = document.getElementById(id);
    el.style.opacity = "0";
    setTimeout(() => el.remove(), 200);
}

const saveBtn = document.getElementById("saveExamBtn");
const questionsArea = document.getElementById("questions-area");

/* ================= CHECK QUESTIONS ================= */
function checkQuestions() {
    const count = document.querySelectorAll(".question-block").length;

    if (count === 0) {
        saveBtn.disabled = true;
        saveBtn.style.opacity = "0.6";
        saveBtn.style.cursor = "not-allowed";
    } else {
        saveBtn.disabled = false;
        saveBtn.style.opacity = "1";
        saveBtn.style.cursor = "pointer";
    }
}

/* ================= CALL ON LOAD ================= */
document.addEventListener("DOMContentLoaded", checkQuestions);

/* ================= OVERRIDE ADD ================= */
const originalAddQuestion = addQuestion;
addQuestion = function () {
    originalAddQuestion();
    checkQuestions();
};

/* ================= OVERRIDE REMOVE ================= */
const originalRemoveQuestion = removeQuestion;
removeQuestion = function (id) {
    originalRemoveQuestion(id);
    setTimeout(checkQuestions, 250);
};
</script>

</body>
</html>
