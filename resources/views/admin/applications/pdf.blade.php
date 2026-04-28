<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Franchise Application #{{ $application->id }}</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 14mm 12mm 16mm;
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
            font-size: 10px;
            line-height: 1.45;
        }

        .toolbar {
            max-width: 210mm;
            margin: 12px auto;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .toolbar a,
        .toolbar button {
            border: 0;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
            background: #0f172a;
        }

        .paper {
            width: 100%;
        }

        body.web-mode {
            background: #e5e7eb;
        }

        body.web-mode .paper {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 14mm 12mm 16mm;
            background: #ffffff;
            box-shadow: 0 18px 55px rgba(15, 23, 42, .18);
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-logo {
            width: 98px;
            height: auto;
        }

        .brand {
            font-size: 10px;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: .8px;
            font-weight: bold;
        }

        .title {
            margin-top: 4px;
            font-size: 20px;
            line-height: 1.1;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .subtitle {
            margin-top: 5px;
            font-size: 10px;
            color: #475569;
        }

        .meta-box {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 9px 10px;
            font-size: 9.5px;
            text-align: right;
        }

        .meta-box strong {
            color: #0f172a;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 13px;
            table-layout: fixed;
        }

        .summary td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            vertical-align: top;
        }

        .summary .k {
            display: block;
            margin-bottom: 3px;
            font-size: 8px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: bold;
        }

        .summary .v {
            font-size: 11px;
            color: #111827;
            font-weight: bold;
            word-wrap: break-word;
        }

        .section {
            margin-top: 12px;
            page-break-inside: avoid;
        }

        .section-title {
            background: #0f172a;
            color: #ffffff;
            padding: 6px 8px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: bold;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 7px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #d7dee8;
            padding: 6px 7px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .data-table th {
            width: 30%;
            background: #f8fafc;
            color: #334155;
            text-align: left;
            font-size: 8.5px;
            text-transform: uppercase;
            letter-spacing: .35px;
        }

        .data-table td {
            color: #111827;
        }

        .two-col {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .two-col>tbody>tr>td {
            width: 50%;
            vertical-align: top;
            padding: 0 4px 0 0;
        }

        .two-col>tbody>tr>td+td {
            padding: 0 0 0 4px;
        }

        .note {
            border: 1px solid #d7dee8;
            padding: 7px;
            min-height: 34px;
            word-wrap: break-word;
        }

        .photo-row {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .photo-row td {
            vertical-align: top;
        }

        .photo-box {
            border: 1px solid #d7dee8;
            background: #f8fafc;
            padding: 7px;
            text-align: center;
            min-height: 112px;
        }

        .photo {
            max-width: 105px;
            max-height: 125px;
        }

        .id-photo {
            max-width: 245px;
            max-height: 150px;
        }

        .muted {
            color: #64748b;
        }

        .check {
            display: inline-block;
            width: 11px;
            height: 11px;
            border: 1px solid #0f172a;
            text-align: center;
            line-height: 10px;
            font-size: 8px;
            margin-right: 5px;
            font-weight: bold;
        }

        .declaration {
            border: 1px solid #cbd5e1;
            padding: 9px 10px;
            page-break-inside: avoid;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 18px;
            page-break-inside: avoid;
        }

        .signature-table td {
            text-align: center;
            padding: 0 16px;
            vertical-align: bottom;
        }

        .sig-line {
            border-bottom: 1px solid #111827;
            min-height: 20px;
            margin-bottom: 5px;
            padding-bottom: 2px;
            font-weight: bold;
        }

        .footer {
            margin-top: 16px;
            padding-top: 7px;
            border-top: 1px solid #cbd5e1;
            color: #64748b;
            text-align: center;
            font-size: 8.5px;
        }

        @media print {
            .toolbar {
                display: none;
            }

            body.web-mode {
                background: #ffffff;
            }

            body.web-mode .paper {
                width: auto;
                min-height: 0;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body class="{{ $pdfMode ?? false ? 'pdf-mode' : 'web-mode' }}">
    @php
        $dash = '—';
        $value = fn ($v) => filled($v) ? $v : $dash;

        $logoPath = public_path('img/logo1-removebg-preview.png');
        $fallbackLogoPath = public_path('img/logo.webp');
        $logo = file_exists($logoPath) ? $logoPath : $fallbackLogoPath;

        $photoPath = $application->personal_photo ? public_path('storage/' . $application->personal_photo) : null;
        $govPath = $application->government_id ? public_path('storage/' . $application->government_id) : null;
        $govExt = $application->government_id ? strtolower(pathinfo($application->government_id, PATHINFO_EXTENSION)) : null;
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
            'Kape Ilokano Background' => [
                'Existing Customer' => $application->ki_customer,
                'Affiliated with Any Branch' => $application->ki_affiliated,
                'Affiliation Details' => $application->ki_affiliated_details,
                'Has Existing Coffee Shop' => $application->ki_has_coffee_shop,
                'Knowledge in Coffee Industry' => $application->ki_industry_knowledge,
                'Passion for Coffee' => $application->ki_passion,
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

    <div class="paper">
        <div class="header">
            <table class="header-table">
                <tr>
                    <td style="width: 18%;">
                        @if ($logo && file_exists($logo))
                            <img class="header-logo" src="{{ $logo }}" alt="Logo">
                        @endif
                    </td>
                    <td style="width: 52%;">
                        <div class="brand">Pinnacle Global Franchising Group Inc.</div>
                        <div class="title">Franchise Application Form</div>
                        <div class="subtitle">Official applicant record for franchise evaluation</div>
                    </td>
                    <td style="width: 30%;">
                        <div class="meta-box">
                            <div><strong>Application No.</strong> #{{ $application->id }}</div>
                            <div><strong>Date Applied</strong> {{ optional($application->created_at)->format('M d, Y') ?? $dash }}</div>
                            <div><strong>Generated</strong> {{ now()->format('M d, Y h:i A') }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <table class="summary">
            <tr>
                <td>
                    <span class="k">Applicant</span>
                    <span class="v">{{ $value($application->personal_full_name) }}</span>
                </td>
                <td>
                    <span class="k">Email</span>
                    <span class="v">{{ $value($application->email) }}</span>
                </td>
                <td>
                    <span class="k">Contact</span>
                    <span class="v">{{ $value($application->personal_contact) }}</span>
                </td>
                <td>
                    <span class="k">Status</span>
                    <span class="v">{{ $value($application->status ?? 'Review in Progress') }}</span>
                </td>
            </tr>
        </table>

        <div class="section">
            <div class="section-title">Personal Details</div>
            <table class="photo-row">
                <tr>
                    <td style="width: 74%; padding-right: 8px;">
                        <table class="data-table">
                            <tr><th>Complete Name</th><td>{{ $value($application->personal_full_name) }}</td></tr>
                            <tr><th>Primary Address</th><td>{{ $value($application->personal_address) }}</td></tr>
                            <tr><th>Contact Number</th><td>{{ $value($application->personal_contact) }}</td></tr>
                            <tr><th>Gender</th><td>{{ $value($application->personal_gender) }}</td></tr>
                            <tr><th>Civil Status</th><td>{{ $value($application->personal_civil_status) }}</td></tr>
                            <tr><th>Age</th><td>{{ $value($application->personal_age) }}</td></tr>
                            <tr><th>Country of Birth</th><td>{{ $value($application->personal_country_birth) }}</td></tr>
                            <tr><th>Nationality</th><td>{{ $value($application->personal_nationality) }}</td></tr>
                            <tr><th>Country of Residence</th><td>{{ $value($application->personal_residence) }}</td></tr>
                            <tr><th>TIN</th><td>{{ $value($application->personal_tin) }}</td></tr>
                            <tr><th>Religion</th><td>{{ $value($application->personal_religion) }}</td></tr>
                            <tr><th>Spouse</th><td>{{ $value($application->personal_spouse) }}</td></tr>
                            <tr><th>Hobbies</th><td>{{ $value($application->personal_hobbies) }}</td></tr>
                            <tr><th>Dependents</th><td>{!! nl2br(e($value($application->personal_dependents))) !!}</td></tr>
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
                                    <span class="check">{{ $application->consent_final ? 'X' : '' }}</span>
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
                            <div class="sig-line">{{ optional($application->created_at)->format('M d, Y') ?? '' }}</div>
                            Date
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            Franchise Application Record · Pinnacle Global Franchising Group Inc. · Generated {{ now()->format('M d, Y h:i A') }}
        </div>
    </div>
</body>

</html>
