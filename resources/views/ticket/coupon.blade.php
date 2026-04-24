<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Verify a Coupon</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite([
        'resources/css/chatbot/main-ticket.css',
        'resources/css/coupon/coupon.css',

        'resources/js/coupon/coupon.js'
    ])

</head>
<body>

@include('ticket.ticket-partials.sidebar')

<div class="app-wrapper">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content" id="mainContent">
        @include('ticket.ticket-partials.header')

        <div class="page-wrap">
            <div class="coupon-card">
                <div class="coupon-body">

                    @if(session('success'))
                        <div class="alert-custom alert-success-custom">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
<div class="alert-custom alert-danger-custom">
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

@if(!empty($verifyError))
    <div class="alert-custom alert-danger-custom">
        {{ $verifyError }}
    </div>
@endif

                    <div class="section-block">
                        <div class="section-head">
                            <h3 class="section-title">
                                <i class="fas fa-magnifying-glass"></i>
                                Verify Coupon
                            </h3>
                            <div class="section-sub">Enter the unique code to verify voucher validity</div>
                        </div>

                        <div class="soft-panel">
                            <form action="{{ route('tickets.coupon.verify') }}" method="POST">
                                @csrf
                                <div class="form-grid">
                                    <div class="form-group col-6">
                                        <label>Input Unique Code</label>
                                        <input
                                            type="text"
                                            name="unique_code"
                                            value="{{ old('unique_code') }}"
                                            placeholder="Enter 8-character coupon code"
                                            style="text-transform:uppercase;"
                                            maxlength="8"
                                            required>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>Verified Reward</label>
                                        <input
                                            type="text"
                                            class="readonly-input"
                                            value="{{ $coupon?->claimable_item ?? '' }}"
                                            placeholder="Reward will appear here"
                                            readonly>
                                    </div>
                                </div>

                                <div class="action-wrap">
                                    <button type="submit" class="btn-modern btn-primary-modern">
                                        <i class="fas fa-search"></i> Verify
                                    </button>

                                    <a href="{{ route('tickets.coupon') }}" class="btn-modern btn-light-modern">
                                        <i class="fas fa-rotate-left"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($coupon)
                    <div class="section-block">
                        <div class="section-head">
                            <h3 class="section-title">
                                <i class="fas fa-circle-check"></i>
                                Coupon Status
                            </h3>
                            <div class="section-sub">Review coupon details before claiming</div>
                        </div>

                        <div class="soft-panel blue">
                            <div class="status-grid">
                                <div class="mini-stat">
                                    <div class="mini-stat-label">Code</div>
                                    <div class="mini-stat-value">{{ $coupon->unique_code }}</div>
                                </div>
                                <div class="mini-stat">
                                    <div class="mini-stat-label">Claim Status</div>
                                    <div class="mini-stat-value">{{ $coupon->claim_status }}</div>
                                </div>
                                <div class="mini-stat">
                                    <div class="mini-stat-label">Selling Status</div>
                                    <div class="mini-stat-value">{{ $coupon->selling_status }}</div>
                                </div>
                            </div>

                            <form action="{{ route('tickets.coupon.claim') }}" method="POST">
                                @csrf
                                <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">

                                <div class="form-grid">
                                        <div class="form-group col-4">
                                            <label>Reward</label>
                                            <input type="text" class="readonly-input" value="{{ $coupon->claimable_item }}" readonly>
                                        </div>


                                        <div class="form-group col-4">
                                            <label>Selling Status</label>
                                            <input type="text" class="readonly-input" value="{{ $coupon->selling_status }}" readonly>
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Complete Name</label>
                                            <input type="text" name="customer_name" value="{{ old('customer_name', $coupon->buyer_name) }}" required>
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Email</label>
                                            <input type="email" name="customer_email" value="{{ old('customer_email', $coupon->buyer_email) }}" required>
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Contact Number</label>
                                            <input type="text" name="customer_contact" value="{{ old('customer_contact', $coupon->buyer_contact) }}" required>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Address</label>
                                            <input type="text" name="customer_address" value="{{ old('customer_address', $coupon->buyer_address) }}" placeholder="Enter full address" required>
                                        </div>
                                    </div>

                                <div class="action-wrap">
                                    @if($coupon->claim_status === 'Claimed')
                                        <button type="button" class="btn-modern btn-light-modern" disabled>
                                            <i class="fas fa-lock"></i> Already Claimed
                                        </button>
                                    @elseif($coupon->selling_status !== 'Sold')
                                        <button type="button" class="btn-modern btn-light-modern" disabled>
                                            <i class="fas fa-ban"></i> Not Yet Sold
                                        </button>
                                    @else
                                        <button type="submit" class="btn-modern btn-success-modern">
                                            <i class="fas fa-check"></i> Approve Claim
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    <div class="section-block report-box">
                        <div class="section-head">
                            <h3 class="section-title">
                                <i class="fas fa-chart-column"></i>
                                Recently Claimed Coupons
                            </h3>
                            <div class="section-sub">Latest successful voucher claims</div>
                        </div>

                        <div class="table-shell">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Reward</th>
                                        <th>Status</th>
                                        <th>Claimed At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($claimedCoupons as $claimed)
                                        <tr>
                                           <td>{{ $claimed->buyer_name ?? '—' }}</td>
                                        <td>{{ $claimed->claimable_item }}</td>
                                        
                                        <td>
                                            <span class="badge-modern badge-claimed">
                                                {{ $claimed->claim_status }}
                                            </span>
                                        </td>
                                        <td>{{ $claimed->claimed_at?->format('M d, Y • h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align:center; color:#94a3b8 !important; padding:20px;">
                                                 No claimed coupons yet.
                                            </td>   
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>


</body>
</html>