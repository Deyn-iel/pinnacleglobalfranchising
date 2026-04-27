<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Submit Support Concern</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css" rel="stylesheet">

    <style>
        /* =========================
   EMPRESS DESIGN SYSTEM
========================= */
        body {
            background: linear-gradient(135deg, #eef2f7, #f8fafc);
            font-family: 'Inter', system-ui, sans-serif;
        }

        .card {
            border: none;
            border-radius: 16px;
        }

        .card-body {
            padding: 32px;
        }

        /* Header */
        .form-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .form-header i {
            font-size: 28px;
            color: #0d6efd;
        }

        .form-header h5 {
            margin: 0;
            font-weight: 600;
        }

        /* Labels */
        .form-label {
            font-weight: 500;
            font-size: 14px;
            color: #475569;
        }

        /* Inputs */
        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .15);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #2563eb);
            border: none;
            border-radius: 999px;
            padding: 8px 18px;
            font-size: 14px;
        }

        .btn-secondary {
            border-radius: 999px;
            font-size: 14px;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 20px 0;
        }

        /* Footer note */
        .form-note {
            font-size: 12px;
            color: #64748b;
        }

        /* Subtle animation */
        .card {
            animation: fadeUp .4s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">

                <div class="card shadow-sm">
                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="form-header">
                            <i class="bi bi-life-preserver"></i>
                            <h5>Submit a Support Concern</h5>
                        </div>

                        <p class="form-note mb-4">
                            Please provide complete and accurate details so we can assist you faster.
                        </p>

                        {{-- ERRORS --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tickets.store') }}">
                            @csrf

                            <!-- SUBJECT -->
                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control"
                                    placeholder="Brief summary of your concern" value="{{ old('subject') }}" required>
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="mb-3">
                                <label class="form-label">Concern Details</label>
                                <textarea name="description" rows="4" class="form-control" placeholder="Explain your concern in detail" required>{{ old('description') }}</textarea>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
