<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Admin · Support Tickets</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

@vite(['resources/css/admin/app.css'])

<style>
body {
    background: #f5f6fa;
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

/* ===== MAIN ===== */
main {
    margin-left: 260px;
    padding: clamp(20px, 2vw, 36px);
    max-width: calc(100vw - 260px);
}

/* ===== HEADER ===== */
.page-header {
    background: #ffffff;
    border-radius: 18px;
    padding: 28px 32px;
    box-shadow: 0 18px 40px rgba(15,23,42,.08);
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.page-header h3 {
    font-weight: 800;
}

/* ===== USER CARD ===== */
.user-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 18px 38px rgba(15,23,42,.08);
    margin-bottom: 36px;
}

.user-header {
    padding: 20px 26px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-header h5 {
    margin: 0;
    font-weight: 700;
}

.user-header small {
    color: #64748b;
}

/* ===== TABLE ===== */
.table thead {
    background: #f1f5f9;
}

.table thead th {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #475569;
}

.description-box {
    max-width: 380px;
    font-size: 13px;
    color: #64748b;
    line-height: 1.4;
}

/* ===== ACTIONS ===== */
.action-wrap {
    display: flex;
    gap: 8px;
    align-items: center;
}

.form-select-sm {
    border-radius: 10px;
    font-size: 13px;
}

.no-tickets {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 18px 38px rgba(15,23,42,.08);
    margin-bottom: 20px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .description-box {
        max-width: 260px;
    }
}

@media (max-width: 992px) {
    main {
        margin-left: 0;
        max-width: 100%;
    }
}

@media (max-width: 768px) {
    .action-wrap {
        flex-direction: column;
        align-items: stretch;
    }

    .description-box {
        max-width: 100%;
    }
}
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <h3><i class="fa-solid fa-ticket"></i> Support Tickets</h3>
            <p class="text-muted mb-0">View tickets by account</p>
        </div>
        <span class="text-muted small">
            Admin: <strong>{{ Auth::user()->name }}</strong>
        </span>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="successAlert">
            <i class="fa-solid fa-circle-check me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- USERS --}}
    @forelse($tickets as $userId => $userTickets)

        @php $user = $userTickets->first()->user; @endphp

        <div class="user-card">

            <!-- USER HEADER -->
            <div class="user-header">
                <div>
                    <h5>
                        <i class="fa-solid fa-user me-1 text-muted"></i>
                        {{ $user->name ?? 'Unknown User' }}
                    </h5>
                    <small>{{ $user->email ?? 'No email' }}</small>
                </div>

                <span class="badge bg-primary">
                    {{ $userTickets->count() }} Ticket(s)
                </span>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-4">
                    <thead>
                        <tr>
                            <th>Ticket #</th>
                            <th>Branch</th>
                            <th>Concern</th>
                            <th>Dept</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Date Submitted</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($userTickets as $ticket)
                        <tr>
                            <td class="fw-semibold">{{ $ticket->ticket_no }}</td>

                            <td class="fw-semibold">{{ $ticket->subject }}</td>

                            <td>
                                <div class="description-box">
                                    {{ $ticket->description }}
                                </div>
                            </td>

                            <td>{{ ucfirst($ticket->department) }}</td>

                            <td>
                                <span class="badge
                                    {{ $ticket->priority === 'high' ? 'bg-danger p-2'
                                        : ($ticket->priority === 'medium' ? 'bg-warning text-light p-2'
                                        : ($ticket->priority === 'low' ? 'bg-info p-2'
                                        : 'bg-secondary')) }}">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge
                            {{ $ticket->status === 'pending' ? 'bg-danger text-light p-2'
                                : ($ticket->status === 'in_progress' ? 'bg-primary text-light p-2'
                                : ($ticket->status === 'resolved' ? 'bg-success text-light p-2'
                                : 'bg-secondary')) }}">
                            {{ ucwords(str_replace('_',' ', $ticket->status)) }}
                        </span>
                            </td>

                            <td>
                            <div class="small text-muted">
                                {{ $ticket->created_at->format('M d, Y') }} <br>
                                <span class="text-secondary">
                                    {{ $ticket->created_at->format('h:i A') }}
                                </span>
                            </div>
                        </td>


                            <td class="text-center align-middle">
                            <div class="action-wrap justify-content-center">

                                {{-- STATUS --}}
                                <form method="POST"
                                    action="{{ route('admin.tickets.update', $ticket) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status"
                                        class="form-select form-select-sm"
                                        onchange="this.form.submit()">

                                    <option value="pending" @selected($ticket->status==='pending')>
                                        Pending
                                    </option>

                                    <option value="in_progress" @selected($ticket->status==='in_progress')>
                                        In Progress
                                    </option>

                                    <option value="resolved" @selected($ticket->status==='resolved')>
                                        Resolved
                                    </option>

                                </select>

                                </form>

                                {{-- DELETE --}}
                                <form method="POST"
                                    action="{{ route('admin.tickets.destroy', $ticket) }}"
                                    onsubmit="return confirm('Delete this ticket permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    @empty
    <div class="no-tickets">
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-ticket fa-2x mb-2"></i><br>
            No support tickets available
        </div>
        </div>
    @endforelse

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const alert = document.getElementById('successAlert');
    if(alert){
        setTimeout(() => {
            alert.classList.remove('show');
        }, 4000); // visible for 4s

        setTimeout(() => {
            alert.remove();
        }, 3500);
    }
});
</script>
</body>
</html>
