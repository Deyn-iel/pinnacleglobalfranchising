<!DOCTYPE html>
<html lang="en">
<head>
    <title>Exam Result Details</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Alpine.js (Sidebar Toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite([
    'resources/css/admin/app.css'
])
</head>
<body>
<!-- NAV -->
    @include('admin-sidebar.navbar')
<div class="container mt-5">

    <a href="{{ route('admin.exam-results') }}" class="btn btn-secondary mb-4">
        ← Back to Results
    </a>

    <h3 class="fw-bold mb-3">📝 Exam Result Details</h3>

    <!-- SUMMARY -->
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>User:</strong> {{ $result->user->name }}</p>
            <p><strong>Exam:</strong> {{ $result->exam->title }}</p>
            <p><strong>Score:</strong> {{ $result->score }}</p>
            <p><strong>Date Taken:</strong> {{ $result->created_at->format('M d, Y h:i A') }}</p>
        </div>
    </div>

    <h4 class="fw-semibold mb-3">📋 User Answers</h4>

    @foreach($result->exam->questions as $index => $question)

        @php
            $answerModel = $answers->get($question->id);
            $userAnswer  = $answerModel?->answer;
        @endphp

        <div class="card mb-3">
            <div class="card-body">

                <p class="fw-bold mb-2">
                    {{ $index + 1 }}. {{ $question->question }}
                </p>

                <p class="text-muted">
                    <strong>Type:</strong>
                    {{ strtoupper(str_replace('_', ' ', $question->type)) }}
                </p>

                {{-- MCQ --}}
                @if($question->type === 'mcq')

                @php
                    $userOption = $question->options->firstWhere('id', $userAnswer);
                    $correctOption = $question->options->firstWhere('id', $question->correct_option);
                @endphp

                <p>
                    <strong>User Answer:</strong>
                    {{ $userOption ? $userOption->option_text : 'No answer submitted' }}
                </p>

                <p>
                    <strong>Correct Answer:</strong>
                    {{ $correctOption ? $correctOption->option_text : 'Not set' }}
                </p>

                @if((int)$userAnswer === (int)$question->correct_option)
                    <span class="badge bg-success">Correct</span>
                @else
                    <span class="badge bg-danger">Wrong</span>
                @endif

            @endif


                {{-- TRUE / FALSE --}}
                @if($question->type === 'true_false')
                    <p>
                        <strong>User Answer:</strong>
                        {{ $userAnswer === null ? 'No answer' : ($userAnswer == 1 ? 'True' : 'False') }}
                    </p>

                    <p>
                        <strong>Correct Answer:</strong>
                        {{ $question->correct_option == 1 ? 'True' : 'False' }}
                    </p>

                    @if((string)$userAnswer === (string)$question->correct_option)
                        <span class="badge bg-success">Correct</span>
                    @else
                        <span class="badge bg-danger">Wrong</span>
                    @endif
                @endif

                {{-- ESSAY --}}
                @if($question->type === 'essay')
                    <p><strong>User Answer:</strong></p>
                    <div class="border rounded p-3 bg-light">
                        {{ $userAnswer ?: 'No answer submitted.' }}
                    </div>

                    <span class="badge bg-warning text-dark mt-2">
                        Manual Checking Required
                    </span>
                @endif

            </div>
        </div>

    @endforeach

</div>

</body>
</html>
