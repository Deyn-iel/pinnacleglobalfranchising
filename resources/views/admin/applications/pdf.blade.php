<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Franchise Application #{{ $application->id }}</title>

<style>
    @page {
        margin: 20mm 16mm 18mm 16mm;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
        line-height: 1.5;
        color: #111827;
        margin: 0;
        padding: 0;
        background: #ffffff;
    }

    .header {
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 1px solid #d1d5db;
    }

    .header-title {
        font-size: 18px;
        font-weight: bold;
        margin: 0 0 4px 0;
        color: #111827;
    }

    .header-sub {
        font-size: 10px;
        margin: 0;
        color: #6b7280;
    }

    .section {
        margin-bottom: 18px;
        page-break-inside: avoid;
    }

    .section-title {
        font-size: 13px;
        font-weight: bold;
        color: #111827;
        margin: 0 0 8px 0;
        padding-bottom: 4px;
        border-bottom: 1px solid #e5e7eb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    th,
    td {
        padding: 7px 8px;
        vertical-align: top;
        text-align: left;
        border: 1px solid #e5e7eb;
        word-wrap: break-word;
    }

    th {
        width: 30%;
        font-weight: bold;
        background: #f9fafb;
        color: #111827;
    }

    td {
        background: #ffffff;
        color: #111827;
    }

    .badge {
        display: inline-block;
        padding: 2px 8px;
        font-size: 10px;
        font-weight: bold;
        border: 1px solid #d1d5db;
        border-radius: 2px;
        color: #111827;
        background: #f9fafb;
    }

    .yes {
        background: #f3f4f6;
        color: #111827;
        border-color: #d1d5db;
    }

    .no {
        background: #f3f4f6;
        color: #111827;
        border-color: #d1d5db;
    }

    .textbox {
        border: 1px solid #e5e7eb;
        padding: 10px 12px;
        background: #ffffff;
        min-height: 38px;
        white-space: normal;
        word-wrap: break-word;
    }

    .image-wrap {
        margin: 8px 0 12px 0;
    }

    .image-label {
        font-size: 10px;
        font-weight: bold;
        margin-bottom: 6px;
        color: #374151;
    }

    .image {
        width: 120px;
        height: auto;
        border: 1px solid #d1d5db;
        padding: 3px;
        background: #ffffff;
    }

    .muted {
        color: #6b7280;
        font-size: 10px;
    }

    .footer {
        margin-top: 24px;
        padding-top: 8px;
        border-top: 1px solid #e5e7eb;
        text-align: center;
        font-size: 10px;
        color: #6b7280;
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
@endphp

<div class="header">
    <div class="header-title">Franchise Application</div>
    <p class="header-sub">
        Application #{{ $application->id }} · Submitted on {{ $application->created_at->format('M d, Y · h:i A') }}
    </p>
</div>

<div class="section">
    <div class="section-title">Initial Consent</div>
    <table>
        <tr>
            <th>Agreed</th>
            <td>
                <span class="badge {{ $application->consent_intro ? 'yes' : 'no' }}">
                    {{ $application->consent_intro ? 'Yes' : 'No' }}
                </span>
            </td>
        </tr>
        <tr><th>Email</th><td>{{ $application->email ?? '—' }}</td></tr>
        <tr><th>Lead Source</th><td>{{ $application->lead_source ?? '—' }}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Personal Details</div>

    @if($photoPath && file_exists($photoPath))
        <div class="image-wrap">
            <div class="image-label">Uploaded Photo</div>
            <img src="{{ $photoPath }}" class="image" alt="Personal Photo">
        </div>
    @endif

    <table>
        <tr><th>Complete Name</th><td>{{ $application->personal_full_name ?? '—' }}</td></tr>
        <tr><th>Gender</th><td>{{ $application->personal_gender ?? '—' }}</td></tr>
        <tr><th>Civil Status</th><td>{{ $application->personal_civil_status ?? '—' }}</td></tr>
        <tr><th>Age</th><td>{{ $application->personal_age ?? '—' }}</td></tr>
        <tr><th>Country of Birth</th><td>{{ $application->personal_country_birth ?? '—' }}</td></tr>
        <tr><th>Nationality</th><td>{{ $application->personal_nationality ?? '—' }}</td></tr>
        <tr><th>Country of Residence</th><td>{{ $application->personal_residence ?? '—' }}</td></tr>
        <tr><th>Primary Address</th><td>{{ $application->personal_address ?? '—' }}</td></tr>
        <tr><th>Contact</th><td>{{ $application->personal_contact ?? '—' }}</td></tr>
        <tr><th>TIN</th><td>{{ $application->personal_tin ?? '—' }}</td></tr>
        <tr><th>Religion</th><td>{{ $application->personal_religion ?? '—' }}</td></tr>
        <tr><th>Hobbies</th><td>{{ $application->personal_hobbies ?? '—' }}</td></tr>
        <tr><th>Spouse</th><td>{{ $application->personal_spouse ?? '—' }}</td></tr>
        <tr><th>Dependents</th><td>{!! nl2br(e($application->personal_dependents ?? '—')) !!}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Professional Background</div>
    <table>
        <tr><th>Education</th><td>{{ $application->professional_education ?? '—' }}</td></tr>
        <tr><th>School & Year</th><td>{{ $application->professional_school ?? '—' }}</td></tr>
        <tr><th>Employment</th><td>{{ $application->professional_employment ?? '—' }}</td></tr>
        <tr><th>Occupation</th><td>{{ $application->professional_occupation ?? '—' }}</td></tr>
        <tr><th>Job Title</th><td>{{ $application->professional_job_title ?? '—' }}</td></tr>
        <tr><th>Company</th><td>{{ $application->professional_company ?? '—' }}</td></tr>
        <tr><th>Years</th><td>{{ $application->professional_years ?? '—' }}</td></tr>
        <tr><th>Company Address</th><td>{{ $application->professional_company_address ?? '—' }}</td></tr>
        <tr><th>Responsibilities</th><td>{!! nl2br(e($application->professional_responsibilities ?? '—')) !!}</td></tr>
        <tr><th>Nature of Business</th><td>{{ $application->professional_business_nature ?? '—' }}</td></tr>
        <tr><th>Company Contact</th><td>{{ $application->professional_company_contact ?? '—' }}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Business Background</div>
    <table>
        <tr><th>Business Experience</th><td>{{ $application->business_experience ?? '—' }}</td></tr>
        <tr><th>Business Name</th><td>{{ $application->business_name ?? '—' }}</td></tr>
        <tr><th>Years of Experience</th><td>{{ $application->business_years ?? '—' }}</td></tr>
        <tr><th>Industry</th><td>{{ $application->business_industry ?? '—' }}</td></tr>
        <tr><th>Closed Business?</th><td>{{ $application->business_closed ?? '—' }}</td></tr>
        <tr><th>Closure Reason</th><td>{!! nl2br(e($application->business_closure_reason ?? '—')) !!}</td></tr>
        <tr><th>Venture Description</th><td>{!! nl2br(e($application->business_venture_description ?? '—')) !!}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Kape-Ilokano Background</div>
    <table>
        <tr><th>Customer of Kape-Ilokano?</th><td>{{ $application->ki_customer ?? '—' }}</td></tr>
        <tr><th>Affiliated with Any Branch?</th><td>{{ $application->ki_affiliated ?? '—' }}</td></tr>
        <tr><th>Affiliation Details</th><td>{{ $application->ki_affiliated_details ?? '—' }}</td></tr>
        <tr><th>Has Existing Coffee Shop?</th><td>{{ $application->ki_has_coffee_shop ?? '—' }}</td></tr>
        <tr><th>Knowledge in Coffee Industry?</th><td>{{ $application->ki_industry_knowledge ?? '—' }}</td></tr>
        <tr><th>Passion for Coffee?</th><td>{{ $application->ki_passion ?? '—' }}</td></tr>
        <tr><th>Eagerness Level</th><td>{{ $application->ki_eagerness ?? '—' }}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Business Proposal</div>
    <table>
        <tr><th>Target Location</th><td>{{ $application->proposal_location ?? '—' }}</td></tr>
        <tr><th>Reason</th><td>{!! nl2br(e($application->proposal_reason ?? '—')) !!}</td></tr>
        <tr><th>Expectations</th><td>{!! nl2br(e($application->proposal_expectations ?? '—')) !!}</td></tr>
        <tr><th>Involvement</th><td>{!! nl2br(e($application->proposal_involvement ?? '—')) !!}</td></tr>
        <tr><th>Management Philosophy</th><td>{!! nl2br(e($application->proposal_philosophy ?? '—')) !!}</td></tr>
        <tr><th>Other Business Interests</th><td>{!! nl2br(e($application->proposal_interests ?? '—')) !!}</td></tr>
        <tr><th>Socio-civic Affiliations</th><td>{!! nl2br(e($application->proposal_affiliations ?? '—')) !!}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Financial Information</div>
    <table>
        <tr><th>Investment</th><td>{{ $application->financial_investment ?? '—' }}</td></tr>
        <tr><th>Expected Sales</th><td>{{ $application->financial_expected_sales ?? '—' }}</td></tr>
        <tr><th>ROI</th><td>{{ $application->financial_roi ?? '—' }}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Character References</div>
    <div class="textbox">
        {!! nl2br(e($application->references ?? '—')) !!}
    </div>
</div>

<div class="section">
    <div class="section-title">Final Consent</div>
    <table>
        <tr>
            <th>Final Consent</th>
            <td>
                <span class="badge {{ $application->consent_final ? 'yes' : 'no' }}">
                    {{ $application->consent_final ? 'Agreed' : 'Not Agreed' }}
                </span>
            </td>
        </tr>
    </table>

    @if($govPath && file_exists($govPath) && $govIsImage)
        <div class="image-wrap">
            <div class="image-label">Government ID</div>
            <img src="{{ $govPath }}" class="image" alt="Government ID">
        </div>
    @elseif($application->government_id)
        <div class="textbox muted">
            Government ID file uploaded: {{ basename($application->government_id) }}
        </div>
    @endif
</div>

<div class="footer">
    Generated from Admin Dashboard
</div>

</body>
</html>