<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application #{{ $application->id }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                ← Back to Dashboard
            </a>
        </div>
    </nav>

    <div class="container mb-5">

        <h2 class="mb-2">Application #{{ $application->id }}</h2>
        <p><b>Date submitted:</b> {{ $application->created_at->format('M d, Y') }}</p>

        <hr>

        <!-- CONSENT INTRO -->
        <h4>Initial Consent</h4>
        <p><b>Agreed:</b> {{ $application->consent_intro ? 'Yes' : 'No' }}</p>
        <table class="table table-bordered table-sm">
        <tr><th>Email</th><td>{{ $application->email }}</td></tr>
        <tr><th>Lead Source</th><td>{{ $application->lead_source }}</td></tr>
        </table>

        <hr>

        <!-- PERSONAL DETAILS -->
        <h4>Personal Details</h4>
        <table class="table table-bordered table-sm">
            <tr><th width="250">Complete Name</th><td>{{ $application->personal_full_name }}</td></tr>
            @if($application->personal_photo)
            <p><b>Uploaded Photo:</b></p>
            <img src="{{ asset('storage/' . $application->personal_photo) }}" width="180" 
                 class="rounded shadow mb-4 border">
        @endif
            <tr><th>Gender</th><td>{{ $application->personal_gender }}</td></tr>
            <tr><th>Civil Status</th><td>{{ $application->personal_civil_status }}</td></tr>
            <tr><th>Age</th><td>{{ $application->personal_age }}</td></tr>
            <tr><th>Country of Birth</th><td>{{ $application->personal_country_birth }}</td></tr>
            <tr><th>Nationality</th><td>{{ $application->personal_nationality }}</td></tr>
            <tr><th>Current Residence</th><td>{{ $application->personal_residence }}</td></tr>
            <tr><th>Primary Home Address</th><td>{{ $application->personal_address }}</td></tr>
            <tr><th>Mobile or Residence Number</th><td>{{ $application->personal_contact }}</td></tr>
            <tr><th>TIN</th><td>{{ $application->personal_tin }}</td></tr>
            <tr><th>Religion</th><td>{{ $application->personal_religion }}</td></tr>
            <tr><th>Hobbies</th><td>{{ $application->personal_hobbies }}</td></tr>
            <tr><th>Spouse</th><td>{{ $application->personal_spouse }}</td></tr>
            <tr><th>Dependents</th><td>{{ $application->personal_dependents }}</td></tr>
            
        </table>

        <hr>

        <!-- PROFESSIONAL BACKGROUND -->
        <h4>Professional Background</h4>
        <table class="table table-bordered table-sm">
            <tr><th width="250">Educational Attainment</th><td>{{ $application->professional_education }}</td></tr>
            <tr><th>School Attended & Year Attended</th><td>{{ $application->professional_school }}</td></tr>
            <tr><th>Employment</th><td>{{ $application->professional_employment }}</td></tr>
            <tr><th>Present Occupation and Position</th><td>{{ $application->professional_occupation }}</td></tr>
            <tr><th>Job Title</th><td>{{ $application->professional_job_title }}</td></tr>
            <tr><th>Name of Company</th><td>{{ $application->professional_company }}</td></tr>
            <tr><th>Years in Company</th><td>{{ $application->professional_years }}</td></tr>
            <tr><th>Company Address</th><td>{{ $application->professional_company_address }}</td></tr>
            <tr><th>Responsibilities</th><td>{{ $application->professional_responsibilities }}</td></tr>
            <tr><th>Nature of Business</th><td>{{ $application->professional_business_nature }}</td></tr>
            <tr><th>Company Contact</th><td>{{ $application->professional_company_contact }}</td></tr>
        </table>

        <hr>

        <!-- BUSINESS BACKGROUND -->
        <h4>Business Background</h4>
        <table class="table table-bordered table-sm">
            <tr><th width="250">Experience in PH Business</th><td>{{ $application->business_experience }}</td></tr>
            <tr><th>Business Name</th><td>{{ $application->business_name }}</td></tr>
            <tr><th>Years of experience in Business</th><td>{{ $application->business_years }}</td></tr>
            <tr><th>Business Industry</th><td>{{ $application->business_industry }}</td></tr>
            <tr><th>closed or discontinued a business?</th><td>{{ $application->business_closed }}</td></tr>
            <tr><th>Closure Reason</th><td>{{ $application->business_closure_reason }}</td></tr>
            <tr><th>Venture Description</th><td>{{ $application->business_venture_description }}</td></tr>
        </table>

        <hr>

        <!-- KAPE-ILOKANO SECTION -->
        <h4>Kape-Ilokano Background</h4>
        <table class="table table-bordered table-sm">
            <tr><th width="250">Customer of Kape Ilokano?</th><td>{{ $application->ki_customer }}</td></tr>
            <tr><th>Affiliated?</th><td>{{ $application->ki_affiliated }}</td></tr>
            <tr><th>If yes, Affiliation Details</th><td>{{ $application->ki_affiliated_details }}</td></tr>
            <tr><th>Has Coffee Shop?</th><td>{{ $application->ki_has_coffee_shop }}</td></tr>
            <tr><th>Knowledge of Coffee Industry?</th><td>{{ $application->ki_industry_knowledge }}</td></tr>
            <tr><th>Passion for Coffee?</th><td>{{ $application->ki_passion }}</td></tr>
            <tr><th>Eagerness (1–10)</th><td>{{ $application->ki_eagerness }}</td></tr>
        </table>

        <hr>

        <!-- PROPOSAL -->
        <h4>Business Proposal</h4>
        <table class="table table-bordered table-sm">
            <tr><th width="250">Target Location</th><td>{{ $application->proposal_location }}</td></tr>
            <tr><th>Reason for considering a Kape-Ilokano Cafe Franchise</th><td>{{ $application->proposal_reason }}</td></tr>
            <tr><th>Expectations</th><td>{{ $application->proposal_expectations }}</td></tr>
            <tr><th>Involvement</th><td>{{ $application->proposal_involvement }}</td></tr>
            <tr><th>Management Philosophy</th><td>{{ $application->proposal_philosophy }}</td></tr>
            <tr><th>Other Interests</th><td>{{ $application->proposal_interests }}</td></tr>
            <tr><th>Socio-civic Affiliations</th><td>{{ $application->proposal_affiliations }}</td></tr>
        </table>

        <hr>

        <!-- FINANCIAL INFO -->
        <h4>Financial Information</h4>
        <table class="table table-bordered table-sm">
            <tr><th width="250">Investment</th><td>{{ $application->financial_investment }}</td></tr>
            <tr><th>Expected Daily Sales</th><td>{{ $application->financial_expected_sales }}</td></tr>
            <tr><th>ROI Timeline</th><td>{{ $application->financial_roi }}</td></tr>
        </table>

        <hr>

        <!-- CHARACTER REFERENCES -->
        <h4>Character References</h4>
        <div class="p-3 bg-white border rounded">
            {!! nl2br(e($application->references)) !!}
        </div>

        <hr>

        <!-- FINAL CONSENT -->
        <h4>Final Consent</h4>
        <p><b>Agreed:</b> {{ $application->consent_final ? 'Yes' : 'No' }}</p>

        <!-- GOVERNMENT ID -->
        @if($application->government_id)
            <p><b>Government ID:</b></p>
            <a href="{{ asset('storage/' . $application->government_id) }}" target="_blank" class="btn btn-info btn-sm">
                View Uploaded ID
            </a>
        @endif

        <hr class="mb-5">

        <!-- BACK BUTTON -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            ← Back to Dashboard
        </a>

    </div>

</body>
</html>
