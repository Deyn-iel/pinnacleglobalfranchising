<!-- resources/views/admin/coupon/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Coupons</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/admin/app.css'])

    <style>
        :root {
            --bg: #f5f7fb;
            --card: #ffffff;
            --line: #e6ebf2;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #0d6efd;
            --success: #198754;
            --warning: #f59e0b;
            --danger: #dc3545;
            --soft-blue: #eef5ff;
            --soft-green: #eaf8f0;
            --soft-yellow: #fff7df;
            --soft-red: #ffe9ec;
            --shadow: 0 14px 35px rgba(15, 23, 42, .06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        .admin-page {
            margin-left: 270px;
            width: calc(100% - 270px);
            max-width: 100%;
            padding: clamp(16px, 2vw, 32px);
            min-height: 100vh;
        }

        .page-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 22px;
        }

        .page-title {
            font-size: clamp(24px, 2.2vw, 34px);
            font-weight: 800;
            line-height: 1.15;
            display: flex;
            align-items: center;
            gap: 14px;
            letter-spacing: -0.4px;
        }

        .page-subtitle {
            margin-top: 10px;
            font-size: clamp(13px, 1vw, 15px);
            color: var(--muted);
            max-width: 900px;
            line-height: 1.6;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: clamp(14px, 1.5vw, 22px);
            width: 100%;
        }

        .col-12 {
            grid-column: span 12;
        }

        .col-6 {
            grid-column: span 6;
        }

        .col-4 {
            grid-column: span 4;
        }

        .col-3 {
            grid-column: span 3;
        }

        .card-box {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: clamp(16px, 1.5vw, 22px);
            box-shadow: var(--shadow);
            padding: clamp(16px, 1.7vw, 24px);
            width: 100%;
            min-width: 0;
        }

        .card-title {
            font-size: clamp(20px, 2vw, 30px);
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .card-subtitle {
            font-size: clamp(13px, 1vw, 15px);
            color: var(--muted);
            margin-bottom: 22px;
            line-height: 1.6;
        }

        .form-group {
            min-width: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: 800;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            border: 1px solid #d7dfeb;
            border-radius: 14px;
            padding: 0 16px;
            background: #fff;
            font-size: 15px;
            outline: none;
            transition: .2s ease;
            min-width: 0;
        }

        .form-group input,
        .form-group select {
            height: 54px;
        }

        .form-group textarea {
            min-height: 120px;
            padding: 15px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, .08);
        }

        .btn-wrap {
            margin-top: 22px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-custom {
            border: none;
            border-radius: 14px;
            padding: 14px 22px;
            min-height: 52px;
            font-size: 15px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
            white-space: nowrap;
        }

        .btn-custom:hover {
            transform: translateY(-1px);
        }

        .btn-custom:disabled {
            opacity: .7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
        }

        .btn-success-custom {
            background: var(--success);
            color: #fff;
        }

        .btn-warning-custom {
            background: var(--warning);
            color: #fff;
        }

        .btn-danger-custom {
            background: var(--danger);
            color: #fff;
        }

        .btn-light-custom {
            background: #fff;
            border: 1px solid var(--line);
            color: var(--text);
        }

        .alert {
            border: none;
            border-radius: 16px;
            padding: 15px 18px;
            margin-bottom: 18px;
            font-size: 15px;
            font-weight: 700;
        }

        .alert-success {
            background: #eaf8f0;
            color: #146c43;
        }

        .alert-danger {
            background: #ffe9ec;
            color: #b42318;
        }

        .alert-hide {
            opacity: 0;
            transition: opacity .5s ease;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: clamp(14px, 1.4vw, 20px);
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: clamp(16px, 1.5vw, 22px);
            box-shadow: var(--shadow);
            min-width: 0;
        }

        .stat-label {
            font-size: 13px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: clamp(30px, 3vw, 42px);
            font-weight: 800;
            line-height: 1;
        }

        .table-wrap {
            width: 100%;
            max-width: 100%;
            overflow-x: visible;
            overflow-y: visible;
            border: 1px solid var(--line);
            border-radius: 18px;
        }

        .table-wrap table {
            width: 100%;
            min-width: 0;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 14px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 800;
            color: #334155;
            white-space: normal;
            overflow-wrap: anywhere;
            border-bottom: 1px solid var(--line);
        }

        td {
            padding: 14px 12px;
            font-size: 13px;
            border-bottom: 1px solid #edf1f6;
            vertical-align: top;
            line-height: 1.5;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        tbody tr:hover {
            background: #fafcff;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 10%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 10%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 14%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 8%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 9%;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 9%;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 15%;
        }

        th:nth-child(8),
        td:nth-child(8) {
            width: 8%;
        }

        th:nth-child(9),
        td:nth-child(9) {
            width: 9%;
        }

        th:nth-child(10),
        td:nth-child(10) {
            width: 8%;
            text-align: center;
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .badge-success {
            background: var(--soft-green);
            color: var(--success);
        }

        .badge-warning {
            background: var(--soft-yellow);
            color: #9a6700;
        }

        .badge-primary {
            background: var(--soft-blue);
            color: var(--primary);
        }

        .badge-danger {
            background: var(--soft-red);
            color: var(--danger);
        }

        .reward-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 14px;
        }

        .reward-item {
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 16px;
            background: #fff;
            font-size: 15px;
            font-weight: 700;
            min-width: 0;
        }

        .reward-item small {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
        }

        .inline-code {
            display: inline-block;
            max-width: 100%;
            padding: 8px 12px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid var(--line);
            font-family: monospace;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .3px;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .section-note {
            background: #f8fafc;
            border: 1px dashed #d7dfeb;
            border-radius: 14px;
            padding: 15px;
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
        }

        .modal-content {
            border: 0;
            border-radius: 22px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .20);
        }

        .modal-header,
        .modal-footer {
            border-color: var(--line);
            padding: 18px 22px;
        }

        .modal-body {
            padding: 22px;
        }

        .modal-title {
            font-weight: 800;
        }

        .modal-code {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 18px;
        }

        @keyframes spinIcon {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @media (min-width: 1600px) {
            .admin-page {
                padding: 34px;
            }

            .table-wrap table {
                min-width: 100%;
            }

            th,
            td {
                padding: 16px;
                font-size: 14px;
            }
        }

        @media (max-width: 1399.98px) {
            .admin-page {
                margin-left: 260px;
                width: calc(100% - 260px);
            }

            th,
            td {
                padding: 11px 9px;
                font-size: 12px;
            }

            .badge-pill {
                padding: 6px 9px;
                font-size: 11px;
            }

            .table-action-menu {
                min-width: 150px;
            }
        }

        @media (max-width: 1199.98px) {
            .admin-page {
                margin-left: 240px;
                width: calc(100% - 240px);
                padding: 20px;
            }

            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .col-4 {
                grid-column: span 6;
            }

            th,
            td {
                padding: 10px 8px;
                font-size: 11.5px;
            }

            .inline-code {
                padding: 6px 8px;
                font-size: 11.5px;
            }

            .btn-custom {
                padding: 10px 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 991.98px) {
            .admin-page {
                margin-left: 0;
                width: 100%;
                padding: 18px;
            }

            .page-top {
                flex-direction: column;
                gap: 12px;
            }

            .col-6,
            .col-4,
            .col-3 {
                grid-column: span 12;
            }

            .modal-dialog {
                margin: 12px;
            }
        }

        @media (max-width: 768px) {
            .admin-page {
                padding: 12px;
            }

            .stat-grid {
                grid-template-columns: 1fr;
                margin-bottom: 16px;
            }

            .form-group input,
            .form-group select {
                height: 48px;
            }

            .btn-wrap,
            .modal-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                min-height: 48px;
            }

            th,
            td {
                padding: 12px 10px;
            }

            .modal-code {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .admin-page {
                padding: 10px;
            }

            .card-box {
                padding: 14px;
            }
        }
    </style>
</head>

<body>
    @include('admin-sidebar.navbar')
    @include('admin-sidebar.sidebar')

    <div class="admin-page">

        <div class="page-top">
            <div>
                <div class="page-title">
                    <i class="fas fa-tags"></i> Register Coupons
                </div>
                <div class="page-subtitle">
                    Generate coupon codes first, then assign a code to the buyer once it is purchased. Upper management
                    will handle coupon verification and claiming.
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $totalCoupons = $couponStats['total'] ?? 0;
            $soldCoupons = $couponStats['sold'] ?? 0;
            $claimedCoupons = $couponStats['claimed'] ?? 0;
            $activeCoupons = $couponStats['active'] ?? 0;

            $codedRewards = collect($rewardTypes)->where('requires_code', true);
            $freeRewards = collect($rewardTypes)->where('requires_code', false);
        @endphp

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-label">Total Coupons</div>
                <div class="stat-value">{{ $totalCoupons }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Sold</div>
                <div class="stat-value">{{ $soldCoupons }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Claimed</div>
                <div class="stat-value">{{ $claimedCoupons }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Active</div>
                <div class="stat-value">{{ $activeCoupons }}</div>
            </div>
        </div>

        <div class="grid">

            <!-- COUPON GENERATOR -->
            <div class="col-12">
                <div class="card-box">
                    <div class="card-title">
                        <i class="fas fa-barcode"></i>
                        Coupon Generator
                    </div>
                    <div class="card-subtitle">
                        Generate coupon codes for inventory. Buyer details are registered later when a code is
                        purchased.
                    </div>

                    <form action="{{ route('admin.coupons.store') }}" method="POST">
                        @csrf

                        <div class="grid">
                            <div class="form-group col-4">
                                <label>Booklet</label>
                                <input type="text" value="Auto-generated" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label>How Many Coupons?</label>
                                <input type="number" name="quantity" min="1" max="500"
                                    value="{{ old('quantity', 1) }}" required>
                            </div>



                            <div class="form-group col-4">
                                <label>Coupon Status</label>
                                <select name="coupon_status" required>
                                    <option value="Active"
                                        {{ old('coupon_status', 'Active') == 'Active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="Inactive"
                                        {{ old('coupon_status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label>Generated Code Format & Reward</label>
                                <div class="inline-code">
                                    AUTO-GENERATED - 8 CHARACTERS - RANDOM REWARD PER COUPON
                                </div>
                            </div>

                            <input type="hidden" name="requires_code" id="requires_code" value="1">
                        </div>

                        <div class="btn-wrap">
                            <button type="submit" class="btn-custom btn-primary-custom">
                                <i class="fas fa-wand-magic-sparkles"></i> Generate Coupons
                            </button>
                        </div>
                    </form>
                </div>
            </div>



            <!-- MASTER LIST -->
            <div class="col-12">
                <div class="card-box">
                    <div class="card-title">
                        <i class="fas fa-table-list"></i>
                        Master List of Generated Coupons
                    </div>
                    <div class="card-subtitle">
                        Only rewards with coupon codes will appear here.
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Booklet Serial</th>
                                    <th>Unique Code</th>
                                    <th>Claimable Item</th>
                                    <th>Coupon Status</th>
                                    <th>Claim Status</th>
                                    <th>Selling Status</th>
                                    <th>Buyer Details</th>
                                    <th>Paid Amount</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->booklet_serial_number ?? '—' }}</td>
                                        <td>
                                            <span class="inline-code">
                                                {{ $coupon->unique_code }}
                                            </span>
                                        </td>
                                        <td>{{ $coupon->claimable_item }}</td>
                                        <td>
                                            <span
                                                class="badge-pill {{ $coupon->coupon_status === 'Active' ? 'badge-primary' : 'badge-danger' }}">
                                                {{ $coupon->coupon_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge-pill {{ $coupon->claim_status === 'Claimed' ? 'badge-success' : 'badge-warning' }}">
                                                {{ $coupon->claim_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge-pill {{ $coupon->selling_status === 'Sold' ? 'badge-success' : 'badge-primary' }}">
                                                {{ $coupon->selling_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <strong>{{ $coupon->buyer_name ?? '—' }}</strong><br>
                                            <small>{{ $coupon->buyer_address ?? '—' }}</small><br>
                                            <small>{{ $coupon->buyer_email ?? '—' }}</small><br>
                                            <small>{{ $coupon->buyer_contact ?? '—' }}</small>
                                        </td>
                                        <td>
                                            <strong>PHP {{ number_format((float) $coupon->amount, 2) }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $coupon->mode_of_payment ?? '—' }}</strong><br>
                                            <small>{{ $coupon->payment_reference ?? '—' }}</small>
                                        </td>
                                        <td>
                                            @if ($coupon->selling_status !== 'Sold')
                                                <button type="button" class="btn-custom btn-success-custom"
                                                    style="padding:14px;font-size:13px;" data-bs-toggle="modal"
                                                    data-bs-target="#assignBuyerModal{{ $coupon->id }}">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                            @else
                                                <span class="badge-pill badge-success">Sold</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">No generated coupons found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($coupons->hasPages())
                        <div class="mt-4">
                            {{ $coupons->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- AVAILABLE CODED REWARDS -->
            <div class="col-12">
                <div class="card-box">
                    <div class="card-title">
                        <i class="fas fa-tags"></i>
                        Rewards That Require Coupon Codes
                    </div>

                    <div class="reward-list">
                        @foreach ($codedRewards as $reward)
                            <div class="reward-item">
                                {{ $reward['name'] }}
                                <small>Auto-Generated Code Required</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- FREE REWARDS -->
            <div class="col-12">
                <div class="card-box">
                    <div class="card-title">
                        <i class="fas fa-gift"></i>
                        Free Rewards (No Code Required)
                    </div>
                    <div class="card-subtitle">
                        These rewards do not need a coupon code. They are manually granted by admin.
                    </div>

                    <div class="section-note">
                        Examples:
                        <strong>Free Shuttle to Nearest Store</strong>,
                        <strong>Free Kit</strong>,
                        <strong>Isabela Coffee</strong>
                    </div>

                    <div class="reward-list mt-3">
                        @foreach ($freeRewards as $reward)
                            <div class="reward-item">
                                {{ $reward['name'] }}
                                <small>No Code Required</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>

    @foreach ($coupons as $coupon)
        @continue($coupon->selling_status === 'Sold')
        <div class="modal fade" id="assignBuyerModal{{ $coupon->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form action="{{ route('admin.coupons.tagSold', $coupon->id) }}" method="POST"
                        class="assign-buyer-form">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-user-plus me-2"></i>Register Coupon Buyer
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="modal-code">
                                <div>
                                    <div class="stat-label mb-1">Coupon Code</div>
                                    <span class="inline-code">{{ $coupon->unique_code }}</span>
                                </div>
                                <div>
                                    <div class="stat-label mb-1">Reward</div>
                                    <strong>{{ $coupon->claimable_item }}</strong>
                                </div>
                            </div>

                            <div class="grid">
                                <div class="form-group col-6">
                                    <label>Buyer Name</label>
                                    <input type="text" name="buyer_name" required>
                                </div>

                                <div class="form-group col-6">
                                    <label>Buyer Email</label>
                                    <input type="email" name="buyer_email" required>
                                </div>

                                <div class="form-group col-6">
                                    <label>Buyer Contact</label>
                                    <input type="text" name="buyer_contact" required>
                                </div>

                                <div class="form-group col-6">
                                    <label>Paid Amount</label>
                                    <input type="number" name="amount" min="0" step="0.01">
                                </div>

                                <div class="form-group col-6">
                                    <label>Mode of Payment</label>
                                    <select name="mode_of_payment">
                                        <option value="">Select Payment</option>
                                        <option value="Cash">Cash</option>
                                        <option value="GCash">GCash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Card">Card</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label>Payment Reference</label>
                                    <input type="text" name="payment_reference"
                                        placeholder="Receipt / transaction no.">
                                </div>

                                <div class="form-group col-12">
                                    <label>Buyer Address</label>
                                    <input type="text" name="buyer_address" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-custom btn-light-custom" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn-custom btn-success-custom">
                                <i class="fas fa-check"></i> Save Buyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* auto fade success + danger alerts */
            const alerts = document.querySelectorAll('.alert-success, .alert-danger');

            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('alert-hide');

                    setTimeout(() => {
                        alert.remove();
                    }, 500);

                }, 3000);
            });

            /* keep hidden value */
            const requiresCode = document.getElementById('requires_code');
            if (requiresCode) {
                requiresCode.value = 1;
            }

            /* loading animation for coupon generation */
            const generateForm = document.querySelector('form[action*="coupons"]');

            if (generateForm) {
                generateForm.addEventListener('submit', function() {

                    const btn = generateForm.querySelector('button[type="submit"]');

                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML = '<i class="fa-solid fa-arrows-rotate fa-spin"></i> Generating...';
                    }

                });
            }

            document.querySelectorAll('.assign-buyer-form').forEach(form => {
                form.addEventListener('submit', function() {
                    const btn = form.querySelector('button[type="submit"]');

                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML =
                            '<i class="fa-solid fa-arrows-rotate fa-spin"></i> Saving...';
                    }
                });
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
