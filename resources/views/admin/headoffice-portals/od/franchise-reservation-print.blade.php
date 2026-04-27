<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ANNEX A - Franchise Reservation Form</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 8mm;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #111827;
            font-size: 8.5px;
            line-height: 1.35;
        }

        body.web-mode {
            background: #e5e7eb;
        }

        body.pdf-mode {
            background: #ffffff;
        }

        .toolbar {
            max-width: 210mm;
            margin: 12px auto;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }


        .logo {
            width: 130px;
            height: auto;
            position: absolute;
            left: 10mm;
        }

        .title {
            display: flex;
            align-items: center;
            position: relative;
            justify-content: center;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 20px 10mm 10px;
        }

        .toolbar a,
        .toolbar button {
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
            background: #2563eb;
        }

        .toolbar .back {
            background: #6b7280;
        }

        .paper {
            background: #ffffff;
        }

        body.web-mode .paper {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 9mm 10mm;
        }

        body.pdf-mode .paper {
            width: auto;
            min-height: 0;
            margin: 0;
            padding: 20px;
            overflow: visible;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .date-row {
            text-align: right;
            margin-bottom: 9px;
        }

        .section-title {
            font-weight: bold;
            font-size: 10.8px;
            margin-top: 9px;
            margin-bottom: 6px;
            text-transform: uppercase;
            border-bottom: 1px solid #111827;
            padding-bottom: 3px;
        }

        .line-row {
            font-size: 10.8px;
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .line {
            border-bottom: 1px solid #111827;
            min-height: 15px;
            padding: 1px 4px 2px;
        }

        .two-col {
            width: 100%;
            font-size: 10.8px;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 2px;
        }

        .two-col td {
            width: 50%;
            vertical-align: top;
            padding-right: 10px;
        }

        .package-table {
            width: 100%;
            font-size: 10.8px;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 3px;
        }

        .package-table td {
            padding: 2.5px 2px;
            vertical-align: middle;
        }

        .package-left {
            width: 54%;
        }

        .package-right {
            width: 46%;
            text-align: right;
            white-space: nowrap;
        }

        .box {
            display: inline-block;
            width: 9px;
            height: 9px;
            border: 1px solid #111827;
            text-align: center;
            line-height: 8px;
            font-size: 7px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .small-line {
            display: inline-block;
            min-width: 35px;
            border-bottom: 1px solid #111827;
            text-align: center;
            min-height: 12px;
            padding: 0 3px;
        }

        .location-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 6px;
        }

        .location-table td {
            vertical-align: bottom;
            padding: 2px;
        }

        .terms {
            font-size: 10.8px;
            margin: 0;
            padding-left: 15px;
        }

        .terms li {
            margin-bottom: 2.5px;
        }

        .doc-list {
            margin-top: 2px;
            margin-bottom: 0;
            padding-left: 14px;
        }

        .doc-list li {
            margin-bottom: 1.3px;
        }

        .payment-line {
            margin-bottom: 4px;
            font-size: 10px;
        }

        .payment-options {
            margin: 3px 0 5px;
            white-space: nowrap;
        }

        .signature-table {
            width: 100%;
            font-size: 10.8px;
            margin-top: 15px;
            border-collapse: collapse;
            table-layout: fixed;
            page-break-inside: avoid;
        }

        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            padding: 0 10px;
        }

        .signature-name {
            width: 70%;
        }

        .signature-date {
            width: 30%;
        }

        .sig-line {
            border-bottom: 1px solid #111827;
            min-height: 16px;
            margin: 0 auto 3px;
            width: 90%;
            padding: 0 3px;
        }

        .dash-divider {
            border-top: 1px dashed #111827;
            margin: 12px 0 9px;
            page-break-after: avoid;
        }

        .office-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 7px;
            page-break-after: avoid;
        }

        .office-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 12px;
            page-break-inside: avoid;
        }

        .office-table td {
            width: 33.333%;
            text-align: center;
            vertical-align: top;
            padding: 0 8px;
        }

        .office-line {
            border-bottom: 1px solid #111827;
            min-height: 14px;
            margin-bottom: 3px;
            padding: 0 3px;
        }

        .muted {
            color: #374151;
            font-weight: normal;
        }

        .no-break {
            page-break-inside: avoid;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 8mm;
            }

            body {
                background: #ffffff !important;
            }

            .toolbar {
                display: none;
            }

            .paper {
                width: auto !important;
                min-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                overflow: visible !important;
            }
        }
    </style>
</head>

