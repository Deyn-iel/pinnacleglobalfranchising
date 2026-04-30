<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Coupon Booklet {{ $booklet }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        body {
            margin: 0;
            color: #111827;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            line-height: 1.45;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #111827;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .brand {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6b7280;
            font-weight: bold;
        }

        h1 {
            margin: 4px 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .summary td {
            border: 1px solid #d1d5db;
            padding: 7px 8px;
        }

        .summary strong {
            display: block;
            font-size: 8px;
            text-transform: uppercase;
            color: #6b7280;
            letter-spacing: .5px;
        }

        .coupon-grid {
            width: 100%;
            border-collapse: collapse;
        }

        .coupon-grid td {
            width: 50%;
            padding: 5px;
            vertical-align: top;
        }

        .coupon-card {
            border: 1px solid #111827;
            border-radius: 8px;
            padding: 10px;
            min-height: 82px;
        }

        .coupon-top {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .coupon-no,
        .coupon-status {
            display: table-cell;
            font-size: 8px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: bold;
        }

        .coupon-status {
            text-align: right;
        }

        .code {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            text-align: center;
            margin: 8px 0;
        }

        .reward {
            text-align: center;
            font-weight: bold;
            font-size: 11px;
        }

        .booklet {
            text-align: center;
            color: #6b7280;
            font-size: 8px;
            margin-top: 6px;
        }

        .footer {
            margin-top: 16px;
            text-align: center;
            color: #9ca3af;
            font-size: 8px;
        }
    </style>
</head>

<body>
    @php
        $firstCoupon = $coupons->first();
        $soldCount = $coupons->where('selling_status', 'Sold')->count();
        $claimedCount = $coupons->where('claim_status', 'Claimed')->count();
    @endphp

    <div class="header">
        <div class="brand">Pinnacle Global Franchising Group Inc.</div>
        <h1>Coupon Booklet {{ $booklet }}</h1>
        <div>{{ $firstCoupon?->claimable_item ?? 'Generated Coupons' }}</div>
    </div>

    <table class="summary">
        <tr>
            <td><strong>Booklet</strong>{{ $booklet }}</td>
            <td><strong>Total Coupons</strong>{{ $coupons->count() }}</td>
            <td><strong>Sold</strong>{{ $soldCount }}</td>
            <td><strong>Claimed</strong>{{ $claimedCount }}</td>
        </tr>
    </table>

    <table class="coupon-grid">
        @foreach ($coupons->chunk(2) as $row)
            <tr>
                @foreach ($row as $coupon)
                    <td>
                        <div class="coupon-card">
                            <div class="coupon-top">
                                <span class="coupon-no">Coupon #{{ $loop->parent->iteration * 2 - (2 - $loop->iteration) }}</span>
                                <span class="coupon-status">{{ $coupon->coupon_status }}</span>
                            </div>
                            <div class="code">{{ $coupon->unique_code }}</div>
                            <div class="reward">{{ $coupon->claimable_item }}</div>
                            <div class="booklet">{{ $booklet }} · {{ $coupon->claim_status }} · {{ $coupon->selling_status }}</div>
                        </div>
                    </td>
                @endforeach

                @if ($row->count() === 1)
                    <td></td>
                @endif
            </tr>
        @endforeach
    </table>

    <div class="footer">
        Generated {{ now()->format('M d, Y h:i A') }}
    </div>
</body>

</html>
