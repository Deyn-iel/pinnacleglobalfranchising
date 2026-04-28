<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Create Exam</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite(['resources/css/admin/app.css'])

<style>
    body {
        background: #f5f6fa;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }

    main {
        margin-left: 260px;
        padding: clamp(22px, 2.5vw, 36px);
        max-width: calc(100vw - 260px);
    }

    .page-header {
        background: #ffffff;
        padding: 18px 22px;
        border-radius: 12px;
        box-shadow: 0 8px 28px rgba(15,23,42,.08);
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .exam-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 12px 36px rgba(15,23,42,.10);
    }

    label {
        font-weight: 600;
        font-size: 14px;
        margin-top: 12px;
    }

    input, select {
        border-radius: 12px;
        padding: 11px 14px;
    }

    input:focus, select:focus {
        box-shadow: 0 0 0 4px rgba(37,99,235,.12);
        border-color: #2563eb;
    }

    .question-block {
        background: #fafafa;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
        margin-top: 20px;
        position: relative;
        transition: box-shadow .25s ease;
    }

    .question-block:hover {
        box-shadow: 0 10px 26px rgba(0,0,0,.08);
        background: #ffffff;
    }

    .delete-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #fee2e2;
        color: #b91c1c;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .delete-btn:hover {
        background: #fecaca;
    }

    .btn-dark {
        background: #000000;
        border: none;
        font-weight: 600;
        border-radius: 12px;
        padding: 10px 20px;
    }

    .btn-dark:hover {
        background: #333333;
    }

    .btn-save:disabled {
        background: #9ca3af !important;
        cursor: not-allowed;
        opacity: .85;
    }

    .exam-list {
        margin-top: 48px;
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
    }

    .exam-item {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px 18px;
        margin-bottom: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        transition: background .2s ease;
    }

    .exam-item:hover {
        background: #f9fafb;
    }

    .exam-actions {
        display: inline-flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .exam-actions .action-menu {
        min-width: 160px;
    }

    @media (max-width: 1200px) {
        main {
            padding: 20px;
        }
    }
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <div class="page-header">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fas fa-file-circle-plus me-2"></i>Create New Exam
            </h4>
            <p class="text-muted mb-0">Define exam details and manage questions.</p>
        </div>

        <a href="{{ route('admin.exam-results') }}"
           class="btn btn-outline-primary fw-semibold">
            <i class="fas fa-chart-bar me-1"></i> Exam Results
        </a>
    </div>

    <div class="exam-card">

        @if(session('success'))
<div id="uploadSuccessAlert"
     class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
     role="alert">
     
    <i class="fas fa-check-circle fs-5"></i>
    <strong>{{ session('success') }}</strong>
</div>
@endif

        <form action="{{ route('admin.exams.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-lg-8">
                    <label>Exam Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="col-lg-4">
                    <label>Timer (seconds)</label>
                    <input type="number" name="timer" class="form-control" value="60" required>
                </div>
            </div>

            <h5 class="fw-bold mt-4">Questions</h5>
            <div id="questions-area"></div>

            <div class="d-flex gap-3 mt-4 flex-wrap">
                <button type="button" class="btn btn-dark" onclick="addQuestion()">
                    + Add Question
                </button>

                <button type="submit" class="btn btn-dark btn-save" id="saveExamBtn" disabled>
                    <i class="fas fa-save me-1"></i> Save Exam
                </button>
            </div>
        </form>

        <!-- EXAM LIST -->
        <div class="exam-list">
            <h5 class="fw-bold mb-3">Uploaded Exams</h5>

            @forelse($exams as $exam)
                <div class="exam-item">
                    <div>
                        <strong>{{ $exam->title }}</strong><br>
                        <span class="text-muted">{{ $exam->questions->count() }} questions</span>
                    </div>

                    <div class="exam-actions dropdown">
                        <button class="action-menu-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" aria-label="Open actions">
                            <i class="fas fa-ellipsis"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end action-menu">
                        <form action="{{ route('admin.exams.toggle', $exam->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm fw-semibold
                                {{ $exam->is_active ? 'btn-warning' : 'btn-success' }}">
                                {{ $exam->is_active ? 'Disable' : 'Enable' }}
                            </button>
                        </form>

                        <a href="{{ route('admin.exams.edit', $exam->id) }}"
                           class="btn btn-sm btn-primary fw-semibold">
                            <i class="fas fa-pen"></i> Edit
                        </a>

                        <form action="{{ route('admin.exams.delete', $exam->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this exam?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger fw-semibold">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No exams uploaded yet.</p>
            @endforelse
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

document.addEventListener("DOMContentLoaded", checkQuestions);

const originalAddQuestion = addQuestion;
addQuestion = function () {
    originalAddQuestion();
    checkQuestions();
};

const originalRemoveQuestion = removeQuestion;
removeQuestion = function (id) {
    originalRemoveQuestion(id);
    setTimeout(checkQuestions, 250);
};
</script>

</body>
</html>

