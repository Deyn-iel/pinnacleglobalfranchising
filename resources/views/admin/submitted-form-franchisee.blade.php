<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Franchise Reservations</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/admin/shadcn-tables.css'])

    <style>
        body {
            background: #f8fafc;
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
        }

        .main {
            margin-left: 260px;
            padding: 30px;
        }

        .page-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            border: 1px solid #eef2f6;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .page-header h3 {
            font-weight: 800;
            margin: 0;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        thead th {
            background: #f1f5f9;
            color: #64748b;
            text-transform: uppercase;
            font-size: 12px;
            border: none !important;
            padding: 12px;
        }

        tbody tr {
            background: #ffffff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }

        tbody td {
            padding: 13px;
            border: none !important;
            vertical-align: middle;
        }

        .badge-soft {
            background: #eff6ff;
            color: #2563eb;
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 700;
        }

        .package-item {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 8px;
        }

        .detail-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
        }

        .detail-value {
            font-weight: 600;
            color: #111827;
        }

        .action-menu-wrap {
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .action-menu-toggle {
            width: 38px;
            height: 38px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            color: #111827;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .08);
        }

        .action-menu-toggle:hover,
        .action-menu-toggle.show {
            background: #111827;
            border-color: #111827;
            color: #fff;
        }

        .action-menu {
            min-width: 145px;
            padding: 8px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 18px 42px rgba(15, 23, 42, .14);
        }

        .action-menu.show {
            margin-top: 8px !important;
        }

        .action-menu .btn {
            width: 100%;
            min-height: 36px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            border-radius: 10px;
            font-weight: 800;
        }

        @media(max-width: 768px) {
            .main {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

@include('admin.headoffice-portals.od.partials.sidebar')

<div class="main">
    <div class="container-fluid">

        <div class="page-card">

            <div class="page-header">
                <div>
                    <h3>
                        <i class="fa-solid fa-file-signature"></i>
                        Submitted Franchise Reservations
                    </h3>
                    <small class="text-muted">
                        List of all submitted ANNEX A Franchise Reservation Forms
                    </small>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.portals.od') }}" class="btn btn-light border">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to OD Dashboard
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Applicant</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Total Availed</th>
                            <th>Payment</th>
                            <th>Date Submitted</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>

                                <td>
                                    <strong>{{ $reservation->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $reservation->email ?? 'No email' }}</small>
                                </td>

                                <td>{{ $reservation->contact ?? 'N/A' }}</td>

                                <td>
                                    @if($reservation->location_tba)
                                        <span class="badge bg-warning text-dark">TBA</span>
                                    @endif

                                    {{ $reservation->location ?? 'N/A' }}
                                </td>

                                <td>
                                    <span class="badge-soft">
                                        {{ $reservation->total }} franchise/s
                                    </span>
                                </td>

                                <td>
                                    <strong>{{ $reservation->payment_mode ?? 'N/A' }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        ₱{{ number_format($reservation->fee ?? 0, 2) }}
                                    </small>
                                </td>

                                <td>
                                    {{ $reservation->created_at ? $reservation->created_at->format('M d, Y h:i A') : 'N/A' }}
                                </td>

                                <td>
                                    <div class="dropdown action-menu-wrap">
                                        <button class="action-menu-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" aria-label="Open actions">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end action-menu">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#reservationModal{{ $reservation->id }}"
                                            >
                                                <i class="fa-solid fa-eye"></i>
                                                View
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class="fa-solid fa-folder-open fa-2x mb-2"></i>
                                    <br>
                                    No submitted franchise reservations yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $reservations->links() }}
            </div>

        </div>

    </div>
</div>

@foreach($reservations as $reservation)
    <div class="modal fade" id="reservationModal{{ $reservation->id }}" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        ANNEX A - Franchise Reservation Form #{{ $reservation->id }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="detail-label">Reservation Date</div>
                            <div class="detail-value">
                                {{ $reservation->reservation_date ? $reservation->reservation_date->format('M d, Y') : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Submitted Date</div>
                            <div class="detail-value">
                                {{ $reservation->created_at ? $reservation->created_at->format('M d, Y h:i A') : 'N/A' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Total Franchise Availed</div>
                            <div class="detail-value">
                                {{ $reservation->total }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">I. Franchise Applicant Information</h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="detail-label">Full Name</div>
                            <div class="detail-value">{{ $reservation->name }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-label">Contact Number</div>
                            <div class="detail-value">{{ $reservation->contact ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-12">
                            <div class="detail-label">Residential Address</div>
                            <div class="detail-value">{{ $reservation->address ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-label">Email Address</div>
                            <div class="detail-value">{{ $reservation->email ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">II. Reserved Franchise Package</h6>

                    @forelse(($reservation->packages ?? []) as $package)
                        <div class="package-item">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <div>
                                    <strong>{{ $package['label'] ?? 'Package' }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        Price:
                                        @if(isset($package['price']) && $package['price'])
                                            ₱{{ number_format($package['price'], 2) }}
                                        @else
                                            N/A
                                        @endif
                                    </small>
                                </div>

                                <div>
                                    <span class="badge bg-primary">
                                        {{ $package['count'] ?? 0 }} availed
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No package selected.</p>
                    @endforelse

                    <div class="row g-3 mt-2 mb-4">
                        <div class="col-md-8">
                            <div class="detail-label">Preferred Location</div>
                            <div class="detail-value">
                                {{ $reservation->location ?? 'N/A' }}

                                @if($reservation->location_tba)
                                    <span class="badge bg-warning text-dark ms-1">TBA</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Total Number Availed</div>
                            <div class="detail-value">{{ $reservation->total }}</div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">IV. Payment Details</h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="detail-label">Reservation Fee Paid</div>
                            <div class="detail-value">
                                ₱{{ number_format($reservation->fee ?? 0, 2) }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Mode of Payment</div>
                            <div class="detail-value">{{ $reservation->payment_mode ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Check No.</div>
                            <div class="detail-value">{{ $reservation->check_no ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-label">Payee</div>
                            <div class="detail-value">{{ $reservation->payee }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-label">Bank</div>
                            <div class="detail-value">{{ $reservation->bank }}</div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">V. Declaration</h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <div class="detail-label">Franchisee Complete Name & Signature</div>
                            <div class="detail-value">{{ $reservation->signature ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Signature Date</div>
                            <div class="detail-value">
                                {{ $reservation->signature_date ? $reservation->signature_date->format('M d, Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">F. For Kape-Ilokano Use Only</h6>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="detail-label">Official Receipt No.</div>
                            <div class="detail-value">{{ $reservation->official_receipt_no ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Receipt Issued By</div>
                            <div class="detail-value">{{ $reservation->receipt_issued_by ?? 'N/A' }}</div>
                            <small class="text-muted">
                                Date:
                                {{ $reservation->receipt_issued_date ? $reservation->receipt_issued_date->format('M d, Y') : 'N/A' }}
                            </small>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Reviewed By</div>
                            <div class="detail-value">{{ $reservation->reviewed_by ?? 'N/A' }}</div>
                            <small class="text-muted">
                                Date:
                                {{ $reservation->reviewed_date ? $reservation->reviewed_date->format('M d, Y') : 'N/A' }}
                            </small>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Endorsed By</div>
                            <div class="detail-value">{{ $reservation->endorsed_by ?? 'N/A' }}</div>
                            <small class="text-muted">
                                Date:
                                {{ $reservation->endorsed_date ? $reservation->endorsed_date->format('M d, Y') : 'N/A' }}
                            </small>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

