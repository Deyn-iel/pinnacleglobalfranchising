<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin · Exam Result Details</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/admin/app.css'])

    <style>
        body {
            background: #f5f6fa;
        }

        main {
            margin-left: 260px;
            padding: clamp(20px, 2vw, 32px);
            max-width: calc(100vw - 260px);
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: #ffffff;
            padding: 16px 22px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
            margin-bottom: 24px;
        }

        /* ===== SUMMARY ===== */
        .summary-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 18px 22px;
            box-shadow: 0 8px 26px rgba(15, 23, 42, 0.08);
            margin-bottom: 26px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .summary-item span {
            display: block;
            font-size: 12px;
            color: #6b7280;
        }

        .summary-item strong {
            font-size: 15px;
        }

        /* ===== QUESTION CARD ===== */
        .question-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 18px 22px;
            box-shadow: 0 8px 26px rgba(15, 23, 42, 0.08);
            margin-bottom: 20px;
        }

        .question-title {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .question-type {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .answer-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
        }

        .status {
            margin-top: 10px;
        }

        /* ===== DESKTOP SAFETY ===== */
        @media (max-width: 1200px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media print {

    body {
        background: #ffffff;
    }

    aside,
    .page-header,
    .btn {
        display: none !important;
    }

    main {
        margin: 0 !important;
        max-width: 100% !important;
        padding: 0 !important;
    }

    .summary-card,
    .question-card {
        page-break-inside: avoid;
        box-shadow: none !important;
        border: 1px solid #ddd;
    }

    .question-card {
        margin-bottom: 16px;
    }
}



    </style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- PAGE HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <h4 class="fw-bold mb-0">
        <i class="fas fa-file-alt me-2"></i>Exam Result Details
    </h4>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.exam-results.export-doc', $result->id) }}"
           class="btn btn-primary btn-sm">
            <i class="fas fa-file-word me-1"></i> Export to Word
        </a>

        <button onclick="window.print()" class="btn btn-dark btn-sm">
            <i class="fas fa-print me-1"></i> Print / Save as PDF
        </button>

        <a href="{{ route('admin.exam-results') }}"
           class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
</div>


    <!-- SUMMARY -->
    <div class="summary-card">
    <div class="summary-grid">

        <div class="summary-item">
            <span>User</span>
            <strong>{{ $result->user->name }}</strong>
        </div>

        <div class="summary-item">
            <span>Exam</span>
            <strong>{{ $result->exam->title }}</strong>
        </div>

        <div class="summary-item">
            <span>Score</span>
            <strong>{{ $result->score }}</strong>
        </div>

        <div class="summary-item">
            <span>Status</span>
            <strong>
                {{ $result->score >= ($result->exam->questions->count() * 0.9) ? 'PASSED' : 'FAILED' }}
            </strong>
        </div>

        <div class="summary-item">
    <span>Date Taken</span>
    <strong>
    {{ $result->created_at->copy()->addHours(8)->format('M d, Y · h:i A') }}
</strong>

</div>
        

    </div>
</div>


    <!-- QUESTIONS -->
    @foreach($result->exam->questions as $index => $question)

        @php
            $answerModel = $answers->get($question->id);
            $userAnswer  = $answerModel?->answer;
        @endphp

        <div class="question-card">

            <div class="question-title">
                {{ $index + 1 }}. {{ $question->question }}
            </div>

            <div class="question-type">
                Type: {{ strtoupper(str_replace('_', ' ', $question->type)) }}
            </div>

            {{-- MCQ --}}
            @if($question->type === 'mcq')
                @php
                    $userOption = $question->options->firstWhere('id', $userAnswer);
                    $correctOption = $question->options->firstWhere('id', $question->correct_option);
                @endphp

                <p><strong>User Answer:</strong></p>
                <div class="answer-box mb-2">
                    {{ $userOption ? $userOption->option_text : 'No answer submitted' }}
                </div>

                <p><strong>Correct Answer:</strong></p>
                <div class="answer-box">
                    {{ $correctOption ? $correctOption->option_text : 'Not set' }}
                </div>

                <div class="status">
                    @if((int)$userAnswer === (int)$question->correct_option)
                        <span class="badge bg-success">Correct</span>
                    @else
                        <span class="badge bg-danger">Wrong</span>
                    @endif
                </div>
            @endif

            {{-- TRUE / FALSE --}}
            @if($question->type === 'true_false')
                <p><strong>User Answer:</strong></p>
                <div class="answer-box mb-2">
                    {{ $userAnswer === null ? 'No answer' : ($userAnswer == 1 ? 'True' : 'False') }}
                </div>

                <p><strong>Correct Answer:</strong></p>
                <div class="answer-box">
                    {{ $question->correct_option == 1 ? 'True' : 'False' }}
                </div>

                <div class="status">
                    @if((string)$userAnswer === (string)$question->correct_option)
                        <span class="badge bg-success">Correct</span>
                    @else
                        <span class="badge bg-danger">Wrong</span>
                    @endif
                </div>
            @endif

            {{-- ESSAY --}}
            @if($question->type === 'essay')
                <p><strong>User Answer:</strong></p>
                <div class="answer-box">
                    {{ $userAnswer ?: 'No answer submitted.' }}
                </div>

                <div class="status">
                    <span class="badge bg-warning text-dark">
                        Manual Checking Required
                    </span>
                </div>
            @endif

        </div>

    @endforeach

</main>

</body>
</html>
