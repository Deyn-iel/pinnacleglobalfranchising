<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Support Ticket Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ===============================
   PREMIUM SAAS DASHBOARD THEME
=============================== */
:root {
    --bg-main: linear-gradient(135deg, #eef2f7, #f8fafc);
    --sidebar-bg: linear-gradient(180deg, #0f172a, #020617);
    --primary: #2563eb;
    --primary-soft: rgba(37,99,235,.15);
    --success: #16a34a;
    --warning: #f59e0b;
    --danger: #dc2626;
    --text-main: #0f172a;
    --text-muted: #64748b;
}

body {
    background: var(--bg-main);
    font-family: Inter, system-ui, -apple-system, sans-serif;
    color: var(--text-main);
}

/* =====================
   SIDEBAR
===================== */
.sidebar {
    min-height: 100vh;
    background: var(--sidebar-bg);
    color: #e5e7eb;
    box-shadow: 6px 0 30px rgba(0,0,0,.2);
    position: relative;
}

.sidebar::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 1px;
    height: 100%;
    background: linear-gradient(to bottom, transparent, rgba(255,255,255,.08), transparent);
}

.sidebar h5 {
    font-weight: 600;
    letter-spacing: .4px;
    padding: 22px 20px;
    border-bottom: 1px solid #1e293b;
}

.sidebar a {
    color: #cbd5f5;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 22px;
    font-size: 14px;
    border-left: 3px solid transparent;
    transition: all .25s ease;
}

.sidebar a i {
    font-size: 16px;
}

.sidebar a:hover {
    background: rgba(255,255,255,.05);
    padding-left: 28px;
}

.sidebar a.active {
    background: var(--primary-soft);
    border-left-color: var(--primary);
    color: #ffffff;
}

/* =====================
   HEADER
===================== */
.header {
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid #e5e7eb;
    padding: 18px 28px;
    box-shadow: 0 8px 24px rgba(15,23,42,.04);
}

.header h5 {
    font-weight: 600;
    letter-spacing: .2px;
}

/* =====================
   CONTENT AREA
===================== */
main {
    min-height: calc(100vh - 72px);
}

/* =====================
   TICKET CARDS
===================== */
.ticket-card {
    border: none;
    border-radius: 16px;
    background: #ffffff;
    border-left: 5px solid var(--primary);
    box-shadow: 0 12px 32px rgba(15,23,42,.08);
    transition: transform .25s ease, box-shadow .25s ease;
}

.ticket-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 24px 60px rgba(15,23,42,.15);
}

.ticket-card.resolved { border-left-color: var(--success); }
.ticket-card.pending  { border-left-color: var(--warning); }
.ticket-card.open     { border-left-color: var(--danger); }

/* =====================
   BADGES
===================== */
.badge {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 500;
}

/* =====================
   BUTTONS
===================== */
.btn-primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    border: none;
    border-radius: 999px;
    padding: 8px 18px;
    font-size: 13px;
    box-shadow: 0 10px 24px rgba(37,99,235,.35);
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 16px 32px rgba(37,99,235,.45);
}

/* =====================
   MODAL FORM
===================== */
.modal-content {
    border-radius: 18px;
}

.form-header {
    display: flex;
    align-items: center;
    gap: 14px;
}

.form-header i {
    font-size: 28px;
    color: var(--primary);
}

.form-label {
    font-weight: 500;
    font-size: 14px;
    color: var(--text-muted);
}

.form-control,
.form-select {
    border-radius: 12px;
    padding: 10px 14px;
    border: 1px solid #e2e8f0;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.15rem rgba(37,99,235,.2);
}

.divider {
    height: 1px;
    background: #e5e7eb;
    margin: 24px 0;
}
</style>

</head>

<body>

<div class="container-fluid">
<div class="row">

    {{-- SIDEBAR --}}
    @include('ticket.ticket-partials.sidebar')

    {{-- MAIN --}}
    <div class="col-md-9 col-lg-10 p-0">

        {{-- HEADER --}}
        @include('ticket.ticket-partials.header', ['title' => 'Support Ticket Dashboard'])

        {{-- CONTENT --}}
        <main class="p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h6 class="fw-semibold mb-0">My Tickets</h6>
                    <small class="text-muted">Track and manage your submitted concerns</small>
                </div>

                <!-- MODAL TRIGGER -->
                <button class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#submitTicketModal">
                    <i class="bi bi-plus-circle"></i>
                    Submit Concern
                </button>
            </div>

            {{-- TICKETS --}}
            @forelse ($tickets as $ticket)

                @php
                    $cardClass = match($ticket->status) {
                        'open' => 'open',
                        'in_progress' => 'pending',
                        'resolved' => 'resolved',
                        default => 'open',
                    };

                    $badgeClass = match($ticket->status) {
                        'open' => 'bg-danger',
                        'in_progress' => 'bg-warning text-dark',
                        'resolved' => 'bg-success',
                        default => 'bg-secondary',
                    };

                    $statusLabel = match($ticket->status) {
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        default => ucfirst($ticket->status),
                    };
                @endphp

                <div class="card ticket-card {{ $cardClass }} mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong class="text-primary">{{ $ticket->ticket_no }}</strong>
                                <p class="fw-semibold mb-1">{{ $ticket->subject }}</p>
                                <p class="text-muted small mb-2">{{ $ticket->description }}</p>
                                <small class="text-muted">
                                    Department: {{ ucfirst($ticket->department) }}
                                    • Priority: {{ ucfirst($ticket->priority) }}
                                </small>
                            </div>

                            <span class="badge {{ $badgeClass }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>
                </div>

            @empty
                <div class="text-center text-muted py-5">
                    No tickets submitted yet.
                </div>
            @endforelse

        </main>
    </div>
</div>
</div>

<!-- =========================
     SUBMIT TICKET MODAL
========================= -->
<div class="modal fade" id="submitTicketModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-body p-4">

                <div class="form-header mb-3">
                    <i class="bi bi-life-preserver"></i>
                    <h5 class="mb-0 fw-semibold">Submit a Support Concern</h5>
                </div>

                <form method="POST" action="{{ route('tickets.store') }}">
                        @csrf

                        <!-- SUBJECT -->
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text"
                                   name="subject"
                                   class="form-control"
                                   placeholder="Brief summary of your concern"
                                   value="{{ old('subject') }}"
                                   required>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="mb-3">
                            <label class="form-label">Concern Details</label>
                            <textarea name="description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Explain your concern in detail"
                                      required>{{ old('description') }}</textarea>
                        </div>

                        <div class="divider"></div>

                        <!-- DEPARTMENT -->
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-select" required>
                                <option value="">Select department</option>
                                <option value="it">IT</option>
                                <option value="operations">Operations</option>
                                <option value="finance">Finance</option>
                                <option value="hr">HR</option>
                            </select>
                        </div>

                        <!-- PRIORITY -->
                        <div class="mb-4">
                            <label class="form-label">Priority Level</label>
                            <select name="priority" class="form-select" required>
                                <option value="">Select priority</option>
                                <option value="low">Low – Not urgent</option>
                                <option value="medium">Medium – Needs attention</option>
                                <option value="high">High – Urgent</option>
                            </select>
                        </div>

                        <!-- ACTIONS -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('tickets.dashboard') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>

                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-send"></i> Submit Concern
                            </button>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
