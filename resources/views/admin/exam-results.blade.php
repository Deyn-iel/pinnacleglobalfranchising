<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Exam Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📊 Exam Results</h2>

        <a href="{{ route('admin.uploading-exams') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                    <td>
                        <form action="{{ route('admin.exam-results.delete', $result->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this exam result?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
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

</body>
</html>
