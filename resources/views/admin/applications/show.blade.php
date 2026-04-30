<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Application #{{ $application->id }}</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #f5f6fa;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }

    /* ================= LAYOUT ================= */
    .wrapper {
        max-width: 1200px;
        margin: auto;
        padding: 24px;
    }

    /* ================= HEADER ================= */
    .page-header {
        background: #ffffff;
        padding: 24px;
        border-radius: 18px;
        box-shadow: 0 14px 34px rgba(15,23,42,.08);
        margin-bottom: 26px;
    }

    .page-header h2 {
        font-weight: 800;
        margin-bottom: 4px;
    }

    /* ================= SECTIONS ================= */
    .section {
        background: #ffffff;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 14px 34px rgba(15,23,42,.08);
        margin-bottom: 26px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 16px;
        border-left: 4px solid #0d6efd;
        padding-left: 12px;
    }

    /* ================= TABLE ================= */
    table {
        font-size: 14px;
    }

    th {
        width: 260px;
        background: #f8fafc;
        font-weight: 600;
    }

    td {
        background: #ffffff;
    }

    /* ================= BADGES ================= */
    .badge-yes {
        background: #22c55e;
    }

    .badge-no {
        background: #ef4444;
    }

    /* ================= FILE BUTTON ================= */
    .file-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
</style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.application') }}">
            ← Back to Admin Dashboard
        </a>
    </div>
</nav>

<div class="wrapper">

    <!-- HEADER -->
    <div class="page-header">
        <h2>Application #{{ $application->id }}</h2>
        <p class="text-muted mb-0">
            Submitted on {{ $application->created_at->format('M d, Y · h:i A') }}
        </p>
    </div>

    <!-- INITIAL CONSENT -->
    <div class="section">
        <div class="section-title">Initial Consent</div>
        <table class="table table-bordered">
            <tr>
                <th>Agreed</th>
                <td>
                    <span class="badge {{ $application->consent_intro ? 'badge-yes' : 'badge-no' }}">
                        {{ $application->consent_intro ? 'Yes' : 'No' }}
                    </span>
                </td>
            </tr>
            <tr><th>Email</th><td>{{ $application->email }}</td></tr>
            <tr><th>Brand</th><td>{{ $application->brand ?? 'Kape-Ilokano' }}</td></tr>
            <tr><th>Lead Source</th><td>{{ $application->lead_source }}</td></tr>
        </table>
    </div>

    <!-- PERSONAL DETAILS -->
    <div class="section">
        <div class="section-title">Personal Details</div>

        @if($application->personal_photo)
            <a href="{{ asset('storage/'.$application->personal_photo) }}"
               target="_blank"
               class="btn btn-outline-primary btn-sm mb-3 file-btn">
                📷 View Uploaded Photo
            </a>
        @endif

        <table class="table table-bordered">
            <tr><th>Complete Name</th><td>{{ $application->personal_full_name }}</td></tr>
            <tr><th>Gender</th><td>{{ $application->personal_gender }}</td></tr>
            <tr><th>Civil Status</th><td>{{ $application->personal_civil_status }}</td></tr>
            <tr><th>Age</th><td>{{ $application->personal_age }}</td></tr>
            <tr><th>Country of Birth</th><td>{{ $application->personal_country_birth }}</td></tr>
            <tr><th>Nationality</th><td>{{ $application->personal_nationality }}</td></tr>
            <tr><th>Residence</th><td>{{ $application->personal_residence }}</td></tr>
            <tr><th>Address</th><td>{{ $application->personal_address }}</td></tr>
            <tr><th>Contact</th><td>{{ $application->personal_contact }}</td></tr>
            <tr><th>TIN</th><td>{{ $application->personal_tin }}</td></tr>
            <tr><th>Religion</th><td>{{ $application->personal_religion }}</td></tr>
            <tr><th>Hobbies</th><td>{{ $application->personal_hobbies }}</td></tr>
            <tr><th>Spouse</th><td>{{ $application->personal_spouse }}</td></tr>
            <tr><th>Dependents</th><td>{{ $application->personal_dependents }}</td></tr>
        </table>
    </div>

    <!-- PROFESSIONAL -->
    <div class="section">
        <div class="section-title">Professional Background</div>
        <table class="table table-bordered">
            <tr><th>Education</th><td>{{ $application->professional_education }}</td></tr>
            <tr><th>School & Year</th><td>{{ $application->professional_school }}</td></tr>
            <tr><th>Employment</th><td>{{ $application->professional_employment }}</td></tr>
            <tr><th>Position</th><td>{{ $application->professional_occupation }}</td></tr>
            <tr><th>Company</th><td>{{ $application->professional_company }}</td></tr>
            <tr><th>Years</th><td>{{ $application->professional_years }}</td></tr>
            <tr><th>Responsibilities</th><td>{{ $application->professional_responsibilities }}</td></tr>
        </table>
    </div>

    <!-- BUSINESS -->
    <div class="section">
        <div class="section-title">Business Background</div>
        <table class="table table-bordered">
            <tr><th>Business Experience</th><td>{{ $application->business_experience }}</td></tr>
            <tr><th>Business Name</th><td>{{ $application->business_name }}</td></tr>
            <tr><th>Industry</th><td>{{ $application->business_industry }}</td></tr>
            <tr><th>Closed Business?</th><td>{{ $application->business_closed }}</td></tr>
            <tr><th>Closure Reason</th><td>{{ $application->business_closure_reason }}</td></tr>
        </table>
    </div>

    <!-- PROPOSAL -->
    <div class="section">
        <div class="section-title">Business Proposal</div>
        <table class="table table-bordered">
            <tr><th>Target Location</th><td>{{ $application->proposal_location }}</td></tr>
            <tr><th>Reason</th><td>{{ $application->proposal_reason }}</td></tr>
            <tr><th>Expectations</th><td>{{ $application->proposal_expectations }}</td></tr>
            <tr><th>Involvement</th><td>{{ $application->proposal_involvement }}</td></tr>
        </table>
    </div>

    <!-- FINANCIAL -->
    <div class="section">
        <div class="section-title">Financial Information</div>
        <table class="table table-bordered">
            <tr><th>Investment</th><td>{{ $application->financial_investment }}</td></tr>
            <tr><th>Expected Sales</th><td>{{ $application->financial_expected_sales }}</td></tr>
            <tr><th>ROI</th><td>{{ $application->financial_roi }}</td></tr>
        </table>
    </div>

    <!-- REFERENCES -->
    <div class="section">
        <div class="section-title">Character References</div>
        <div class="border rounded p-3 bg-light">
            {!! nl2br(e($application->references)) !!}
        </div>
    </div>

    <!-- FINAL CONSENT -->
    <div class="section">
        <div class="section-title">Final Consent</div>
        <p>
            <span class="badge {{ $application->consent_final ? 'badge-yes' : 'badge-no' }}">
                {{ $application->consent_final ? 'Agreed' : 'Not Agreed' }}
            </span>
        </p>

        @if($application->government_id)
            <a href="{{ asset('storage/'.$application->government_id) }}"
               target="_blank"
               class="btn btn-outline-info btn-sm file-btn mt-2">
                🪪 View Government ID
            </a>
        @endif
    </div>

    <a href="{{ route('admin.application') }}" class="btn btn-secondary">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>
