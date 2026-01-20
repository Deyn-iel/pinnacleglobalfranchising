<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Exam Results</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/admin/app.css'])

    <style>
        .user-block {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            background: #fff;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .exam-row {
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .exam-row:last-child {
            border-bottom: none;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }
    </style>
</head>

<body>

@include('admin-sidebar.navbar')

<div class="container mt-5 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold mb-0">Exam Results</h4>

        <a href="{{ route('admin.uploading-exams') }}"
           class="btn btn-outline-secondary btn-sm">
            ← Back
        </a>
    </div>

    @php
        $groupedResults = $results->groupBy('user_id');
    @endphp

    @forelse($groupedResults as $userResults)

        @php
            $user = $userResults->first()->user;
        @endphp

        <!-- USER BLOCK -->
        <div class="user-block">

            <!-- USER NAME -->
            <div class="user-name">
                {{ $user->name }}
                <span class="muted">({{ $user->email ?? 'User' }})</span>
            </div>

            <!-- EXAMS -->
            @foreach($userResults as $result)
                <div class="exam-row d-flex justify-content-between align-items-center">

                    <div>
                        <strong>{{ $result->exam->title }}</strong>
                        <div class="muted">
                            {{ $result->created_at->format('M d, Y h:i A') }}
                        </div>
                    </div>

                    <div class="text-end">
                        <span class="me-3">
                            <strong>{{ $result->score }}</strong> /
                            {{ $result->total_questions }}
                        </span>

                        <div class="d-flex gap-2">

    <a href="{{ route('admin.exam-results.view', $result->id) }}"
       class="btn btn-sm btn-light border"
       title="View Result">
        <i class="fas fa-eye text-primary"></i>
    </a>

    <form action="{{ route('admin.exam-results.delete', $result->id) }}"
          method="POST"
          onsubmit="return confirm('Delete this exam result?')">
        @csrf
        @method('DELETE')

        <button class="btn btn-sm btn-light border text-danger"
                title="Delete Result">
            <i class="fas fa-trash"></i>
        </button>
    </form>

</div>


                    </div>

                </div>
            @endforeach

        </div>

    @empty
        <div class="text-center text-muted mt-5">
            No exam results yet.
        </div>
    @endforelse

</div>

</body>
</html>
