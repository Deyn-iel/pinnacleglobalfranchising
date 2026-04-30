<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseApplication extends Model
{
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function franchiseReservation()
    {
        return $this->belongsTo(FranchiseReservation::class);
    }

    protected $fillable = [

        'status',
        'brand',
        'appointment_date',
        'appointment_time',
        'meeting_type',
        'meeting_link',
        'meeting_remarks',
        'discovery_done_at',
        'voucher_option',
        'coupon_id',
        'franchisee_registered_at',
        'agreement_printed_at',
        'payment_reference_no',
        'sales_invoice_no',
        'payment_confirmed_at',
        'franchise_reservation_id',
        'assigned_to',

        // Intro
        'consent_intro',
        'email',
        'lead_source',

        // Personal Details
        'personal_full_name',
        'personal_photo',
        'personal_gender',
        'personal_civil_status',
        'personal_age',
        'personal_country_birth',
        'personal_nationality',
        'personal_residence',
        'personal_address',
        'personal_contact',
        'personal_tin',
        'personal_religion',
        'personal_hobbies',
        'personal_spouse',
        'personal_dependents',

        // Professional Background
        'professional_education',
        'professional_school',
        'professional_employment',
        'professional_occupation',
        'professional_job_title',
        'professional_company',
        'professional_years',
        'professional_company_address',
        'professional_responsibilities',
        'professional_business_nature',
        'professional_company_contact',

        // Business Background
        'business_experience',
        'business_name',
        'business_years',
        'business_industry',
        'business_closed',
        'business_closure_reason',
        'business_venture_description',

        // Kape-Ilokano Background
        'ki_customer',
        'ki_affiliated',
        'ki_affiliated_details',
        'ki_has_coffee_shop',
        'ki_industry_knowledge',
        'ki_passion',
        'ki_eagerness',

        // Business Proposal
        'proposal_location',
        'proposal_reason',
        'proposal_expectations',
        'proposal_involvement',
        'proposal_philosophy',
        'proposal_interests',
        'proposal_affiliations',

        // Financial
        'financial_investment',
        'financial_expected_sales',
        'financial_roi',

        // Character references
        'references',

        // Final consent
        'consent_final',
        'government_id',
    ];

    protected $casts = [
        'discovery_done_at' => 'datetime',
        'franchisee_registered_at' => 'datetime',
        'agreement_printed_at' => 'datetime',
        'payment_confirmed_at' => 'datetime',
    ];
}
