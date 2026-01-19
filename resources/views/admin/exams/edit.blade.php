<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Exam</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite([
    'resources/css/admin/app.css'
])
</head>

<body class="bg-light">
<!-- NAV -->
    @include('admin-sidebar.navbar')
<div class="container py-4">
    
<div class="card shadow-lg p-4">
<div class="d-flex justify-content-between">
<a href="{{ route('admin.uploading-exams') }}" class="btn btn-secondary">Cancel</a>
</div>
<br>
<h3 class="fw-bold mb-4"><i class="fas fa-add me-2"></i> Edit Exam</h3>

<form method="POST" action="{{ route('admin.exams.update', $exam->id) }}">
@csrf
@method('PUT')

<div id="deleted-questions"></div>

<!-- EXAM INFO -->
<div class="row mb-4">
    <div class="col-md-8">
        <label class="fw-semibold">Exam Title</label>
        <input type="text" name="title" class="form-control"
               value="{{ $exam->title }}" required>
    </div>

    <div class="col-md-4">
        <label class="fw-semibold">Timer (seconds)</label>
        <input type="number" name="timer" class="form-control"
               value="{{ $exam->timer }}" required>
    </div>
</div>

<hr>

<!-- QUESTIONS -->
@foreach($exam->questions as $q)
<div class="border rounded p-3 mb-4 position-relative">

<button type="button"
        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
        onclick="deleteExistingQuestion(this, {{ $q->id }})">
✕
</button>

<label class="fw-semibold">Question</label>
<input type="text"
       name="questions[{{ $q->id }}]"
       class="form-control mb-2"
       value="{{ $q->question }}">

<label class="fw-semibold mt-2">Type</label>
<select name="type[{{ $q->id }}]"
        class="form-select mb-3"
        onchange="toggleType(this, {{ $q->id }})">
    <option value="mcq" {{ $q->type==='mcq'?'selected':'' }}>Multiple Choice</option>
    <option value="true_false" {{ $q->type==='true_false'?'selected':'' }}>True / False</option>
    <option value="essay" {{ $q->type==='essay'?'selected':'' }}>Essay</option>
</select>

<!-- MCQ -->
<div class="mcq-area" data-id="{{ $q->id }}" style="{{ $q->type!=='mcq'?'display:none':'' }}">
@foreach($q->options as $o)
<input type="text"
       name="options[{{ $q->id }}][]"
       class="form-control mb-2"
       value="{{ $o->option_text }}">
@endforeach

<label class="fw-semibold mt-2">Correct Option (1–4)</label>
@php
    $correctPos = $q->options->pluck('id')->search($q->correct_option);
@endphp

<input type="number"
       name="correct[{{ $q->id }}]"
       class="form-control w-25"
       value="{{ $correctPos !== false ? $correctPos + 1 : '' }}"
       min="1" max="4">

</div>

<!-- TRUE FALSE -->
<div class="tf-area" data-id="{{ $q->id }}" style="{{ $q->type!=='true_false'?'display:none':'' }}">
<label class="fw-semibold">Correct Answer</label>
<select name="correct[{{ $q->id }}]" class="form-select w-25">
    <option value="1" {{ $q->correct_option==1?'selected':'' }}>True</option>
    <option value="0" {{ $q->correct_option==0?'selected':'' }}>False</option>
</select>
</div>

<!-- ESSAY -->
<div class="essay-area" data-id="{{ $q->id }}" style="{{ $q->type!=='essay'?'display:none':'' }}">
<p class="text-muted mt-2">📝 Essay — manual checking</p>
</div>

</div>
@endforeach

<hr>

<h5 class="fw-bold mt-4"><i class="fas fa-add me-2"></i> Add New Question</h5>

<div id="new-questions"></div>

<button type="button"
        class="btn btn-outline-dark mb-4"
        onclick="addNewQuestion()">
    + Add Question
</button>

<div class="d-flex justify-content-between">
<a href="{{ route('admin.uploading-exams') }}" class="btn btn-secondary">Cancel</a>
<button class="btn btn-primary"> Update Exam</button>
</div>

