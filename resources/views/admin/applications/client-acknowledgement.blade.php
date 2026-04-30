<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Acknowledgment & Agreement #{{ $application->id }}</title>

    <style>
        @page {
            size: A4;
            margin: 18mm;
        }

        body {
            margin: 0;
            color: #111827;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.65;
            background: #eef2f7;
        }

        .toolbar {
            max-width: 820px;
            margin: 18px auto 12px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .toolbar button {
            border: 0;
            border-radius: 8px;
            padding: 10px 14px;
            background: #111827;
            color: #ffffff;
            font-weight: 700;
            cursor: pointer;
        }

        .paper {
            max-width: 820px;
            min-height: 1000px;
            margin: 0 auto 24px;
            padding: 48px;
            background: #ffffff;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .14);
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .header .subtitle {
            margin-top: 4px;
            font-weight: 700;
        }

        .intro {
            margin-bottom: 18px;
        }

        .terms {
            margin: 0;
            padding-left: 20px;
        }

        .terms li {
            margin-bottom: 12px;
        }

        .terms strong {
            display: block;
            margin-bottom: 2px;
        }

        .section-title {
            margin-top: 26px;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .signature-block {
            margin-top: 42px;
        }

        .signature-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-top: 28px;
        }

        .line {
            border-bottom: 1px solid #111827;
            min-height: 28px;
            margin-bottom: 6px;
            font-weight: 700;
            text-align: center;
        }

        .caption {
            text-align: center;
            font-size: 10px;
            color: #4b5563;
        }

        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 10px;
        }

        .field {
            display: flex;
            gap: 8px;
            align-items: flex-end;
            margin-bottom: 14px;
        }

        .field label {
            white-space: nowrap;
            font-weight: 700;
        }

        .field .blank {
            flex: 1;
            border-bottom: 1px solid #111827;
            min-height: 22px;
        }

        @media print {
            body {
                background: #ffffff;
            }

            .toolbar {
                display: none;
            }

            .paper {
                max-width: none;
                min-height: 0;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="toolbar">
        <button type="button" onclick="window.print()">Print Agreement</button>
    </div>

    <main class="paper">
        <div class="header">
            <h1>Client Acknowledgment &amp; Agreement</h1>
            <div class="subtitle">Voucher Booklet Terms &amp; Condition – V0426</div>
        </div>

        <p class="intro">
            I hereby acknowledge that I have voluntarily purchased and received the Coupon/Voucher Booklet No.
            <strong>
                @if ($application->coupon)
                    {{ $application->coupon->unique_code }}
                @else
                    __________________
                @endif
            </strong>
            and agree to the following terms and conditions:
        </p>

        <ol class="terms">
            <li>
                <strong>Entitlement to Benefits</strong>
                This booklet grants access to exclusive offers and promotional benefits from participating Kape-Ilokano
                Cafe branches, subject to the terms stated herein.
            </li>

            <li>
                <strong>Usage of Vouchers</strong>
                Each voucher is valid for one-time use only and may be redeemed solely for the specific product or
                service indicated. The voucher must be surrendered upon redemption.
            </li>

            <li>
                <strong>Validity Period</strong>
                All vouchers are valid for one (1) year from the date of issuance, unless otherwise specified.
            </li>

            <li>
                <strong>Redemption Process</strong>
                For security and proper tracking, all vouchers are subject to system validation prior to redemption.
                Only validated vouchers will be honored. Can be redeemed by anyone upon presentment of physical voucher.
            </li>

            <li>
                <strong>Product Availability</strong>
                Redemption is subject to product availability at the time of visit. In case of temporary unavailability,
                the voucher may be redeemed at a later date within the validity period.
            </li>

            <li>
                <strong>Safekeeping Responsibility</strong>
                The booklet and its vouchers should be kept in good condition. Lost, stolen, or damaged vouchers may no
                longer be accepted.
            </li>

            <li>
                <strong>Fair and Proper Use</strong>
                To ensure fairness for all customers, any voucher that is tampered, altered, duplicated, or otherwise
                invalid shall not be honored.
            </li>

            <li>
                <strong>Participating Branches</strong>
                Vouchers are redeemable only at participating Kape-Ilokano Cafe branches, subject to store policies and
                operating hours.
            </li>

            <li>
                <strong>Promo Limitations</strong>
                Unless otherwise specified, vouchers are not valid in conjunction with other promotions, discounts, or
                privileges.
            </li>

            <li>
                <strong>Verification and Compliance</strong>
                Kape-Ilokano Cafe reserves the right to verify voucher authenticity and ensure compliance with these
                terms to maintain fair and secure transactions.
            </li>

            <li>
                <strong>Regulatory Alignment</strong>
                These terms are implemented in accordance with applicable regulations of the Department of Trade and
                Industry (DTI), ensuring transparency and consumer protection.
            </li>

            <li>
                <strong>Customer Confirmation</strong>

                <p>
                    I confirm that I have read and understood the terms and conditions governing the Franchise
                    Coupon/Voucher Booklet.
                </p>

                <p>
                    I acknowledge that these terms are established to ensure a fair, transparent, and seamless
                    redemption
                    experience for all customers.
                </p>

                <p>
                    I acknowledge that these terms have been clearly explained to me, and I agree to comply with all
                    stated guidelines, conditions, and limitations.
                </p>

                <p>
                    I agree to comply with the proper use and redemption procedures, including presenting the voucher
                    for
                    validation prior to redemption, and understand that only vouchers that meet the stated conditions
                    will be honored.
                </p>

                <p>
                    I accept these terms and look forward to enjoying the exclusive offers and benefits provided through
                    this booklet.
                </p>

                <p>
                    I further confirm that my acceptance of this document constitutes a binding agreement, and that I
                    shall adhere to the proper use and redemption procedures of the vouchers.
                </p>
            </li>
        </ol>

        <div class="signature-block">
            <div class="section-title">Client Conforme:</div>

            <div class="signature-row">
                <div>
                    <div class="line">{{ $application->personal_full_name }}</div>
                    <div class="caption">Complete Name &amp; Signature</div>
                </div>

                <div>
                    <div class="line">{{ now()->format('M d, Y') }}</div>
                    <div class="caption">Date</div>
                </div>
            </div>
        </div>

        <div class="signature-block">
            <div class="section-title">Head Office Operations Department:</div>

            <p><strong>Pinnacle Global Franchising Group Inc.</strong></p>

            <div class="signature-row">
                <div>
                    <div class="line">&nbsp;</div>
                    <div class="caption">Authorized Representative</div>
                </div>

                <div>
                    <div class="line">{{ now()->format('M d, Y') }}</div>
                    <div class="caption">Date</div>
                </div>
            </div>
        </div>

        <div class="signature-block">
            <div class="section-title">Accounting Department:</div>

            <p><strong>Acknowledgement Receipt:</strong></p>

            <div class="two-column">
                <div>
                    <div class="field">
                        <label>Payment Reference Number:</label>
                        <div class="blank"></div>
                    </div>

                    <div class="field">
                        <label>Receipt Number:</label>
                        <div class="blank"></div>
                    </div>
                </div>

                <div>
                    <div class="field">
                        <label>Mode Of Payment:</label>
                        <div class="blank"></div>
                    </div>

                    <div class="field">
                        <label>Processed By:</label>
                        <div class="blank"></div>
                    </div>

                    <div class="caption">Authorized Representative</div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
