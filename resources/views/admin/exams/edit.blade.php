<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Exam</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #f4f6f9;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    .page-wrapper {
        max-width: 950px;
        margin: 40px auto;
        padding: 25px;
    }

    .card-main {
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 20px 45px rgba(0,0,0,0.08);
        padding: 30px;
    }

    .page-title {
        font-weight: 700;
        color: #0d3553;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .question-card {
        background: #f8fafc;
        border-radius: 14px;
        padding: 18px;
        border: 1px solid #e5e7eb;
        margin-bottom: 18px;
        position: relative;
    }

    .remove-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 12px;
        border: none;
        background: #dc2626;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        cursor: pointer;
    }

    .option-input {
        margin-bottom: 8px;
    }

    .correct-input {
        max-width: 120px;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: #2563eb;
        border: none;
        border-radius: 10px;
        padding: 12px 22px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: #1e40af;
    }

    .btn-success {
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-secondary {
        border-radius: 10px;
        padding: 12px 22px;
        font-weight: 600;
    }

    @media (max-width: 576px) {
        .actions {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
</head>

<body>

<div class="page-wrapper">
    <div class="card-main">

        <h2 class="page-title">✏️ Edit Exam</h2>

        <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div id="deleted-questions"></div>
            <!-- EXAM INFO -->
            <div class="row mb-4">
            <div class="col-md-8">
                <label>Exam Title</label>
                <input type="text"
                    name="title"
                    class="form-control"
                    value="{{ $exam->title }}"
                    required>
            </div>

            <div class="col-md-4">
                <label>Timer (seconds)</label>
                <input type="number"
                    name="timer"
                    class="form-control"
                    value="{{ $exam->timer }}"
                    required>
            </div>
        </div>


            <!-- QUESTIONS -->
            <h5 class="mb-3 fw-bold text-secondary">Questions</h5>

            <div id="questions-area">
            @foreach ($exam->questions as $qIndex => $question)
    <div class="question-card" data-question-id="{{ $question->id }}">
        <button type="button"
                class="remove-btn"
                onclick="deleteExistingQuestion(this, {{ $question->id }})">
            ✕
        </button>

        <h6>Question {{ $qIndex + 1 }}</h6>

        <!-- 🔑 IMPORTANT: QUESTION ID -->
        <input type="hidden"
               name="question_ids[{{ $qIndex }}]"
               value="{{ $question->id }}">

        <input type="text"
               name="questions[{{ $qIndex }}]"
               class="form-control mb-3"
               value="{{ $question->question }}"
               required>

        <div class="row">
            @foreach ($question->options as $oIndex => $option)
                <div class="col-md-6">
                    <input type="text"
                           name="options[{{ $qIndex }}][{{ $oIndex }}]"
                           class="form-control option-input"
                           value="{{ $option->option_text }}"
                           required>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            <label>Correct Option (1–4)</label>
            <input type="number"
                   name="correct[{{ $qIndex }}]"
                   class="form-control correct-input"
                   value="{{ $question->correct_option }}"
                   min="1" max="4"
                   required>
        </div>
    </div>
@endforeach

            </div>


            <!-- ADD QUESTION -->
            <button type="button" class="btn btn-success mt-3" onclick="addQuestion()">
                ➕ Add Question
            </button>

            <!-- ACTIONS -->
            <div class="actions">
                <a href="{{ route('admin.uploading-exams') }}" class="btn btn-secondary">
                    ← Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    💾 Update Exam
                </button>
            </div>

        </form>
    </div>
</div>

<script>
let questionIndex = {{ $exam->questions->count() }};

function addQuestion() {
    const area = document.getElementById("questions-area");

    area.insertAdjacentHTML("beforeend", `
        <div class="question-card">
            <button type="button" class="remove-btn" onclick="this.parentElement.remove()">✕</button>

            <h6>Question ${questionIndex + 1}</h6>

            <input type="text"
                   name="questions[${questionIndex}]"
                   class="form-control mb-3"
                   placeholder="Enter question"
                   required>

            <div class="row">
                ${[0,1,2,3].map(i => `
                    <div class="col-md-6">
                        <input type="text"
                               name="options[${questionIndex}][${i}]"
                               class="form-control option-input"
                               placeholder="Option ${i + 1}"
                               required>
                    </div>
                `).join('')}
            </div>

            <div class="mt-3">
                <label>Correct Option (1–4)</label>
                <input type="number"
                       name="correct[${questionIndex}]"
                       class="form-control correct-input"
                       min="1" max="4"
                       required>
            </div>
        </div>
    `);

    questionIndex++;
}
function deleteExistingQuestion(btn, questionId) {
    if (!confirm("Are you sure you want to delete this question?")) return;

    // hide UI
    const card = btn.closest(".question-card");
    card.style.opacity = "0.4";
    card.style.pointerEvents = "none";
    card.style.display = "none";

    // add hidden input for backend delete
    const hidden = document.createElement("input");
    hidden.type = "hidden";
    hidden.name = "deleted_questions[]";
    hidden.value = questionId;

    document.getElementById("deleted-questions").appendChild(hidden);
}
</script>

</body>
</html>
