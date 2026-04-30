<style>
    .app-section {
        background: #ffffff;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, .08);
        margin-bottom: 16px;
    }

    .app-section-title {
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 12px;
        border-left: 4px solid #0d6efd;
        padding-left: 12px;
        line-height: 1.3;
    }

    .app-table {
        margin-bottom: 0;
        width: 100%;
        table-layout: fixed;
    }

    .app-table th {
        width: 240px;
        background: #f8fafc;
        font-weight: 700;
        white-space: normal;
    }

    .app-table th,
    .app-table td {
        vertical-align: top;
        word-break: break-word;
    }

    .badge {
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 10px;
        border-radius: 999px;
    }

    .badge-yes {
        background: #22c55e;
    }

    .badge-no {
        background: #ef4444;
    }

    .file-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    @media (max-width: 991.98px) {
        .app-section {
            padding: 14px;
            border-radius: 14px;
        }

        .app-table th {
            width: 180px;
        }
    }

    @media (max-width: 767.98px) {
        .app-section {
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .app-section-title {
            font-size: 15px;
            margin-bottom: 10px;
            padding-left: 10px;
        }

        .app-table,
        .app-table tbody,
        .app-table tr,
        .app-table th,
        .app-table td {
            display: block;
            width: 100%;
        }

        .app-table tr {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .app-table tr:last-child {
            margin-bottom: 0;
        }

        .app-table th {
            width: 100%;
            border: 0;
            padding: 10px 12px 6px;
            background: #f8fafc;
            font-size: 13px;
        }

        .app-table td {
            border: 0;
            padding: 0 12px 10px;
        }

        .file-btn {
            width: 100%;
            justify-content: center;
        }
    }

    .download-pdf-btn {
        position: relative;
        overflow: hidden;
    }

    .download-spinner {
        display: none;
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255, 255, 255, .45);
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spinDownload .8s linear infinite;
    }

    .download-pdf-btn.is-downloading {
        pointer-events: none;
        opacity: .85;
    }

    .download-pdf-btn.is-downloading .download-spinner {
        display: inline-block;
    }

    .download-pdf-btn.is-downloading .download-label {
        content: "Preparing...";
    }

    @keyframes spinDownload {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div>
    <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <div class="fw-bold fs-5">Application No.{{ $application->id }}</div>
            <div class="text-muted small">
                Submitted on {{ $application->created_at->format('M d, Y · h:i A') }}
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.applications.print', $application->id) }}"
            target="_blank"
            class="btn btn-dark btn-sm file-btn">
            <i class="fas fa-print me-1"></i>
            Print A4
        </a>

        <a href="{{ route('admin.applications.pdf', $application->id) }}"
            class="btn btn-primary btn-sm file-btn download-pdf-btn">
            <i class="fas fa-file-pdf me-1"></i>
            <span class="download-label">Download PDF</span>
            <span class="download-spinner"></span>
        </a>
        </div>
    </div>

    <div class="app-section">
        <div class="app-section-title">Initial Consent</div>
        <table class="table table-bordered app-table mb-0">
            <tr>
                <th>Agreed</th>
                <td>
                    <span class="badge {{ $application->consent_intro ? 'badge-yes' : 'badge-no' }}">
                        {{ $application->consent_intro ? 'Yes' : 'No' }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $application->email ?? '—' }}</td>
            </tr>
            <tr>
                <th>Brand</th>
                <td>{{ $application->brand ?? 'Kape-Ilokano' }}</td>
            </tr>
            <tr>
                <th>Lead Source</th>
                <td>{{ $application->lead_source ?? '—' }}</td>
            </tr>
        </table>
    </div>

    <div class="app-section">
        <div class="app-section-title">Personal Details</div>

        @if ($application->personal_photo)
            <a href="{{ asset('storage/' . $application->personal_photo) }}" target="_blank"
                class="btn btn-outline-primary btn-sm mb-3 file-btn">
                📷 View Uploaded Photo
            </a>
        @endif

        <table class="table table-bordered app-table mb-0">
            <tr>
                <th>Complete Name</th>
                <td>{{ $application->personal_full_name ?? '—' }}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>{{ $application->personal_gender ?? '—' }}</td>
            </tr>
            <tr>
                <th>Civil Status</th>
                <td>{{ $application->personal_civil_status ?? '—' }}</td>
            </tr>
            <tr>
                <th>Age</th>
                <td>{{ $application->personal_age ?? '—' }}</td>
            </tr>
            <tr>
                <th>Country of Birth</th>
                <td>{{ $application->personal_country_birth ?? '—' }}</td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>{{ $application->personal_nationality ?? '—' }}</td>
            </tr>
            <tr>
                <th>Country of Residence</th>
                <td>{{ $application->personal_residence ?? '—' }}</td>
            </tr>
            <tr>
                <th>Primary Address</th>
                <td>{{ $application->personal_address ?? '—' }}</td>
            </tr>
            <tr>
                <th>Mobile or Residence Number</th>
                <td>{{ $application->personal_contact ?? '—' }}</td>
            </tr>
            <tr>
                <th>TIN</th>
                <td>{{ $application->personal_tin ?? '—' }}</td>
            </tr>
            <tr>
                <th>Religion</th>
                <td>{{ $application->personal_religion ?? '—' }}</td>
            </tr>
            <tr>
                <th>Hobbies</th>
                <td>{{ $application->personal_hobbies ?? '—' }}</td>
            </tr>
            <tr>
                <th>Spouse/Partner's Name</th>
                <td>{{ $application->personal_spouse ?? '—' }}</td>
            </tr>
            <tr>
                <th>Dependents</th>
                <td>{!! nl2br(e($application->personal_dependents ?? '—')) !!}</td>
            </tr>
        </table>
    </div>

    <div class="app-section">
        <div class="app-section-title">Professional Background</div>
        <table class="table table-bordered app-table mb-0">
            <tr>
                <th>Educational Attainment</th>
                <td>{{ $application->professional_education ?? '—' }}</td>
            </tr>
            <tr>
                <th>School & Year</th>
                <td>{{ $application->professional_school ?? '—' }}</td>
            </tr>
            <tr>
                <th>Employment</th>
                <td>{{ $application->professional_employment ?? '—' }}</td>
            </tr>
            <tr>
                <th>Present Occupation & Position</th>
                <td>{{ $application->professional_occupation ?? '—' }}</td>
            </tr>
            <tr>
                <th>Job Title</th>
                <td>{{ $application->professional_job_title ?? '—' }}</td>
            </tr>
            <tr>
                <th>Name of Company / Business</th>
                <td>{{ $application->professional_company ?? '—' }}</td>
            </tr>
            <tr>
                <th>Number of Years in the Company/Business</th>
                <td>{{ $application->professional_years ?? '—' }}</td>
            </tr>
            <tr>
                <th>Company Address</th>
                <td>{{ $application->professional_company_address ?? '—' }}</td>
            </tr>
            <tr>
                <th>Responsibilities</th>
                <td>{!! nl2br(e($application->professional_responsibilities ?? '—')) !!}</td>
            </tr>
            <tr>
                <th>Nature of Business</th>
                <td>{{ $application->professional_business_nature ?? '—' }}</td>
            </tr>
            <tr>
                <th>Company Contact Number</th>
                <td>{{ $application->professional_company_contact ?? '—' }}</td>
            </tr>
        </table>
    </div>

    <div class="app-section">
        <div class="app-section-title">Business Background</div>
        <table class="table table-bordered app-table mb-0">
            <tr>
                <th>Business Experience</th>
                <td>{{ $application->business_experience ?? '—' }}</td>
            </tr>
            <tr>
                <th>Business Name</th>
                <td>{{ $application->business_name ?? '—' }}</td>
            </tr>
            <tr>
                <th>Years of Experience</th>
                <td>{{ $application->business_years ?? '—' }}</td>
            </tr>
            <tr>
                <th>Business Industry</th>
                <td>{{ $application->business_industry ?? '—' }}</td>
            </tr>
            <tr>
                <th>Closed Business?</th>
                <td>{{ $application->business_closed ?? '—' }}</td>
            </tr>
            <tr>
                <th>Closure Reason</th>
                <td>{!! nl2br(e($application->business_closure_reason ?? '—')) !!}</td>
            </tr>
            <tr>
                <th>Venture Description</th>
                <td>{!! nl2br(e($application->business_venture_description ?? '—')) !!}</td>
            </tr>
        </table>
    </div>

    <div class="app-section">
        <div class="app-section-title">Brand Background</div>
        <table class="table table-bordered app-table mb-0">
            <tr>
                <th>Customer of Brand?</th>
                <td>{{ $application->ki_customer ?? '—' }}</td>
            </tr>
            <tr>
                <th>Affiliated with Any Branch?</th>
                <td>{{ $application->ki_affiliated ?? '—' }}</td>
            </tr>
            <tr>
                <th>Affiliation Details</th>
                <td>{{ $application->ki_affiliated_details ?? '—' }}</td>
            </tr>
            <tr>
                <th>Has Existing Food or Beverage Business?</th>
                <td>{{ $application->ki_has_coffee_shop ?? '—' }}</td>
            </tr>
            <tr>
                <th>Knowledge in Food and Beverage Industry?</th>
                <td>{{ $application->ki_industry_knowledge ?? '—' }}</td>
            </tr>
            <tr>
                <th>Passion for Brand Products?</th>
                <td>{{ $application->ki_passion ?? '—' }}</td>
            </tr>
            <tr>
                <th>Eagerness Level</th>
                <td>{{ $application->ki_eagerness ?? '—' }}</td>
            </tr>
        </table>
    </div>

    <div class="app-section">
        <div class="app-section-title">Business Proposal</div>
        <table class="table table-bordered app-table mb-0">
            <tr>
                <th>Target Location</th>
                <td>{{ $application->proposal_location ?? '—' }}</td>
            </tr>
            <tr>
                <th>Considering This Franchise</th>
                <td>{!! nl2br(e($application->proposal_reason ?? '—')) !!}</td>
            </tr>
            <tr>
                <th>Expectations in Having This Franchise</th>
                <td>{!! nl2br(e($application->proposal_expectations ?? '—')) !!}</td>
            </tr>
            <tr>
                <th>Involvement</th>
                <td>{!! nl2br(e($application->proposal_involvement ?? '—')) !!}</td>
            </tr>
            <tr>
                <th>Management Philosophy</th>
                <td>{!! nl2br(e($application->proposal_philosophy ?? '—')) !!}</td>
            </tr>
            <tr>
                <th>Other Business Interests</th>
                <td>{!! nl2br(e($application->proposal_interests ?? '—')) !!}</td>
            </tr>
            <tr>
                <th>Socio-civic Affiliations</th>
                <td>{!! nl2br(e($application->proposal_affiliations ?? '—')) !!}</td>
            </tr>
        </table>
    </div>

    <div class="app-section">
        <div class="app-section-title">Financial Information</div>
        <table class="table table-bordered app-table mb-0">
            <tr>
                <th>Investment</th>
                <td>{{ $application->financial_investment ?? '—' }}</td>
            </tr>
            <tr>
                <th>Expected daily Sales</th>
                <td>{{ $application->financial_expected_sales ?? '—' }}</td>
            </tr>
            <tr>
                <th>Expected ROI timeline</th>
                <td>{{ $application->financial_roi ?? '—' }}</td>
            </tr>
        </table>
    </div>

    <div class="app-section">
        <div class="app-section-title">Character References</div>
        <div class="border rounded p-3 bg-light">
            {!! nl2br(e($application->references ?? '—')) !!}
        </div>
    </div>

    <div class="app-section mb-0">
        <div class="app-section-title">Final Consent</div>
        <p class="mb-2">
            <span class="badge {{ $application->consent_final ? 'badge-yes' : 'badge-no' }}">
                {{ $application->consent_final ? 'Agreed' : 'Not Agreed' }}
            </span>
        </p>

        @if ($application->government_id)
            <a href="{{ asset('storage/' . $application->government_id) }}" target="_blank"
                class="btn btn-outline-info btn-sm file-btn">
                🪪 View Government ID
            </a>
        @endif
    </div>
</div>
