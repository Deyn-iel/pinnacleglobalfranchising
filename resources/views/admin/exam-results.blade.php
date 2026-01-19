<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Exam Results</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite([
    'resources/css/admin/app.css'
])
<style>
    .alert {
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.alert.fade:not(.show) {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
</head>
<body>
<!-- NAV -->
    @include('admin-sidebar.navbar')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Exam Results</h2>

        <a href="{{ route('admin.uploading-exams') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>

    @if(session('success'))
<div id="uploadSuccessAlert"
     class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
     role="alert">
     
    <i class="fas fa-check-circle fs-5"></i>
    <strong>{{ session('success') }}</strong>
</div>
@endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Exam</th>
                <th>Score</th>
                <th>Total</th>
                <th>Date Taken</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
           @forelse($results as $result)
<tr>
    <td>{{ $result->user->name }}</td>
    <td>{{ $result->exam->title }}</td>
    <td><strong>{{ $result->score }}</strong></td>
    <td>{{ $result->total_questions }}</td>
    <td>{{ $result->created_at->format('M d, Y h:i A') }}</td>
    <td class="d-flex gap-2">
    <a href="{{ route('admin.exam-results.view', $result->id) }}"
       class="btn btn-sm btn-primary">
        View
    </a>

    <form action="{{ route('admin.exam-results.delete', $result->id) }}"
          method="POST"
          onsubmit="return confirm('Delete this exam result?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">Delete</button>
    </form>
</td>

</tr>

@if($result->essay_answers)
<tr>
    <td colspan="6">
        <strong>📝 Essay Answers:</strong>
        @php
            $essayAnswers = json_decode($result->essay_answers, true);
        @endphp

        @foreach($essayAnswers as $qid => $answer)
            <div class="mt-2">
                <strong>Question ID {{ $qid }}:</strong>
                <p class="mb-1">{{ $answer }}</p>
            </div>
        @endforeach
    </td>
</tr>
@endif
@empty

                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No exam results yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

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
</script>
</body>
</html>
