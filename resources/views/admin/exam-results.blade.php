<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Admin · Exam Results</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        .page-header {
            background: #ffffff;
            padding: 16px 22px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
            margin-bottom: 24px;
        }

        .user-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 26px rgba(15, 23, 42, 0.08);
            padding: 18px 22px;
            margin-bottom: 26px;
        }

        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 12px;
            margin-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .user-name {
            font-weight: 700;
            font-size: 16px;
        }

        .user-email {
            font-size: 13px;
            color: #6b7280;
        }

        .exam-row {
            display: grid;
            grid-template-columns: 1fr 160px 120px;
            gap: 16px;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .exam-row:last-child {
            border-bottom: none;
        }

        .exam-title {
            font-weight: 600;
        }

        .exam-date {
            font-size: 12px;
            color: #6b7280;
        }

        .exam-score {
            font-weight: 700;
            text-align: center;
        }

        .exam-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: #fff;
        }

        .btn-icon:hover {
            background: #f8fafc;
        }

        /* ===== EMPTY ===== */
        .empty-state {
            background: #ffffff;
            padding: 60px;
            text-align: center;
            border-radius: 12px;
            color: #6b7280;
            box-shadow: 0 8px 26px rgba(15, 23, 42, 0.08);
        }

        @media (max-width: 1200px) {
            .exam-row {
                grid-template-columns: 1fr 140px 110px;
            }
        }
    </style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- PAGE HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">
            <i class="fas fa-clipboard-list me-2"></i>Exam Results
        </h4>

        <a href="{{ route('admin.uploading-exams') }}"
           class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    @php
        $groupedResults = $results->groupBy('user_id');
    @endphp

    @forelse($groupedResults as $userResults)
        @php
            $user = $userResults->first()->user;
        @endphp

        <!-- USER CARD -->
        <div class="user-card">

            <!-- USER HEADER -->
            <div class="user-header">
                <div>
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-email">{{ $user->email ?? 'User' }}</div>
                </div>
                <span class="badge bg-secondary">
                    {{ $userResults->count() }} Exam(s)
                </span>
            </div>

            <!-- EXAMS -->
            @foreach($userResults as $result)
                <div class="exam-row">

                    <div>
                        <div class="exam-title">{{ $result->exam->title }}</div>
                        <div class="exam-date">
                            {{ $result->created_at->format('M d, Y · h:i A') }}
                        </div>
                    </div>

                    <div class="exam-score">
                        {{ $result->score }} / {{ $result->total_questions }}
                    </div>

                    <div class="exam-actions">
                        <a href="{{ route('admin.exam-results.view', $result->id) }}"
                           class="btn-icon"
                           title="View Result">
                            <i class="fas fa-eye text-primary"></i>
                        </a>

                        <form action="{{ route('admin.exam-results.delete', $result->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this exam result?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-icon" title="Delete Result">
                                <i class="fas fa-trash text-danger"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach

        </div>

    @empty
        <div class="empty-state">
            <i class="fas fa-folder-open fa-2x mb-3"></i>
            <p class="mb-0">No exam results available yet.</p>
        </div>
    @endforelse

</main>

</body>
</html>
