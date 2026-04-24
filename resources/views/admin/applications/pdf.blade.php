<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Franchise Application #{{ $application->id }}</title>

    <style>
        @page {
            margin: 18mm 14mm 18mm 14mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10.5px;
            line-height: 1.45;
            color: #1f2937;
            margin: 0;
            padding: 0;
            background: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        .page {
            width: 100%;
        }

        .header {
            border: 1px solid #cfd8e3;
            padding: 14px 16px 12px 16px;
            margin-bottom: 14px;
            background: #ffffff;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .header-table td {
            border: none;
            vertical-align: top;
            padding: 0;
        }

        .logo-cell {
            width: 90px;
        }

        .logo {
            width: 72px;
            height: auto;
            display: block;
        }

        .brand-name {
            font-size: 9px;
            color: #6b7280;
            margin-top: 6px;
            letter-spacing: 0.3px;
        }

        .title-cell {
            text-align: right;
        }

        .document-title {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #111827;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .document-subtitle {
            margin: 3px 0 0 0;
            font-size: 10px;
            color: #6b7280;
        }

        .meta-box {
            margin-top: 10px;
            border-top: 1px solid #dbe3ec;
            padding-top: 8px;
        }

        .meta-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .meta-table td {
            border: none;
            padding: 2px 0;
            font-size: 10px;
            color: #374151;
            vertical-align: top;
        }

        .meta-label {
            font-weight: bold;
            color: #111827;
            width: 110px;
        }

        .summary {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin: 0 0 14px 0;
            table-layout: fixed;
        }

        .summary td {
            border: 1px solid #d7dee8;
            background: #f8fafc;
            padding: 10px 12px;
            vertical-align: top;
        }

        .summary-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .summary-value {
            font-size: 12px;
            font-weight: bold;
            color: #111827;
        }

        .section {
            margin-bottom: 14px;
            page-break-inside: avoid;
        }

        .section-header {
            background: #eaf0f7;
            border: 1px solid #cfd8e3;
            padding: 8px 10px;
            margin-bottom: 0;
        }

        .section-title {
            margin: 0;
            font-size: 11.5px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-body {
            border: 1px solid #cfd8e3;
            border-top: none;
            padding: 0;
            background: #ffffff;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #dde5ee;
            padding: 7px 9px;
            vertical-align: top;
            word-wrap: break-word;
        }

        table.data-table th {
            width: 28%;
            background: #f6f8fb;
            font-weight: bold;
            color: #111827;
            text-align: left;
        }

        table.data-table td {
            background: #ffffff;
            color: #1f2937;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 9px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-radius: 2px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #0f172a;
        }

        .status-yes {
            background: #eef6ff;
            border-color: #bfd4f2;
            color: #1d4f91;
        }

        .status-no {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #4b5563;
        }

        .textbox {
            padding: 10px 12px;
            border: 1px solid #dde5ee;
            background: #ffffff;
            min-height: 44px;
            word-wrap: break-word;
            white-space: normal;
        }

        .note-box {
            border: 1px solid #dde5ee;
            background: #f9fbfd;
            padding: 10px 12px;
            color: #374151;
        }

        .photo-block {
            padding: 12px;
            border-bottom: 1px solid #dde5ee;
        }

        .photo-label {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .photo {
            width: 110px;
            height: auto;
            border: 1px solid #cfd8e3;
            padding: 3px;
            background: #ffffff;
        }

        .id-photo {
            width: 180px;
            height: auto;
            border: 1px solid #cfd8e3;
            padding: 3px;
            background: #ffffff;
        }

        .muted {
            color: #6b7280;
            font-size: 9.5px;
        }

        .footer {
            margin-top: 18px;
            border-top: 1px solid #cfd8e3;
            padding-top: 8px;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
        }

        .two-col {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .two-col td {
            border: none;
            vertical-align: top;
            padding: 0;
        }

        .col-left {
            width: 56%;
            padding-right: 8px;
        }

        .col-right {
            width: 44%;
            padding-left: 8px;
        }

        .spacer-8 {
            height: 8px;
        }
    </style>
</head>
<body>
@php
    $photoPath = $application->personal_photo
        ? public_path('storage/' . $application->personal_photo)
        : null;

    $govPath = $application->government_id
        ? public_path('storage/' . $application->government_id)
        : null;

    $govExt = $application->government_id
        ? strtolower(pathinfo($application->government_id, PATHINFO_EXTENSION))
        : null;

    $govIsImage = in_array($govExt, ['jpg', 'jpeg', 'png', 'webp']);

    // Palitan mo ito sa actual logo path mo
    $logoPath = public_path('images/logo.png');
@endphp

<div class="page">

    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                        <img style="width: 150px;" src="{{ public_path('img/logo.webp') }}" class="logo">

                    <div class="brand-name">Kape Ilokano Franchise Department</div>
                </td>
                <td class="title-cell">
                    <h1 class="document-title">Franchise Application</h1>
                    <p class="document-subtitle">
                        Official Applicant Record
                    </p>

                    <div class="meta-box">
                        <table class="meta-table">
                            <tr>
                                <td class="meta-label">Application No.</td>
                                <td>{{ $application->id }}</td>
                            </tr>
                            <tr>
                                <td class="meta-label">Submission Date</td>
                                <td>{{ $application->created_at->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <td class="meta-label">Submission Time</td>
                                <td>{{ $application->created_at->format('h:i A') }}</td>
                            </tr>
                            <tr>
                                <td class="meta-label">Applicant Email</td>
                                <td>{{ $application->email ?? '—' }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="summary-label">Applicant Name</div>
                <div class="summary-value">{{ $application->personal_full_name ?? '—' }}</div>
            </td>
            <td>
                <div class="summary-label">Lead Source</div>
                <div class="summary-value">{{ $application->lead_source ?? '—' }}</div>
            </td>
            <td>
                <div class="summary-label">Initial Consent</div>
                <div class="summary-value">
                    {{ $application->consent_intro ? 'Confirmed' : 'Not Confirmed' }}
                </div>
            </td>
            <td>
                <div class="summary-label">Final Consent</div>
                <div class="summary-value">
                    {{ $application->consent_final ? 'Confirmed' : 'Not Confirmed' }}
                </div>
            </td>
        </tr>
    </table>

    <div class="section">
        <div class="section-header">
            <p class="section-title">Initial Consent</p>
        </div>
        <div class="section-body">
            <table class="data-table">
                <tr>
                    <th>Consent Status</th>
                    <td>
                        <span class="status-badge {{ $application->consent_intro ? 'status-yes' : 'status-no' }}">
                            {{ $application->consent_intro ? 'Agreed' : 'Not Agreed' }}
                        </span>
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
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <p class="section-title">Personal Details</p>
        </div>
        <div class="section-body">
            @if($photoPath && file_exists($photoPath))
                <div class="photo-block">
                    <div class="photo-label">Applicant Photo</div>
                    <img src="{{ $photoPath }}" class="photo" alt="Personal Photo">
                </div>
            @endif

            <table class="data-table">
                <tr><th>Complete Name</th><td>{{ $application->personal_full_name ?? '—' }}</td></tr>
                <tr><th>Gender</th><td>{{ $application->personal_gender ?? '—' }}</td></tr>
                <tr><th>Civil Status</th><td>{{ $application->personal_civil_status ?? '—' }}</td></tr>
                <tr><th>Age</th><td>{{ $application->personal_age ?? '—' }}</td></tr>
                <tr><th>Country of Birth</th><td>{{ $application->personal_country_birth ?? '—' }}</td></tr>
                <tr><th>Nationality</th><td>{{ $application->personal_nationality ?? '—' }}</td></tr>
                <tr><th>Country of Residence</th><td>{{ $application->personal_residence ?? '—' }}</td></tr>
                <tr><th>Primary Address</th><td>{{ $application->personal_address ?? '—' }}</td></tr>
                <tr><th>Contact Number</th><td>{{ $application->personal_contact ?? '—' }}</td></tr>
                <tr><th>TIN</th><td>{{ $application->personal_tin ?? '—' }}</td></tr>
                <tr><th>Religion</th><td>{{ $application->personal_religion ?? '—' }}</td></tr>
                <tr><th>Hobbies</th><td>{{ $application->personal_hobbies ?? '—' }}</td></tr>
                <tr><th>Spouse</th><td>{{ $application->personal_spouse ?? '—' }}</td></tr>
                <tr><th>Dependents</th><td>{!! nl2br(e($application->personal_dependents ?? '—')) !!}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <p class="section-title">Professional Background</p>
        </div>
        <div class="section-body">
            <table class="data-table">
                <tr><th>Educational Attainment</th><td>{{ $application->professional_education ?? '—' }}</td></tr>
                <tr><th>School & Year</th><td>{{ $application->professional_school ?? '—' }}</td></tr>
                <tr><th>Employment Status</th><td>{{ $application->professional_employment ?? '—' }}</td></tr>
                <tr><th>Occupation</th><td>{{ $application->professional_occupation ?? '—' }}</td></tr>
                <tr><th>Job Title</th><td>{{ $application->professional_job_title ?? '—' }}</td></tr>
                <tr><th>Company</th><td>{{ $application->professional_company ?? '—' }}</td></tr>
                <tr><th>Years in Service</th><td>{{ $application->professional_years ?? '—' }}</td></tr>
                <tr><th>Company Address</th><td>{{ $application->professional_company_address ?? '—' }}</td></tr>
                <tr><th>Primary Responsibilities</th><td>{!! nl2br(e($application->professional_responsibilities ?? '—')) !!}</td></tr>
                <tr><th>Nature of Business</th><td>{{ $application->professional_business_nature ?? '—' }}</td></tr>
                <tr><th>Company Contact</th><td>{{ $application->professional_company_contact ?? '—' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <p class="section-title">Business Background</p>
        </div>
        <div class="section-body">
            <table class="data-table">
                <tr><th>Business Experience</th><td>{{ $application->business_experience ?? '—' }}</td></tr>
                <tr><th>Business Name</th><td>{{ $application->business_name ?? '—' }}</td></tr>
                <tr><th>Years of Experience</th><td>{{ $application->business_years ?? '—' }}</td></tr>
                <tr><th>Industry</th><td>{{ $application->business_industry ?? '—' }}</td></tr>
                <tr><th>Previously Closed Business</th><td>{{ $application->business_closed ?? '—' }}</td></tr>
                <tr><th>Reason for Closure</th><td>{!! nl2br(e($application->business_closure_reason ?? '—')) !!}</td></tr>
                <tr><th>Venture Description</th><td>{!! nl2br(e($application->business_venture_description ?? '—')) !!}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <p class="section-title">Kape Ilokano Background</p>
        </div>
        <div class="section-body">
            <table class="data-table">
                <tr><th>Existing Customer</th><td>{{ $application->ki_customer ?? '—' }}</td></tr>
                <tr><th>Affiliated with Any Branch</th><td>{{ $application->ki_affiliated ?? '—' }}</td></tr>
                <tr><th>Affiliation Details</th><td>{{ $application->ki_affiliated_details ?? '—' }}</td></tr>
                <tr><th>Has Existing Coffee Shop</th><td>{{ $application->ki_has_coffee_shop ?? '—' }}</td></tr>
                <tr><th>Knowledge in Coffee Industry</th><td>{{ $application->ki_industry_knowledge ?? '—' }}</td></tr>
                <tr><th>Passion for Coffee</th><td>{{ $application->ki_passion ?? '—' }}</td></tr>
                <tr><th>Eagerness Level</th><td>{{ $application->ki_eagerness ?? '—' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <p class="section-title">Business Proposal</p>
        </div>
        <div class="section-body">
            <table class="data-table">
                <tr><th>Preferred Location</th><td>{{ $application->proposal_location ?? '—' }}</td></tr>
                <tr><th>Reason for Location</th><td>{!! nl2br(e($application->proposal_reason ?? '—')) !!}</td></tr>
                <tr><th>Business Expectations</th><td>{!! nl2br(e($application->proposal_expectations ?? '—')) !!}</td></tr>
                <tr><th>Level of Involvement</th><td>{!! nl2br(e($application->proposal_involvement ?? '—')) !!}</td></tr>
                <tr><th>Management Philosophy</th><td>{!! nl2br(e($application->proposal_philosophy ?? '—')) !!}</td></tr>
                <tr><th>Other Business Interests</th><td>{!! nl2br(e($application->proposal_interests ?? '—')) !!}</td></tr>
                <tr><th>Socio-civic Affiliations</th><td>{!! nl2br(e($application->proposal_affiliations ?? '—')) !!}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <p class="section-title">Financial Information</p>
        </div>
        <div class="section-body">
            <table class="data-table">
                <tr><th>Planned Investment</th><td>{{ $application->financial_investment ?? '—' }}</td></tr>
                <tr><th>Expected Monthly Sales</th><td>{{ $application->financial_expected_sales ?? '—' }}</td></tr>
                <tr><th>Expected ROI</th><td>{{ $application->financial_roi ?? '—' }}</td></tr>
            </table>
        </div>
    </div>

    <table class="two-col">
        <tr>
            <td class="col-left">
                <div class="section">
                    <div class="section-header">
                        <p class="section-title">Character References</p>
                    </div>
                    <div class="section-body">
                        <div class="textbox">
                            {!! nl2br(e($application->references ?? '—')) !!}
                        </div>
                    </div>
                </div>
            </td>
            <td class="col-right">
                <div class="section">
                    <div class="section-header">
                        <p class="section-title">Final Consent</p>
                    </div>
                    <div class="section-body">
                        <table class="data-table">
                            <tr>
                                <th>Consent Status</th>
                                <td>
                                    <span class="status-badge {{ $application->consent_final ? 'status-yes' : 'status-no' }}">
                                        {{ $application->consent_final ? 'Agreed' : 'Not Agreed' }}
                                    </span>
                                </td>
                            </tr>
                        </table>

                        <div class="spacer-8"></div>

                        @if($govPath && file_exists($govPath) && $govIsImage)
                            <div class="photo-block" style="border-bottom:none;">
                                <div class="photo-label">Government ID</div>
                                <img src="{{ $govPath }}" class="id-photo" alt="Government ID">
                            </div>
                        @elseif($application->government_id)
                            <div class="note-box muted">
                                Uploaded file: {{ basename($application->government_id) }}
                            </div>
                        @else
                            <div class="note-box muted">
                                No government ID file attached.
                            </div>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Kape Ilokano Franchise Application Record · Generated on {{ now()->format('M d, Y h:i A') }}
    </div>

</div>
</body>
</html>