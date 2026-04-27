<style>
    .franchise-modal .modal-xl {
        max-width: 1150px;
    }

    .franchise-modal .modal-dialog {
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.franchise-modal .modal-content {
    border: none;
    border-radius: 14px;
    overflow: hidden;
    max-height: calc(100vh - 2rem);
    display: flex;
    flex-direction: column;
}

.franchise-modal form {
    display: flex;
    flex-direction: column;
    min-height: 0;
}

.franchise-modal .modal-body {
    flex: 1 1 auto;
    overflow-y: auto;
    padding: 22px 26px 130px;
    background: #ffffff;
}

.franchise-modal .modal-footer {
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    position: sticky;
    bottom: 0;
    z-index: 10;
}

    .franchise-modal .modal-header {
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        padding: 18px 22px;
    }

    .franchise-modal .form-main-title {
        text-align: center;
        font-weight: 900;
        font-size: 21px;
        margin-bottom: 22px;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .franchise-modal .section-title {
        font-weight: 900;
        font-size: 15px;
        margin-top: 25px;
        margin-bottom: 14px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e5e7eb;
        text-transform: uppercase;
    }

    .franchise-modal label {
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 5px;
        color: #111827;
    }

    .franchise-modal .line-input {
        border: none;
        border-bottom: 1px solid #64748b;
        border-radius: 0;
        padding-left: 0;
        background: transparent;
        font-size: 14px;
    }

    .franchise-modal .line-input:focus {
        box-shadow: none;
        border-color: #2563eb;
        background: transparent;
    }

    .franchise-modal .package-row {
        display: grid;
        grid-template-columns: 28px minmax(280px, 1fr) 270px;
        gap: 12px;
        align-items: center;
        padding: 9px 0;
        border-bottom: 1px dashed #e5e7eb;
    }

    .franchise-modal .package-row.no-count {
        grid-template-columns: 28px minmax(280px, 1fr) 270px;
    }

    .franchise-modal .package-label {
        font-size: 14px;
        font-weight: 700;
        margin: 0;
    }

    .franchise-modal .package-count {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: flex-end;
    }

    .franchise-modal .package-count span {
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .franchise-modal .package-count input {
        max-width: 110px;
    }

    .franchise-modal .terms-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 18px;
    font-size: 14px;
    line-height: 1.55;
}

    .franchise-modal .terms-box ol {
        margin-bottom: 0;
        padding-left: 20px;
    }

    .franchise-modal .terms-box ul {
        margin-top: 6px;
        margin-bottom: 0;
        padding-left: 20px;
    }

    .franchise-modal .payment-options {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        margin-top: 8px;
    }

    .franchise-modal .signature-area {
        margin-top: 35px;
        display: grid;
        grid-template-columns: 1fr 240px;
        gap: 45px;
        align-items: end;
    }

    .franchise-modal .signature-label {
        text-align: center;
        font-size: 13px;
        font-weight: 700;
        margin-top: 6px;
    }

    .franchise-modal .divider {
        border-top: 2px dashed #94a3b8;
        margin: 35px 0 25px;
    }

    .franchise-modal .office-only {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 12px;
        padding: 22px;
    }

    .franchise-modal .office-title {
        font-weight: 900;
        color: #9a3412;
        margin-bottom: 18px;
        text-transform: uppercase;
    }

    .franchise-modal .office-signatures {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-top: 25px;
    }

    .franchise-modal .office-label {
        text-align: center;
        font-size: 13px;
        font-weight: 800;
        margin-top: 6px;
    }

    .franchise-modal .office-label-light {
        text-align: center;
        font-size: 13px;
        margin-top: 3px;
        color: #374151;
    }

    .franchise-modal .office-date {
        margin-top: 13px;
    }

    .franchise-modal .text-error {
        color: #dc2626;
        font-size: 12px;
        margin-top: 4px;
    }

    .franchise-modal .form-check-input {
        cursor: pointer;
    }

    @media(max-width: 768px) {
    .franchise-modal .modal-body {
        padding: 18px 18px 130px;
    }

        .franchise-modal .package-row,
        .franchise-modal .package-row.no-count {
            grid-template-columns: 26px 1fr;
        }

        .franchise-modal .package-count {
            grid-column: 2 / 3;
            justify-content: flex-start;
            margin-top: 4px;
        }

        .franchise-modal .signature-area,
        .franchise-modal .office-signatures {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="modal fade franchise-modal" id="franchiseReservationModal" tabindex="-1" aria-labelledby="franchiseReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.portals.od.register-franchise.store') }}">
                @csrf

                <input type="hidden" name="_form" value="franchise_reservation">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="franchiseReservationModalLabel">
                        <i class="fa-solid fa-file-signature"></i>
                        Franchise Reservation Form
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    @if($errors->any() && old('_form') === 'franchise_reservation')
                        <div class="alert alert-danger">
                            <strong>Please check the following:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-main-title">
                        ANNEX A - Franchise Reservation Form
                    </div>

                    {{-- DATE --}}
                    <div class="row mb-4">
                        <div class="col-md-4 ms-auto">
                            <label for="reservation_date">DATE:</label>
                            <input 
                                type="date" 
                                name="date" 
                                id="reservation_date" 
                                class="form-control line-input"
                                value="{{ old('date') }}"
                            >
                            @error('date')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- I. APPLICANT INFO --}}
                    <div class="section-title">
                        I. Franchise Applicant Information
                    </div>

                    <div class="mb-3">
                        <label for="franchise_name">Full Name of Applicant:</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="franchise_name" 
                            class="form-control line-input"
                            value="{{ old('name') }}"
                        >
                        @error('name')
                            <div class="text-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="franchise_address">Residential Address:</label>
                        <input 
                            type="text" 
                            name="address" 
                            id="franchise_address" 
                            class="form-control line-input"
                            value="{{ old('address') }}"
                        >
                        @error('address')
                            <div class="text-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="franchise_contact">Contact Number:</label>
                            <input 
                                type="text" 
                                name="contact" 
                                id="franchise_contact" 
                                class="form-control line-input"
                                value="{{ old('contact') }}"
                            >
                            @error('contact')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="franchise_email">Email Address:</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="franchise_email" 
                                class="form-control line-input"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- II. RESERVED PACKAGE --}}
                    <div class="section-title">
                        II. Reserved Franchise Package
                    </div>

                    @error('package')
                        <div class="alert alert-danger py-2">{{ $message }}</div>
                    @enderror

                    {{-- KIOSK --}}
                    <div class="package-row">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_kiosk" 
                            value="kiosk" 
                            class="form-check-input"
                            {{ in_array('kiosk', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_kiosk" class="package-label">
                            Kiosk - 150k
                        </label>

                        <div class="package-count">
                            <span>Number of Franchise Availed:</span>
                            <input 
                                type="number" 
                                name="package_count[kiosk]" 
                                min="0" 
                                class="form-control form-control-sm"
                                value="{{ old('package_count.kiosk') }}"
                            >
                        </div>
                    </div>

                    {{-- INLINE CAFE --}}
                    <div class="package-row no-count">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_inline_cafe" 
                            value="inline_cafe" 
                            class="form-check-input"
                            {{ in_array('inline_cafe', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_inline_cafe" class="package-label">
                            In-Line Café
                        </label>

                        <div></div>

                        <input 
                            type="hidden" 
                            name="package_count[inline_cafe]" 
                            value="{{ old('package_count.inline_cafe', 1) }}"
                        >
                    </div>

                    {{-- SMALL --}}
                    <div class="package-row">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_small" 
                            value="small" 
                            class="form-check-input"
                            {{ in_array('small', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_small" class="package-label">
                            Small - 45sqm to 74sqm - 350k
                        </label>

                        <div class="package-count">
                            <span>Number of Franchise Availed:</span>
                            <input 
                                type="number" 
                                name="package_count[small]" 
                                min="0" 
                                class="form-control form-control-sm"
                                value="{{ old('package_count.small') }}"
                            >
                        </div>
                    </div>

                    {{-- MEDIUM --}}
                    <div class="package-row">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_medium" 
                            value="medium" 
                            class="form-check-input"
                            {{ in_array('medium', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_medium" class="package-label">
                            Medium - 75sqm to 100sqm - 500k
                        </label>

                        <div class="package-count">
                            <span>Number of Franchise Availed:</span>
                            <input 
                                type="number" 
                                name="package_count[medium]" 
                                min="0" 
                                class="form-control form-control-sm"
                                value="{{ old('package_count.medium') }}"
                            >
                        </div>
                    </div>

                    {{-- LARGE --}}
                    <div class="package-row">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_large" 
                            value="large" 
                            class="form-check-input"
                            {{ in_array('large', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_large" class="package-label">
                            Large - 100sqm and up sqm - 750k
                        </label>

                        <div class="package-count">
                            <span>Number of Franchise Availed:</span>
                            <input 
                                type="number" 
                                name="package_count[large]" 
                                min="0" 
                                class="form-control form-control-sm"
                                value="{{ old('package_count.large') }}"
                            >
                        </div>
                    </div>

                    {{-- SIT-DOWN --}}
                    <div class="package-row">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_sitdown" 
                            value="sitdown" 
                            class="form-check-input"
                            {{ in_array('sitdown', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_sitdown" class="package-label">
                            Sit-Down Café - 150k
                        </label>

                        <div class="package-count">
                            <span>Number of Franchise Availed:</span>
                            <input 
                                type="number" 
                                name="package_count[sitdown]" 
                                min="0" 
                                class="form-control form-control-sm"
                                value="{{ old('package_count.sitdown') }}"
                            >
                        </div>
                    </div>

                    {{-- FOOD TRUCK --}}
                    <div class="package-row no-count">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_foodtruck" 
                            value="foodtruck" 
                            class="form-check-input"
                            {{ in_array('foodtruck', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_foodtruck" class="package-label">
                            Food Truck - 150k
                        </label>

                        <div></div>

                        <input 
                            type="hidden" 
                            name="package_count[foodtruck]" 
                            value="{{ old('package_count.foodtruck', 1) }}"
                        >
                    </div>

                    {{-- FLEXIBLE --}}
                    <div class="package-row">
                        <input 
                            type="checkbox" 
                            name="package[]" 
                            id="pkg_flexible" 
                            value="flexible" 
                            class="form-check-input"
                            {{ in_array('flexible', old('package', [])) ? 'checked' : '' }}
                        >

                        <label for="pkg_flexible" class="package-label">
                            Flexible Package - Coupon / Flat Rate 350k
                        </label>

                        <div class="package-count">
                            <span>Number of Franchise Availed:</span>
                            <input 
                                type="number" 
                                name="package_count[flexible]" 
                                min="0" 
                                class="form-control form-control-sm"
                                value="{{ old('package_count.flexible') }}"
                            >
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8 mb-3">
                            <label for="franchise_location">
                                Preferred Location Municipality / Province:
                            </label>
                            <input 
                                type="text" 
                                name="location" 
                                id="franchise_location" 
                                class="form-control line-input"
                                value="{{ old('location') }}"
                            >
                            @error('location')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <div class="form-check mb-2">
                                <input 
                                    type="checkbox" 
                                    name="location_tba" 
                                    id="location_tba" 
                                    value="1" 
                                    class="form-check-input"
                                    {{ old('location_tba') ? 'checked' : '' }}
                                >
                                <label for="location_tba" class="form-check-label">
                                    TBA
                                </label>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="franchise_total">
                                Total Number Availed:
                            </label>
                            <input 
                                type="number" 
                                name="total" 
                                id="franchise_total" 
                                min="0"
                                class="form-control line-input"
                                value="{{ old('total', 0) }}"
                                readonly
                            >

                            <small class="text-muted d-block mt-1">
                                Fee: <strong id="reservation_fee_display">₱0.00</strong>
                            </small>
                        </div>
                    </div>

                    {{-- III. TERMS --}}
                    <div class="section-title">
                        III. Reservation Terms & Conditions
                    </div>

                    <div class="terms-box">
                        <ol>
                            <li>
                               A non-refundable Reservation Fee of 
                                <strong id="terms_reservation_fee_display">₱0.00</strong>
                                is required to secure the franchise slot/area for a maximum period of 90 days.
                            </li>
                            <li>
                                The franchise applicant is only given 90 days from the date of reservation to secure an approved location.
                            </li>
                            <li>
                                Should the applicant fail to submit an approved site within the given period, Pinnacle Global Franchising Group Inc. reserves the right to cancel the reservation.
                            </li>
                            <li>
                                The Reservation Fee will be credited to the Franchise Fee balance upon finalization of the Franchise Agreement.
                            </li>
                            <li>
                                All documents required for application must be submitted prior to awarding the franchise:
                                <ul>
                                    <li>Application Form via G-Form</li>
                                    <li>Letter of Intent</li>
                                    <li>Duly Signed Reservation Form with attached proof of payment</li>
                                    <li>Duly Approved Location Approval Request Form / LARF</li>
                                    <li>Executed Lease Contract</li>
                                    <li>Government IDs and Business Name Registration</li>
                                    <li>Duly Signed and Executed Franchise Package Confirmation</li>
                                    <li>Duly Signed and Executed Franchise Agreement</li>
                                </ul>
                            </li>
                        </ol>
                    </div>

                    {{-- IV. PAYMENT --}}
                    <div class="section-title">
                        IV. Payment Details
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="franchise_fee">
                                Reservation Fee Paid:
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input 
                                    type="number" 
                                    name="fee" 
                                    id="franchise_fee" 
                                    min="0"
                                    step="0.01"
                                    class="form-control"
                                    value="{{ old('fee', 0) }}"
                                    readonly
                                >

                                <small class="text-muted d-block mt-1">
                                    Auto-computed: ₱25,000 x Total Number Availed
                                </small>
                            </div>
                            @error('fee')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="check_no">
                                Check No. if applicable:
                            </label>
                            <input 
                                type="text" 
                                name="check_no" 
                                id="check_no" 
                                class="form-control line-input"
                                value="{{ old('check_no') }}"
                            >
                            @error('check_no')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <label>Mode of Payment:</label>
                    <div class="payment-options">
                        <div class="form-check">
                            <input 
                                type="radio" 
                                name="payment_mode" 
                                id="payment_cash" 
                                value="Cash" 
                                class="form-check-input"
                                {{ old('payment_mode') === 'Cash' ? 'checked' : '' }}
                            >
                            <label for="payment_cash" class="form-check-label">Cash</label>
                        </div>

                        <div class="form-check">
                            <input 
                                type="radio" 
                                name="payment_mode" 
                                id="payment_gcash" 
                                value="GCash" 
                                class="form-check-input"
                                {{ old('payment_mode') === 'GCash' ? 'checked' : '' }}
                            >
                            <label for="payment_gcash" class="form-check-label">Gcash</label>
                        </div>

                        <div class="form-check">
                            <input 
                                type="radio" 
                                name="payment_mode" 
                                id="payment_bank_deposit" 
                                value="Bank Deposit" 
                                class="form-check-input"
                                {{ old('payment_mode') === 'Bank Deposit' ? 'checked' : '' }}
                            >
                            <label for="payment_bank_deposit" class="form-check-label">Bank Deposit</label>
                        </div>

                        <div class="form-check">
                            <input 
                                type="radio" 
                                name="payment_mode" 
                                id="payment_bank_transfer" 
                                value="Bank Transfer" 
                                class="form-check-input"
                                {{ old('payment_mode') === 'Bank Transfer' ? 'checked' : '' }}
                            >
                            <label for="payment_bank_transfer" class="form-check-label">Bank Transfer</label>
                        </div>

                        <div class="form-check">
                            <input 
                                type="radio" 
                                name="payment_mode" 
                                id="payment_check" 
                                value="Check" 
                                class="form-check-input"
                                {{ old('payment_mode') === 'Check' ? 'checked' : '' }}
                            >
                            <label for="payment_check" class="form-check-label">Check</label>
                        </div>
                    </div>

                    @error('payment_mode')
                        <div class="text-error">{{ $message }}</div>
                    @enderror

                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <label>Payee:</label>
                            <input 
                                type="text" 
                                class="form-control line-input" 
                                value="Pinnacle Global Franchising Group Inc." 
                                readonly
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Bank:</label>
                            <input 
                                type="text" 
                                class="form-control line-input" 
                                value="RCBC 7591-149-263" 
                                readonly
                            >
                        </div>
                    </div>

                    {{-- V. DECLARATION --}}
                    <div class="section-title">
                        V. Declaration
                    </div>

                    <p class="mb-4">
                        I hereby certify that the above details are true and correct. I understand and accept the terms and conditions of this franchise reservation.
                    </p>

                    <div class="signature-area">
                        <div>
                            <input 
                                type="text" 
                                name="signature" 
                                class="form-control line-input text-center"
                                value="{{ old('signature') }}"
                            >
                            <div class="signature-label">
                                Franchisee’s Complete Name & Signature
                            </div>
                            @error('signature')
                                <div class="text-error text-center">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input 
                                type="date" 
                                name="signature_date" 
                                class="form-control line-input text-center"
                                value="{{ old('signature_date') }}"
                            >
                            <div class="signature-label">
                                Date
                            </div>
                            @error('signature_date')
                                <div class="text-error text-center">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- OFFICE USE ONLY --}}
                    <div class="office-only">
                        <div class="office-title">
                            F. For Kape-Ilokano Use Only
                            <span class="fw-normal">
                                (Do not fill out this portion)
                            </span>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="official_receipt_no">
                                    Official Receipt No.:
                                </label>
                                <input 
                                    type="text" 
                                    name="official_receipt_no" 
                                    id="official_receipt_no" 
                                    class="form-control line-input"
                                    value="{{ old('official_receipt_no') }}"
                                >
                            </div>
                        </div>

                        <div class="office-signatures">
                            <div>
                                <input 
                                    type="text" 
                                    name="receipt_issued_by" 
                                    class="form-control line-input text-center"
                                    value="{{ old('receipt_issued_by') }}"
                                >
                                <div class="office-label">Receipt Issued By</div>
                                <div class="office-label-light">Accounting Department</div>

                                <div class="office-date">
                                    <label>Date:</label>
                                    <input 
                                        type="date" 
                                        name="receipt_issued_date" 
                                        class="form-control line-input"
                                        value="{{ old('receipt_issued_date') }}"
                                    >
                                </div>
                            </div>

                            <div>
                                <input 
                                    type="text" 
                                    name="reviewed_by" 
                                    class="form-control line-input text-center"
                                    value="{{ old('reviewed_by') }}"
                                >
                                <div class="office-label">Reviewed By</div>
                                <div class="office-label-light">Admin</div>

                                <div class="office-date">
                                    <label>Date:</label>
                                    <input 
                                        type="date" 
                                        name="reviewed_date" 
                                        class="form-control line-input"
                                        value="{{ old('reviewed_date') }}"
                                    >
                                </div>
                            </div>

                            <div>
                                <input 
                                    type="text" 
                                    name="endorsed_by" 
                                    class="form-control line-input text-center"
                                    value="{{ old('endorsed_by') }}"
                                >
                                <div class="office-label">Endorsed By</div>
                                <div class="office-label-light">Chairman</div>

                                <div class="office-date">
                                    <label>Date:</label>
                                    <input 
                                        type="date" 
                                        name="endorsed_date" 
                                        class="form-control line-input"
                                        value="{{ old('endorsed_date') }}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Submit Reservation
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('franchiseReservationModal');
        const totalInput = document.getElementById('franchise_total');
        const feeInput = document.getElementById('franchise_fee');
        const feeDisplay = document.getElementById('reservation_fee_display');
        const termsFeeDisplay = document.getElementById('terms_reservation_fee_display');

        const reservationFeePerFranchise = 25000;

        function formatPeso(amount) {
            return new Intl.NumberFormat('en-PH', {
                style: 'currency',
                currency: 'PHP'
            }).format(amount);
        }

        function computeFranchiseTotalAndFee() {
            let total = 0;

            if (!modal || !totalInput || !feeInput) {
                return;
            }

            modal.querySelectorAll('.package-row').forEach(function (row) {
                const checkbox = row.querySelector('input[name="package[]"]');

                if (!checkbox || !checkbox.checked) {
                    return;
                }

                const countInput = row.querySelector('input[name^="package_count"]');

                if (countInput) {
                    total += parseInt(countInput.value || 0);
                }
            });

            const computedFee = total * reservationFeePerFranchise;

            totalInput.value = total;
            feeInput.value = computedFee;

            if (feeDisplay) {
                feeDisplay.textContent = formatPeso(computedFee);
            }

            if (termsFeeDisplay) {
                termsFeeDisplay.textContent = formatPeso(computedFee);
            }
        }

        if (modal) {
            modal.querySelectorAll('input[name="package[]"], input[name^="package_count"]').forEach(function (input) {
                input.addEventListener('change', computeFranchiseTotalAndFee);
                input.addEventListener('input', computeFranchiseTotalAndFee);
            });

            computeFranchiseTotalAndFee();
        }

        @if($errors->any() && old('_form') === 'franchise_reservation')
            const modalElement = document.getElementById('franchiseReservationModal');

            if (modalElement) {
                const reservationModal = new bootstrap.Modal(modalElement);
                reservationModal.show();
            }
        @endif
    });
</script>