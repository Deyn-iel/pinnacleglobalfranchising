<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FranchiseApplication;

class FranchiseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Intro
            'consent_intro' => 'required',
            'email' => 'required|email',
            'lead_source' => 'required|string',

            // Personal Details
            'personal_full_name' => 'required|string',
            'personal_photo' => 'nullable|file|mimes:jpg,jpeg,png,webp',
            'personal_gender' => 'required|string',
            'personal_civil_status' => 'required|string',
            'personal_age' => 'required|integer|between:1,120',
            'personal_country_birth' => 'required',
            'personal_nationality' => 'required',
            'personal_residence' => 'nullable|string',
            'personal_address' => 'required|string',
            'personal_contact' => 'required|string',
            'personal_tin' => 'required|string',
            'personal_religion' => 'required|string',
            'personal_hobbies' => 'nullable|string',
            'personal_spouse' => 'nullable|string',
            'personal_dependents' => 'required|string',

            // Professional Background
            'professional_education' => 'required|string',
            'professional_school' => 'required|string',
            'professional_employment' => 'required|string',
            'professional_occupation' => 'required|string',
            'professional_job_title' => 'required|string',
            'professional_company' => 'required|string',
            'professional_years' => 'required|string',
            'professional_company_address' => 'required|string',
            'professional_responsibilities' => 'required|string',
            'professional_business_nature' => 'nullable|string',
            'professional_company_contact' => 'required|string',

            // Business Background
            'business_experience' => 'required',
            'business_name' => 'nullable|string',
            'business_years' => 'nullable|string',
            'business_industry' => 'nullable|string',
            'business_closed' => 'nullable|string',
            'business_closure_reason' => 'nullable|string',
            'business_venture_description' => 'nullable|string',

            // Kape-Ilokano Background
            'ki_customer' => 'required|string',
            'ki_affiliated' => 'required|string',
            'ki_affiliated_details' => 'nullable|string',
            'ki_has_coffee_shop' => 'nullable|string',
            'ki_industry_knowledge' => 'nullable|string',
            'ki_passion' => 'nullable|string',
            'ki_eagerness' => 'nullable|integer',

            // Proposal
            'proposal_location' => 'required|string',
            'proposal_reason' => 'required|string',
            'proposal_expectations' => 'required|string',
            'proposal_involvement' => 'required|string',
            'proposal_philosophy' => 'required|string',
            'proposal_interests' => 'required|string',
            'proposal_affiliations' => 'required|string',

            // Financial
            'financial_investment' => 'required|string',
            'financial_expected_sales' => 'required|string',
            'financial_roi' => 'required|string',

            // Character References
            'references' => 'nullable|string',

            // Final consent
            'consent_final' => 'required',
            'government_id' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf',
        ]);

        // Convert checkboxes from "on" → 1
    $validated['consent_intro'] = $request->has('consent_intro') ? 1 : 0;
    $validated['consent_final'] = $request->has('consent_final') ? 1 : 0;

    // File uploads
    if ($request->hasFile('personal_photo')) {
        $validated['personal_photo'] = $request->file('personal_photo')->store('profile_photos', 'public');
    }

    if ($request->hasFile('government_id')) {
        $validated['government_id'] = $request->file('government_id')->store('ids', 'public');
    }

    FranchiseApplication::create($validated);

    return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
