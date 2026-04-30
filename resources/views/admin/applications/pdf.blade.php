<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Franchise Application #{{ $application->id }}</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            color: #111827;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10.5px;
            line-height: 1.55;
        }

        body.web-mode {
            background: #eef2f7;
            padding: 18px 0 32px;
        }

        .paper {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 14mm;
            background: #ffffff;
            text-align: center;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 2px solid #111827;
        }

        .header-logo {
            display: block;
            width: 150px;
            height: auto;
            margin: 0 auto 10px;
            object-fit: contain;
        }

        .brand {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #6b7280;
            font-weight: bold;
        }

        .title {
            margin-top: 4px;
            font-size: 18px;
            line-height: 1.25;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #111827;
        }

        .subtitle,
        .meta {
            margin-top: 5px;
            font-size: 9.5px;
            color: #6b7280;
        }

        .summary {
            text-align: center;
            margin: 0 auto 18px;
            padding: 10px 12px;
            max-width: 168mm;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #f8fafc;
            font-size: 10px;
            line-height: 1.7;
        }

        .summary strong {
            color: #111827;
        }

        .section {
            width: 100%;
            max-width: 168mm;
            margin: 14px auto;
            text-align: center;
            page-break-inside: avoid;
        }

        .section-title {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #ffffff;
            margin-bottom: 8px;
            padding: 7px 9px;
            background: #111827;
            border-radius: 6px;
        }

        .data-table {
            width: 100%;
            max-width: 168mm;
            margin: 0 auto;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #d1d5db;
            padding: 6px 8px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .data-table th {
            width: 34%;
            text-align: left;
            font-size: 9px;
            color: #374151;
            background: #f8fafc;
            text-transform: uppercase;
            letter-spacing: .03em;
        }

        .data-table td {
            width: 66%;
            text-align: left;
            color: #111827;
        }

        .photo-row {
            width: 100%;
            max-width: 168mm;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .photo-row td {
            vertical-align: top;
            border: none;
        }

        .photo-box {
            text-align: center;
            padding-top: 4px;
            color: #6b7280;
        }

        .photo-box strong {
            display: block;
            margin-bottom: 8px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .35px;
            color: #6b7280;
        }

        .photo {
            max-width: 95px;
            max-height: 115px;
        }

        .id-photo {
            max-width: 230px;
            max-height: 145px;
        }

        .muted {
            color: #9ca3af;
        }

        .note,
        .declaration {
            max-width: 168mm;
            margin: 0 auto;
            text-align: left;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 10px;
            background: #ffffff;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 26px;
        }

        .signature-table td {
            text-align: center;
            padding: 0 18px;
            vertical-align: bottom;
        }

        .sig-line {
            border: none;
            border-bottom: 1px solid #111827;
            min-height: 22px;
            margin-bottom: 5px;
            padding-bottom: 2px;
            font-weight: bold;
        }

        .footer {
            margin-top: 28px;
            text-align: center;
            color: #9ca3af;
            font-size: 8.5px;
        }

        .toolbar {
            width: 210mm;
            max-width: calc(100vw - 24px);
            margin: 0 auto 14px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .toolbar a,
        .toolbar button {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 9px 14px;
            background: #ffffff;
            color: #111827;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .toolbar button {
            background: #111827;
            border-color: #111827;
            color: #ffffff;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 12mm;
            }

            body.web-mode {
                background: #ffffff;
                padding: 0;
            }

            .toolbar {
                display: none !important;
            }

            .paper {
                width: auto;
                min-height: 0;
                margin: 0;
                padding: 0;
                border: 0;
                box-shadow: none;
            }
        }

        body.web-mode .paper {
            border: 1px solid #e5e7eb;
            box-shadow: 0 18px 50px rgba(15, 23, 42, .12);
        }

        body.pdf-mode .toolbar {
            display: none;
        }

        body.pdf-mode .paper {
            width: auto;
            min-height: 0;
            padding: 0;
        }

        .download-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.92);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            font-family: DejaVu Sans, sans-serif;
        }

        .download-box {
            width: 260px;
            text-align: center;
        }

        .download-title {
            font-size: 13px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .download-bar {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
        }

        .download-progress {
            width: 0%;
            height: 100%;
            background: #111827;
            border-radius: 999px;
            animation: downloading 1.6s ease-in-out forwards;
        }

        .download-text {
            margin-top: 10px;
            font-size: 10px;
            color: #6b7280;
        }

        @keyframes downloading {
            0% {
                width: 0%;
            }

            35% {
                width: 45%;
            }

            70% {
                width: 78%;
            }

            100% {
                width: 100%;
            }
        }
    </style>
</head>

<body class="{{ $pdfMode ?? false ? 'pdf-mode' : 'web-mode' }}">
    @php
        $dash = '—';
        $value = fn($v) => filled($v) ? $v : $dash;

        $logoFile = public_path('img/PNG.png');

        $logo = file_exists($logoFile) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoFile)) : null;

        $photoPath = $application->personal_photo ? public_path('storage/' . $application->personal_photo) : null;
        $govPath = $application->government_id ? public_path('storage/' . $application->government_id) : null;
        $govExt = $application->government_id
            ? strtolower(pathinfo($application->government_id, PATHINFO_EXTENSION))
            : null;
        $govIsImage = in_array($govExt, ['jpg', 'jpeg', 'png', 'webp']);

        $sections = [
            'Initial Consent' => [
                'Consent Status' => $application->consent_intro ? 'Agreed / Confirmed' : $dash,
                'Email Address' => $application->email,
                'Lead Source' => $application->lead_source,
            ],
            'Professional Background' => [
                'Educational Attainment' => $application->professional_education,
                'School and Year' => $application->professional_school,
                'Employment Status' => $application->professional_employment,
                'Occupation' => $application->professional_occupation,
                'Job Title' => $application->professional_job_title,
                'Years in Service' => $application->professional_years,
                'Company / Business' => $application->professional_company,
                'Company Address' => $application->professional_company_address,
                'Nature of Business' => $application->professional_business_nature,
                'Company Contact' => $application->professional_company_contact,
                'Primary Responsibilities' => $application->professional_responsibilities,
            ],
            'Business Background' => [
                'Business Experience' => $application->business_experience,
                'Business Name' => $application->business_name,
                'Years of Experience' => $application->business_years,
                'Industry' => $application->business_industry,
                'Previously Closed Business' => $application->business_closed,
                'Reason for Closure' => $application->business_closure_reason,
                'Venture Description' => $application->business_venture_description,
            ],
            'Brand Background' => [
                'Existing Customer' => $application->ki_customer,
                'Affiliated with Any Branch' => $application->ki_affiliated,
                'Affiliation Details' => $application->ki_affiliated_details,
                'Has Existing Food or Beverage Business' => $application->ki_has_coffee_shop,
                'Knowledge in Food and Beverage Industry' => $application->ki_industry_knowledge,
                'Passion for Brand Products' => $application->ki_passion,
                'Eagerness Level' => $application->ki_eagerness,
            ],
            'Business Proposal' => [
                'Preferred Location' => $application->proposal_location,
                'Reason for Location' => $application->proposal_reason,
                'Business Expectations' => $application->proposal_expectations,
                'Level of Involvement' => $application->proposal_involvement,
                'Management Philosophy' => $application->proposal_philosophy,
                'Other Business Interests' => $application->proposal_interests,
                'Socio-civic Affiliations' => $application->proposal_affiliations,
            ],
            'Financial Information' => [
                'Planned Investment' => $application->financial_investment,
                'Expected Monthly Sales' => $application->financial_expected_sales,
                'Expected ROI' => $application->financial_roi,
            ],
        ];
    @endphp

    @if (!($pdfMode ?? false))
        <div class="toolbar">
            <a href="{{ route('admin.application') }}">Back</a>
            <button type="button" onclick="window.print()">Print A4</button>
        </div>
    @endif

    <div class="paper">
        <div class="header">
            @if ($logo)
                <img class="header-logo" src="{{ $logo }}" alt="Logo">
            @endif

            <div class="brand">Pinnacle Global Franchising Group Inc.</div>

            <div class="title">
                {{ $value($application->brand ?? 'Franchise') }} Franchise Application Form
            </div>

            <div class="subtitle">
                Official applicant record for franchise evaluation
            </div>

            <div class="meta">
                Application No. #{{ $application->id }} &nbsp; | &nbsp;
                Date Applied: {{ optional($application->created_at)->format('M d, Y') ?? $dash }} &nbsp; | &nbsp;
                Generated: {{ now()->format('M d, Y h:i A') }}
            </div>
        </div>

        <div class="summary">
            <strong>Applicant:</strong> {{ $value($application->personal_full_name) }}<br>
            <strong>Email:</strong> {{ $value($application->email) }} &nbsp; | &nbsp;
            <strong>Contact:</strong> {{ $value($application->personal_contact) }}<br>
            <strong>Brand:</strong> {{ $value($application->brand ?? 'Kape-Ilokano') }} &nbsp; | &nbsp;
            <strong>Status:</strong> {{ $value($application->status ?? 'Review in Progress') }}
        </div>

        <div class="section">
            <div class="section-title">Personal Details</div>
            <table class="photo-row">
                <tr>
                    <td style="width: 74%; padding-right: 8px;">
                        <table class="data-table">
                            <tr>
                                <th>Complete Name</th>
                                <td>{{ $value($application->personal_full_name) }}</td>
                            </tr>
                            <tr>
                                <th>Primary Address</th>
                                <td>{{ $value($application->personal_address) }}</td>
                            </tr>
                            <tr>
                                <th>Contact Number</th>
                                <td>{{ $value($application->personal_contact) }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ $value($application->personal_gender) }}</td>
                            </tr>
                            <tr>
                                <th>Civil Status</th>
                                <td>{{ $value($application->personal_civil_status) }}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{ $value($application->personal_age) }}</td>
                            </tr>
                            <tr>
                                <th>Country of Birth</th>
                                <td>{{ $value($application->personal_country_birth) }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ $value($application->personal_nationality) }}</td>
                            </tr>
                            <tr>
                                <th>Country of Residence</th>
                                <td>{{ $value($application->personal_residence) }}</td>
                            </tr>
                            <tr>
                                <th>TIN</th>
                                <td>{{ $value($application->personal_tin) }}</td>
                            </tr>
                            <tr>
                                <th>Religion</th>
                                <td>{{ $value($application->personal_religion) }}</td>
                            </tr>
                            <tr>
                                <th>Spouse</th>
                                <td>{{ $value($application->personal_spouse) }}</td>
                            </tr>
                            <tr>
                                <th>Hobbies</th>
                                <td>{{ $value($application->personal_hobbies) }}</td>
                            </tr>
                            <tr>
                                <th>Dependents</th>
                                <td>{!! nl2br(e($value($application->personal_dependents))) !!}</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 26%;">
                        <div class="photo-box">
                            <strong>Applicant Photo</strong><br><br>
                            @if ($photoPath && file_exists($photoPath))
                                <img src="{{ $photoPath }}" class="photo" alt="Applicant Photo">
                            @else
                                <span class="muted">No photo attached</span>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        @foreach ($sections as $title => $rows)
            <div class="section">
                <div class="section-title">{{ $title }}</div>
                <table class="data-table">
                    @foreach ($rows as $label => $rowValue)
                        <tr>
                            <th>{{ $label }}</th>
                            <td>{!! nl2br(e($value($rowValue))) !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach

        <div class="section">
            <div class="section-title">Character References</div>
            <div class="note">{!! nl2br(e($value($application->references))) !!}</div>
        </div>

        <div class="section">
            <div class="section-title">Final Consent and Government ID</div>
            <table class="photo-row">
                <tr>
                    <td style="width: 42%; padding-right: 8px;">
                        <table class="data-table">
                            <tr>
                                <th>Final Consent</th>
                                <td>
                                    {{ $application->consent_final ? 'Agreed / Confirmed' : $dash }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 58%;">
                        <div class="photo-box">
                            <strong>Government ID</strong><br><br>
                            @if ($govPath && file_exists($govPath) && $govIsImage)
                                <img src="{{ $govPath }}" class="id-photo" alt="Government ID">
                            @elseif($application->government_id)
                                Uploaded file: {{ basename($application->government_id) }}
                            @else
                                <span class="muted">No government ID attached</span>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Declaration</div>
            <div class="declaration">
                I hereby certify that the information provided in this franchise application is true and correct to
                the best of my knowledge. I understand that Pinnacle Global Franchising Group Inc. may verify the
                submitted details as part of the franchise evaluation process.

                <table class="signature-table">
                    <tr>
                        <td style="width: 68%;">
                            <div class="sig-line">{{ $value($application->personal_full_name) }}</div>
                            Applicant's Complete Name and Signature
                        </td>
                        <td style="width: 32%;">
                            <div class="sig-line">{{ optional($application->created_at)->format('M d, Y') ?? '' }}
                            </div>
                            Date
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            Franchise Application Record · Pinnacle Global Franchising Group Inc. · Generated
            {{ now()->format('M d, Y h:i A') }}
        </div>
    </div>
    <div id="downloadOverlay" class="download-overlay">
        <div class="download-box">
            <div class="download-title">Preparing Download</div>

            <div class="download-bar">
                <div class="download-progress"></div>
            </div>

            <div class="download-text">Please wait while your PDF is being generated...</div>
        </div>
    </div>
    <script>
        function showDownloadEffect() {
            const overlay = document.getElementById('downloadOverlay');

            if (!overlay) return;

            overlay.style.display = 'flex';

            setTimeout(function() {
                overlay.style.display = 'none';
            }, 1800);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const downloadButtons = document.querySelectorAll(
                'a[href*="download"], a[href*="pdf"], button[type="submit"], .download-btn'
            );

            downloadButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    showDownloadEffect();
                });
            });
        });
    </script>
</body>

</html>