<body class="{{ $pdfMode ?? false ? 'pdf-mode' : 'web-mode' }}">

    @php
        $packageCounts = $reservation->package_counts ?? [];
        $selectedKeys = collect($reservation->packages ?? [])
            ->pluck('key')
            ->toArray();

        $checkedBox = function ($key) use ($selectedKeys) {
            return in_array($key, $selectedKeys) ? 'X' : '';
        };

        $packageCountValue = function ($key) use ($packageCounts) {
            return isset($packageCounts[$key]) && $packageCounts[$key] > 0 ? $packageCounts[$key] : '';
        };

        $paymentChecked = function ($mode) use ($reservation) {
            return $reservation->payment_mode === $mode ? 'X' : '';
        };
    @endphp

    @if (!($pdfMode ?? false))
        <div class="toolbar">
            <a class="back" href="{{ route('admin.portals.od.register-franchise') }}">
                Back
            </a>

            <button type="button" onclick="window.print()">
                Print A4
            </button>

            <a href="{{ route('admin.portals.od.register-franchise.pdf', $reservation->id) }}">
                Download PDF
            </a>
        </div>
    @endif

    <div class="paper">

        <div class="title">
            <img class="logo" src="{{ asset('img/PNG.png') }}" alt="Kape Ilokano">
            Franchise Reservation Form
        </div>


        <div class="date-row">
            <strong>DATE:</strong>
            <span class="small-line" style="min-width: 75px;">
                {{ $reservation->reservation_date ? $reservation->reservation_date->format('m/d/Y') : '' }}
            </span>
        </div>
        <div class="section-title">
            I. Franchise Applicant Information
        </div>

        <div class="line-row">
            <div class="label">Full Name of Applicant:</div>
            <div class="line">{{ $reservation->name }}</div>
        </div>

        <div class="line-row">
            <div class="label">Residential Address:</div>
            <div class="line">{{ $reservation->address }}</div>
        </div>

        <table class="two-col">
            <tr>
                <td>
                    <div class="label">Contact Number:</div>
                    <div class="line">{{ $reservation->contact }}</div>
                </td>

                <td>
                    <div class="label">Email Address:</div>
                    <div class="line">{{ $reservation->email }}</div>
                </td>
            </tr>
        </table>

        <div class="section-title">
            II. Reserved Franchise Package
        </div>

        <table class="package-table">
            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('kiosk') }}</span>
                    Kiosk - 150k
                </td>
                <td class="package-right">
                    Number of Franchise Availed:
                    <span class="small-line">{{ $packageCountValue('kiosk') }}</span>
                </td>
            </tr>

            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('inline_cafe') }}</span>
                    In-Line Café
                </td>
                <td class="package-right"></td>
            </tr>

            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('small') }}</span>
                    Small - 45sqm to 74sqm - 350k
                </td>
                <td class="package-right">
                    Number of Franchise Availed:
                    <span class="small-line">{{ $packageCountValue('small') }}</span>
                </td>
            </tr>

            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('medium') }}</span>
                    Medium - 75sqm to 100sqm - 500k
                </td>
                <td class="package-right">
                    Number of Franchise Availed:
                    <span class="small-line">{{ $packageCountValue('medium') }}</span>
                </td>
            </tr>

            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('large') }}</span>
                    Large - 100sqm and up sqm - 750k
                </td>
                <td class="package-right">
                    Number of Franchise Availed:
                    <span class="small-line">{{ $packageCountValue('large') }}</span>
                </td>
            </tr>

            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('sitdown') }}</span>
                    Sit-Down Café - 150k
                </td>
                <td class="package-right">
                    Number of Franchise Availed:
                    <span class="small-line">{{ $packageCountValue('sitdown') }}</span>
                </td>
            </tr>

            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('foodtruck') }}</span>
                    Food Truck - 150k
                </td>
                <td class="package-right"></td>
            </tr>

            <tr>
                <td class="package-left">
                    <span class="box">{{ $checkedBox('flexible') }}</span>
                    Flexible Package - (Coupon - Flat Rate 350k)
                </td>
                <td class="package-right">
                    Number of Franchise Availed:
                    <span class="small-line">{{ $packageCountValue('flexible') }}</span>
                </td>
            </tr>
        </table>

        <table class="location-table">
            <tr>
                <td style="width: 72%;">
                    <strong>Preferred Location (Municipality/Province):</strong>
                    <span class="small-line" style="min-width: 210px; text-align:left;">
                        {{ $reservation->location }}
                    </span>
                </td>

                <td style="width: 12%;">
                    <span class="box">{{ $reservation->location_tba ? 'X' : '' }}</span>
                    TBA
                </td>

                <td style="width: 16%; text-align:right;">
                    <strong>Total:</strong>
                    <span class="small-line">{{ $reservation->total }}</span>
                </td>
            </tr>
        </table>

        <div class="section-title">
            III. Reservation Terms & Conditions
        </div>

        <ol class="terms">
            <li>
                A non-refundable Reservation Fee of
                ₱{{ number_format($reservation->fee ?? 0, 2) }}
                is required to secure the franchise slot/area for a maximum period of 90 days.
            </li>
            <li>The franchise applicant is only given 90 days from the date of reservation to secure an approved
                location.</li>
            <li>Should the applicant fail to submit an approved site within the given period, Pinnacle Global
                Franchising Group Inc. reserves the right to cancel the reservation.</li>
            <li>The Reservation Fee will be credited to the Franchise Fee balance upon finalization of the Franchise
                Agreement.</li>
            <li>
                All documents required for application must be submitted prior to awarding the franchise:
                <ul class="doc-list">
                    <li>Application Form via G-Form</li>
                    <li>Letter of Intent</li>
                    <li>Duly Signed Reservation Form with attached proof of payment</li>
                    <li>Duly Approved Location Approval Request Form (LARF)</li>
                    <li>Executed Lease Contract</li>
                    <li>Government IDs and Business Name Registration</li>
                    <li>Duly Signed and Executed Franchise Package Confirmation</li>
                    <li>Duly Signed and Executed Franchise Agreement</li>
                </ul>
            </li>
        </ol>

        <div class="section-title">
            IV. Payment Details
        </div>

        <div class="payment-line">
            <strong>Reservation Fee Paid:</strong>
            <span class="small-line" style="min-width: 90px;">
                ₱{{ $reservation->fee ? number_format($reservation->fee, 2) : '' }}
            </span>
        </div>

        <div class="payment-line">
            <strong>Mode of Payment:</strong>
        </div>

        <div class="payment-options">
            <span class="box">{{ $paymentChecked('Cash') }}</span> Cash
            &nbsp;&nbsp;
            <span class="box">{{ $paymentChecked('GCash') }}</span> Gcash
            &nbsp;&nbsp;
            <span class="box">{{ $paymentChecked('Bank Deposit') }}</span> Bank Deposit
            &nbsp;&nbsp;
            <span class="box">{{ $paymentChecked('Bank Transfer') }}</span> Bank Transfer
            &nbsp;&nbsp;
            <span class="box">{{ $paymentChecked('Check') }}</span> Check
            (No. <span class="small-line" style="min-width: 70px;">{{ $reservation->check_no }}</span>)
        </div>

        <div class="payment-line">
            <strong>Payee:</strong> {{ $reservation->payee ?? 'Pinnacle Global Franchising Group Inc.' }}
        </div>

        <div class="payment-line">
            <strong>Bank:</strong> {{ $reservation->bank ?? 'RCBC 7591-149-263' }}
        </div>

        <div class="section-title">
            V. Declaration
        </div>

        <p style="margin: 0 0 10px;">
            I hereby certify that the above details are true and correct. I understand and accept the terms and
            conditions of this franchise reservation.
        </p>

        <table class="signature-table">
            <tr>
                <td class="signature-name">
                    <div class="sig-line">{{ $reservation->signature }}</div>
                    <strong>Franchisee’s Complete Name & Signature</strong>
                </td>

                <td class="signature-date">
                    <div class="sig-line">
                        {{ $reservation->signature_date ? $reservation->signature_date->format('m/d/Y') : '' }}
                    </div>
                    <strong>Date</strong>
                </td>
            </tr>
        </table>

        <div class="dash-divider"></div>

        <div class="office-title">
            F. FOR KAPE-ILOKANO USE ONLY
            <span class="muted">(Do not fill out this portion)</span>
        </div>

        <div class="payment-line">
            <strong>Official Receipt No.:</strong>
            <span class="small-line" style="min-width: 160px; text-align:left;">
                {{ $reservation->official_receipt_no }}
            </span>
        </div>

        <table class="office-table">
            <tr>
                <td>
                    <div class="office-line">{{ $reservation->receipt_issued_by }}</div>
                    <strong>Receipt Issued By</strong><br>
                    Accounting Department
                    <br>
                    Date:
                    <span class="small-line">
                        {{ $reservation->receipt_issued_date ? $reservation->receipt_issued_date->format('m/d/Y') : '' }}
                    </span>
                </td>

                <td>
                    <div class="office-line">{{ $reservation->reviewed_by }}</div>
                    <strong>Reviewed By</strong><br>
                    Admin
                    <br>
                    Date:
                    <span class="small-line">
                        {{ $reservation->reviewed_date ? $reservation->reviewed_date->format('m/d/Y') : '' }}
                    </span>
                </td>

                <td>
                    <div class="office-line">{{ $reservation->endorsed_by }}</div>
                    <strong>Endorsed By</strong><br>
                    Chairman
                    <br>
                    Date:
                    <span class="small-line">
                        {{ $reservation->endorsed_date ? $reservation->endorsed_date->format('m/d/Y') : '' }}
                    </span>
                </td>
            </tr>
        </table>

    </div>

</body>

</html>
