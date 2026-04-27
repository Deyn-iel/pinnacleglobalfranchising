<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Franchise Application #{{ $application->id }}</title>

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
            font-size: 8.8px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 20px 10mm 10px;
            margin-bottom: 8px;
        }

        .logo {
            width: 130px;
            height: auto;
            position: absolute;
            left: 10mm;
        }

        .subtitle {
            text-align: center;
            font-size: 9.5px;
            margin-bottom: 8px;
            color: #374151;
        }

        .date-row {
            text-align: right;
            margin-bottom: 9px;
            font-size: 10.5px;
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
            font-size: 10.5px;
            margin-bottom: 7px;
        }

        .label {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .line {
            border-bottom: 1px solid #111827;
            min-height: 15px;
            padding: 1px 4px 2px;
            word-wrap: break-word;
        }

        .small-line {
            display: inline-block;
            min-width: 60px;
            border-bottom: 1px solid #111827;
            text-align: center;
            min-height: 12px;
            padding: 0 3px;
        }

        .two-col,
        .three-col {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10.5px;
            margin-bottom: 4px;
        }

        .two-col td {
            width: 50%;
            vertical-align: top;
            padding-right: 10px;
        }

        .three-col td {
            width: 33.333%;
            vertical-align: top;
            padding-right: 8px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10.2px;
            margin-bottom: 4px;
        }

        .info-table th,
        .info-table td {
            border: 1px solid #111827;
            padding: 4px 5px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .info-table th {
            width: 30%;
            text-align: left;
            font-weight: bold;
            background: #f3f4f6;
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

        .photo-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 6px;
        }

        .photo-table td {
            vertical-align: top;
            padding-right: 10px;
        }

        .photo-box {
            border: 1px solid #111827;
            min-height: 80px;
            padding: 5px;
            text-align: center;
        }

        .photo {
            width: 100px;
            height: auto;
        }

        .id-photo {
            width: 170px;
            height: auto;
        }

        .muted {
            color: #374151;
            font-weight: normal;
        }

        .textarea-line {
            border: 1px solid #111827;
            min-height: 34px;
            padding: 4px 5px;
            word-wrap: break-word;
        }

        .signature-table {
            width: 100%;
            font-size: 10.8px;
            margin-top: 16px;
            border-collapse: collapse;
            table-layout: fixed;
            page-break-inside: avoid;
        }

        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            padding: 0 10px;
        }

        .sig-line {
            border-bottom: 1px solid #111827;
            min-height: 16px;
            margin: 0 auto 3px;
            width: 90%;
            padding: 0 3px;
        }

        .footer {
            border-top: 1px solid #111827;
            margin-top: 14px;
            padding-top: 5px;
            text-align: center;
            font-size: 8.5px;
            color: #374151;
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
        $photoPath = $application->personal_photo ? public_path('storage/' . $application->personal_photo) : null;

        $govPath = $application->government_id ? public_path('storage/' . $application->government_id) : null;

        $govExt = $application->government_id
            ? strtolower(pathinfo($application->government_id, PATHINFO_EXTENSION))
            : null;

        $govIsImage = in_array($govExt, ['jpg', 'jpeg', 'png', 'webp']);

        $check = function ($value) {
            return $value ? 'X' : '';
        };
    @endphp

    <div class="paper">

        <div class="title">
            <img class="logo" src="{{ asset('img/logo.webp') }}" alt="Kape Ilokano">
            Franchise Application Form
        </div>

        <div class="subtitle">
            Official Applicant Record · Kape Ilokano Franchise Department
        </div>

        <div class="date-row">
            <strong>Application No.:</strong>
            <span class="small-line">{{ $application->id }}</span>
            &nbsp;&nbsp;
            <strong>Date:</strong>
            <span class="small-line" style="min-width: 75px;">
                {{ $application->created_at ? $application->created_at->format('m/d/Y') : '' }}
            </span>
            &nbsp;&nbsp;
            <strong>Time:</strong>
            <span class="small-line" style="min-width: 60px;">
                {{ $application->created_at ? $application->created_at->format('h:i A') : '' }}
            </span>
        </div>

        <div class="section-title">I. Initial Consent</div>

        <table class="info-table">
            <tr>
                <th>Consent Status</th>
                <td>
                    <span class="box">{{ $check($application->consent_intro) }}</span>
                    Agreed / Confirmed
                </td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $application->email ?? '—' }}</td>
            </tr>
            <tr>
                <th>Lead Source</th>
                <td>{{ $application->lead_source ?? '—' }}</td>
            </tr>
        </table>

        <div class="section-title">II. Personal Details</div>

        <table class="photo-table">
            <tr>
                <td style="width: 72%;">
                    <table class="info-table">
                        <tr>
                            <th>Complete Name</th>
                            <td>{{ $application->personal_full_name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Primary Address</th>
                            <td>{{ $application->personal_address ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $application->personal_contact ?? '—' }}</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 28%;">
                    <div class="label">Applicant Photo</div>
                    <div class="photo-box">
                        @if ($photoPath && file_exists($photoPath))
                            <img src="{{ $photoPath }}" class="photo" alt="Personal Photo">
                        @else
                            <span class="muted">No photo attached</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <table class="three-col">
            <tr>
                <td>
                    <div class="label">Gender:</div>
                    <div class="line">{{ $application->personal_gender ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Civil Status:</div>
                    <div class="line">{{ $application->personal_civil_status ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Age:</div>
                    <div class="line">{{ $application->personal_age ?? '—' }}</div>
                </td>
            </tr>
        </table>

        <table class="two-col">
            <tr>
                <td>
                    <div class="label">Country of Birth:</div>
                    <div class="line">{{ $application->personal_country_birth ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Nationality:</div>
                    <div class="line">{{ $application->personal_nationality ?? '—' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Country of Residence:</div>
                    <div class="line">{{ $application->personal_residence ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">TIN:</div>
                    <div class="line">{{ $application->personal_tin ?? '—' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Religion:</div>
                    <div class="line">{{ $application->personal_religion ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Spouse:</div>
                    <div class="line">{{ $application->personal_spouse ?? '—' }}</div>
                </td>
            </tr>
        </table>

        <div class="line-row">
            <div class="label">Hobbies:</div>
            <div class="line">{{ $application->personal_hobbies ?? '—' }}</div>
        </div>

        <div class="line-row">
            <div class="label">Dependents:</div>
            <div class="textarea-line">{!! nl2br(e($application->personal_dependents ?? '—')) !!}</div>
        </div>

        <div class="section-title">III. Professional Background</div>

        <table class="two-col">
            <tr>
                <td>
                    <div class="label">Educational Attainment:</div>
                    <div class="line">{{ $application->professional_education ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">School & Year:</div>
                    <div class="line">{{ $application->professional_school ?? '—' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Employment Status:</div>
                    <div class="line">{{ $application->professional_employment ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Occupation:</div>
                    <div class="line">{{ $application->professional_occupation ?? '—' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Job Title:</div>
                    <div class="line">{{ $application->professional_job_title ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Years in Service:</div>
                    <div class="line">{{ $application->professional_years ?? '—' }}</div>
                </td>
            </tr>
        </table>

        <div class="line-row">
            <div class="label">Company:</div>
            <div class="line">{{ $application->professional_company ?? '—' }}</div>
        </div>

        <div class="line-row">
            <div class="label">Company Address:</div>
            <div class="line">{{ $application->professional_company_address ?? '—' }}</div>
        </div>

        <table class="two-col">
            <tr>
                <td>
                    <div class="label">Nature of Business:</div>
                    <div class="line">{{ $application->professional_business_nature ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Company Contact:</div>
                    <div class="line">{{ $application->professional_company_contact ?? '—' }}</div>
                </td>
            </tr>
        </table>

        <div class="line-row">
            <div class="label">Primary Responsibilities:</div>
            <div class="textarea-line">{!! nl2br(e($application->professional_responsibilities ?? '—')) !!}</div>
        </div>

        <div class="section-title">IV. Business Background</div>

        <table class="two-col">
            <tr>
                <td>
                    <div class="label">Business Experience:</div>
                    <div class="line">{{ $application->business_experience ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Business Name:</div>
                    <div class="line">{{ $application->business_name ?? '—' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Years of Experience:</div>
                    <div class="line">{{ $application->business_years ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Industry:</div>
                    <div class="line">{{ $application->business_industry ?? '—' }}</div>
                </td>
            </tr>
        </table>

        <div class="line-row">
            <div class="label">Previously Closed Business:</div>
            <div class="line">{{ $application->business_closed ?? '—' }}</div>
        </div>

        <div class="line-row">
            <div class="label">Reason for Closure:</div>
            <div class="textarea-line">{!! nl2br(e($application->business_closure_reason ?? '—')) !!}</div>
        </div>

        <div class="line-row">
            <div class="label">Venture Description:</div>
            <div class="textarea-line">{!! nl2br(e($application->business_venture_description ?? '—')) !!}</div>
        </div>

        <div class="section-title">V. Kape Ilokano Background</div>

        <table class="info-table">
            <tr>
                <th>Existing Customer</th>
                <td>{{ $application->ki_customer ?? '—' }}</td>
            </tr>
            <tr>
                <th>Affiliated with Any Branch</th>
                <td>{{ $application->ki_affiliated ?? '—' }}</td>
            </tr>
            <tr>
                <th>Affiliation Details</th>
                <td>{{ $application->ki_affiliated_details ?? '—' }}</td>
            </tr>
            <tr>
                <th>Has Existing Coffee Shop</th>
                <td>{{ $application->ki_has_coffee_shop ?? '—' }}</td>
            </tr>
            <tr>
                <th>Knowledge in Coffee Industry</th>
                <td>{{ $application->ki_industry_knowledge ?? '—' }}</td>
            </tr>
            <tr>
                <th>Passion for Coffee</th>
                <td>{{ $application->ki_passion ?? '—' }}</td>
            </tr>
            <tr>
                <th>Eagerness Level</th>
                <td>{{ $application->ki_eagerness ?? '—' }}</td>
            </tr>
        </table>

        <div class="section-title">VI. Business Proposal</div>

        <div class="line-row">
            <div class="label">Preferred Location:</div>
            <div class="line">{{ $application->proposal_location ?? '—' }}</div>
        </div>

        <div class="line-row">
            <div class="label">Reason for Location:</div>
            <div class="textarea-line">{!! nl2br(e($application->proposal_reason ?? '—')) !!}</div>
        </div>

        <div class="line-row">
            <div class="label">Business Expectations:</div>
            <div class="textarea-line">{!! nl2br(e($application->proposal_expectations ?? '—')) !!}</div>
        </div>

        <div class="line-row">
            <div class="label">Level of Involvement:</div>
            <div class="textarea-line">{!! nl2br(e($application->proposal_involvement ?? '—')) !!}</div>
        </div>

        <div class="line-row">
            <div class="label">Management Philosophy:</div>
            <div class="textarea-line">{!! nl2br(e($application->proposal_philosophy ?? '—')) !!}</div>
        </div>

        <div class="line-row">
            <div class="label">Other Business Interests:</div>
            <div class="textarea-line">{!! nl2br(e($application->proposal_interests ?? '—')) !!}</div>
        </div>

        <div class="line-row">
            <div class="label">Socio-civic Affiliations:</div>
            <div class="textarea-line">{!! nl2br(e($application->proposal_affiliations ?? '—')) !!}</div>
        </div>

        <div class="section-title">VII. Financial Information</div>

        <table class="three-col">
            <tr>
                <td>
                    <div class="label">Planned Investment:</div>
                    <div class="line">{{ $application->financial_investment ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Expected Monthly Sales:</div>
                    <div class="line">{{ $application->financial_expected_sales ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Expected ROI:</div>
                    <div class="line">{{ $application->financial_roi ?? '—' }}</div>
                </td>
            </tr>
        </table>

        <div class="section-title">VIII. Character References</div>

        <div class="textarea-line">
            {!! nl2br(e($application->references ?? '—')) !!}
        </div>

        <div class="section-title">IX. Final Consent & Government ID</div>

        <table class="photo-table no-break">
            <tr>
                <td style="width: 45%;">
                    <div class="label">Final Consent Status:</div>
                    <div class="line">
                        <span class="box">{{ $check($application->consent_final) }}</span>
                        Agreed / Confirmed
                    </div>
                </td>

                <td style="width: 55%;">
                    <div class="label">Government ID:</div>
                    <div class="photo-box">
                        @if ($govPath && file_exists($govPath) && $govIsImage)
                            <img src="{{ $govPath }}" class="id-photo" alt="Government ID">
                        @elseif($application->government_id)
                            Uploaded file: {{ basename($application->government_id) }}
                        @else
                            <span class="muted">No government ID file attached</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <div class="section-title">X. Declaration</div>

        <p style="font-size: 10.5px; margin: 0 0 10px;">
            I hereby certify that the information provided in this franchise application is true and correct to the
            best of my knowledge. I understand that Kape Ilokano may verify the submitted details as part of the
            franchise evaluation process.
        </p>

        <table class="signature-table">
            <tr>
                <td style="width: 70%;">
                    <div class="sig-line">{{ $application->personal_full_name ?? '' }}</div>
                    <strong>Applicant’s Complete Name & Signature</strong>
                </td>

                <td style="width: 30%;">
                    <div class="sig-line">
                        {{ $application->created_at ? $application->created_at->format('m/d/Y') : '' }}
                    </div>
                    <strong>Date</strong>
                </td>
            </tr>
        </table>

        <div class="footer">
            Kape Ilokano Franchise Application Record · Generated on {{ now()->format('M d, Y h:i A') }}
        </div>

    </div>

</body>

</html>
