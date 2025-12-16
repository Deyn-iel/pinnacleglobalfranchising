<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Exam</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #eef2f7;
        margin: 0;
        padding: 30px;
    }

    .container {
        max-width: 900px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }

    h2 {
        margin-top: 0;
        color: #1e3a8a;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 15px;
        font-size: 14px;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    /* Question Card */
    .question-block {
        margin-top: 20px;
        padding: 15px;
        border-radius: 10px;
        background: #f0f5ff;
        border: 1px solid #c7d7ff;
        position: relative;
    }

    /* Delete button */
    .delete-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc2626;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
    }

    .delete-btn:hover {
        background: #b91c1c;
    }

    button {
        padding: 12px 20px;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 8px;
        margin-top: 20px;
        cursor: pointer;
        font-weight: bold;
        font-size: 15px;
    }

    button:hover {
        background: #1e4fc6;
    }

    .add-btn {
        background: #059669;
    }

    .add-btn:hover {
        background: #047857;
    }

    /* Success Message */
    .success-box {
        background: #d1fae5;
        color: #065f46;
        border-left: 6px solid #10b981;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-weight: bold;
    }

    /* Uploaded Exams List */
    .exam-list {
        margin-top: 40px;
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #d1d5db;
    }

    .exam-list h3 {
        margin-top: 0;
        color: #1e3a8a;
    }

    .exam-item {
        padding: 10px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .exam-item:last-child {
        border-bottom: none;
    }

</style>

</head>
<body>

<div class="container">

    
    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="success-box">
            ✔ {{ session('success') }}
        </div>
    @endif

    <h2>Add Exam</h2>
    <p>Fill out the exam title, timer, and add questions.</p>

    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf

        <label>Exam Title</label>
        <input type="text" name="title" required>

        <label>Timer (seconds)</label>
        <input type="number" name="timer" value="60" required>

        <h3 style="margin-top: 25px;">Questions</h3>

        <div id="questions-area"></div>

        <button type="button" class="add-btn" onclick="addQuestion()">+ Add Question</button>

        <button type="submit">Save Exam</button>
    </form>

    <!-- SHOW LIST OF EXAMS -->
    <div class="exam-list">
    <h3>Uploaded Exams</h3>

    @forelse($exams as $exam)
        <div class="exam-item">
            <strong>{{ $exam->title }}</strong> — {{ $exam->questions->count() }} questions

            <form action="{{ route('admin.exams.delete', $exam->id) }}" 
                  method="POST" 
                  style="display:inline; float:right;">
                @csrf
                @method('DELETE')

                <button type="submit" 
                        style="
                            background:#dc2626;
                            color:white;
                            border:none;
                            padding:5px 10px;
                            border-radius:6px;
                            cursor:pointer;
                            font-size:12px;
                            font-weight:bold;">
                    Delete
                </button>
            </form>
        </div>
    @empty
        <p>No exams uploaded yet.</p>
    @endforelse
</div>


</div>

<!-- JAVASCRIPT -->
<script>
function addQuestion() {
    let qId = Date.now(); // unique ID for question div

    document.getElementById("questions-area").innerHTML += `
        <div class="question-block" id="q${qId}">

            <button type="button" class="delete-btn" onclick="removeQuestion('q${qId}')">Delete</button>

            <label>Question</label>
            <input type="text" name="questions[]" required>

            <label>Options</label>
            <input type="text" name="option1[]" placeholder="Option 1" required>
            <input type="text" name="option2[]" placeholder="Option 2" required>
            <input type="text" name="option3[]" placeholder="Option 3" required>
            <input type="text" name="option4[]" placeholder="Option 4" required>

            <label>Correct Option (1–4)</label>
            <input type="number" name="correct[]" min="1" max="4" required>

        </div>
    `;
}

function removeQuestion(id) {
    document.getElementById(id).remove();
}
</script>

</body>
</html>