</form>
</div>
</div>

<script>

let newIndex = 0;

function addNewQuestion() {
    const id = `new_${newIndex++}`;

    document.getElementById('new-questions').insertAdjacentHTML('beforeend', `
        <div class="border rounded p-3 mb-4 position-relative">

            <button type="button"
                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                    onclick="this.closest('.border').remove()">
                ✕
            </button>

            <label class="fw-semibold">Question</label>
            <input type="text"
                   name="new_questions[${id}][question]"
                   class="form-control mb-2"
                   required>

            <label class="fw-semibold mt-2">Type</label>
            <select name="new_questions[${id}][type]"
                    class="form-select mb-3"
                    onchange="toggleNewType(this, '${id}')">
                <option value="mcq">Multiple Choice</option>
                <option value="true_false">True / False</option>
                <option value="essay">Essay</option>
            </select>

            <!-- MCQ -->
            <div class="mcq-new" data-id="${id}">
                <input type="text" name="new_questions[${id}][options][]" class="form-control mb-2" placeholder="Option A">
                <input type="text" name="new_questions[${id}][options][]" class="form-control mb-2" placeholder="Option B">
                <input type="text" name="new_questions[${id}][options][]" class="form-control mb-2" placeholder="Option C">
                <input type="text" name="new_questions[${id}][options][]" class="form-control mb-2" placeholder="Option D">

                <label class="fw-semibold mt-2">Correct Option (1–4)</label>
                <input type="number"
                       name="new_questions[${id}][correct]"
                       class="form-control w-25"
                       min="1" max="4">
            </div>

            <!-- TRUE/FALSE -->
            <div class="tf-new d-none" data-id="${id}">
                <label class="fw-semibold">Correct Answer</label>
                <select name="new_questions[${id}][correct]" class="form-select w-25">
                    <option value="1">True</option>
                    <option value="0">False</option>
                </select>
            </div>

            <!-- ESSAY -->
            <div class="essay-new d-none" data-id="${id}">
                <p class="text-muted mt-2">📝 Essay — manual checking</p>
            </div>

        </div>
    `);
}

function toggleNewType(select, id) {
    const mcq = document.querySelector(`.mcq-new[data-id="${id}"]`);
    const tf  = document.querySelector(`.tf-new[data-id="${id}"]`);
    const es  = document.querySelector(`.essay-new[data-id="${id}"]`);

    mcq.classList.add('d-none');
    tf.classList.add('d-none');
    es.classList.add('d-none');

    if (select.value === 'mcq') mcq.classList.remove('d-none');
    if (select.value === 'true_false') tf.classList.remove('d-none');
    if (select.value === 'essay') es.classList.remove('d-none');
}

function toggleType(select, id) {

    const mcq = document.querySelector(`.mcq-area[data-id="${id}"]`);
    const tf  = document.querySelector(`.tf-area[data-id="${id}"]`);
    const es  = document.querySelector(`.essay-area[data-id="${id}"]`);

    // hide all
    mcq.style.display = "none";
    tf.style.display  = "none";
    es.style.display  = "none";

    // 🔥 disable all correct inputs
    mcq.querySelectorAll('input').forEach(i => i.disabled = true);
    tf.querySelectorAll('select').forEach(i => i.disabled = true);

    if (select.value === 'mcq') {
        mcq.style.display = "block";
        mcq.querySelectorAll('input').forEach(i => i.disabled = false);
    }

    if (select.value === 'true_false') {
        tf.style.display = "block";
        tf.querySelectorAll('select').forEach(i => i.disabled = false);
    }

    if (select.value === 'essay') {
        es.style.display = "block";
    }
}

function deleteExistingQuestion(btn, id) {
    if (!confirm('Delete this question?')) return;

    btn.closest('.border').remove();

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'deleted_questions[]';
    input.value = id;

    document.getElementById('deleted-questions').appendChild(input);
}
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('select[name^="type"]').forEach(select => {
        const id = select.name.match(/\d+/)[0];
        toggleType(select, id);
    });
});
</script>

</body>
</html>
