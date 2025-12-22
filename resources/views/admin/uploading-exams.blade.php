<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create Exam</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f5f6fa;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

.sidebar-link { text-decoration: none; }

/* MAIN CARD */
.exam-container {
    max-width: 900px;
    margin: 30px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* HEADINGS */
.exam-container h2 {
    color: #1e3a8a;
    font-weight: 700;
}

.exam-container h3 {
    margin-top: 30px;
    font-weight: 600;
    color: #1e40af;
}

/* LABELS */
label {
    font-weight: 600;
    margin-top: 15px;
    font-size: 14px;
}

/* INPUTS */
input[type="text"],
input[type="number"] {
    border-radius: 8px;
    padding: 12px;
}

/* QUESTION CARD */
.question-block {
    margin-top: 20px;
    padding: 20px;
    border-radius: 14px;
    background: #f0f5ff;
    border: 1px solid #c7d7ff;
    position: relative;
}

/* DELETE QUESTION */
.delete-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #dc2626;
    color: #fff;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
}

.delete-btn:hover {
    background: #b91c1c;
}

/* BUTTONS */
.btn-add {
    background: #059669;
    color: #fff;
    font-weight: 600;
}

.btn-add:hover {
    background: #047857;
}

.btn-save {
    background: #2563eb;
    color: #fff;
    font-weight: 600;
}

.btn-save:hover {
    background: #1e40af;
}

/* SUCCESS */
.success-box {
    background: #d1fae5;
    color: #065f46;
    border-left: 6px solid #10b981;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
}

/* EXAM LIST */
.exam-list {
    margin-top: 50px;
    padding: 20px;
    background: #f9fafb;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
}

.exam-item {
    padding: 14px 0;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}

.exam-item:last-child {
    border-bottom: none;
}

/* EXAM RESULTS BUTTON */
.btn-results {
    border-radius: 10px;
    padding: 10px 18px;
    font-weight: 600;
}

.btn-results:hover {
    background: #2563eb;
    color: #fff;
}

/* MOBILE */
@media (max-width: 576px) {
    .exam-container {
        padding: 20px;
    }

    .exam-item {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
</head>

<body>

<!-- TOP NAV -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">Admin Panel</span>

        <div class="d-flex align-items-center gap-3">
            <span class="text-white">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('custom.logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

@include('admin-sidebar.sidebar')

<!-- MAIN CONTENT -->
<div class="exam-container">

    @if(session('success'))
        <div class="success-box">
            ✔ {{ session('success') }}
        </div>
    @endif

    <!-- HEADER + EXAM RESULTS BUTTON -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="mb-1">Create New Exam</h2>
            <p class="text-muted mb-0">Set the exam details and add questions below.</p>
        </div>

        <!-- ✅ EXAM RESULTS (DESIGN FIXED, ROUTE UNCHANGED) -->
        <a href="{{ route('admin.exam-results') }}" class="btn btn-outline-primary btn-results">
            📝 Exam Results
        </a>
    </div>

    <!-- CREATE EXAM FORM -->
    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf

        <!-- EXAM INFO -->
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

        <!-- QUESTIONS -->
        <h3>Questions</h3>
        <div id="questions-area"></div>

        <div class="d-flex gap-3 mt-3 flex-wrap">
            <button type="button" class="btn btn-add" onclick="addQuestion()">+ Add Question</button>
            <button type="submit" class="btn btn-save">Save Exam</button>
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
                    <a href="{{ route('admin.exams.edit', $exam->id) }}"
                       class="btn btn-sm btn-warning fw-semibold">
                        Edit
                    </a>

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

<script>
function addQuestion() {
    const id = Date.now();

    document.getElementById("questions-area").insertAdjacentHTML("beforeend", `
        <div class="question-block" id="q${id}">
            <button type="button" class="delete-btn" onclick="removeQuestion('q${id}')">Delete</button>

            <label>Question</label>
            <input type="text" name="questions[]" class="form-control" required>

            <label class="mt-2">Options</label>
            <input type="text" name="option1[]" class="form-control mb-2" placeholder="Option 1" required>
            <input type="text" name="option2[]" class="form-control mb-2" placeholder="Option 2" required>
            <input type="text" name="option3[]" class="form-control mb-2" placeholder="Option 3" required>
            <input type="text" name="option4[]" class="form-control mb-2" placeholder="Option 4" required>

            <label>Correct Option (1–4)</label>
            <input type="number" name="correct[]" class="form-control" min="1" max="4" required>
        </div>
    `);
}

function removeQuestion(id) {
    const el = document.getElementById(id);
    el.style.opacity = "0";
    setTimeout(() => el.remove(), 200);
}
</script>

</body>
</html>
