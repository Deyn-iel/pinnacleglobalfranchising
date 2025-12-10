<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('franchise_applications', function (Blueprint $table) {
            $table->id();

            // ---------------------------------------------
            // INTRO SECTION
            // ---------------------------------------------
            $table->boolean('consent_intro')->default(false);
            $table->string('email');
            $table->string('lead_source');

            // ---------------------------------------------
            // PERSONAL DETAILS
            // ---------------------------------------------
            $table->string('personal_full_name');
            $table->string('personal_photo')->nullable();
            $table->string('personal_gender');
            $table->string('personal_civil_status');
            $table->integer('personal_age');
            $table->string('personal_country_birth');
            $table->string('personal_nationality');
            $table->string('personal_residence')->nullable();
            $table->string('personal_address');
            $table->string('personal_contact');
            $table->string('personal_tin');
            $table->string('personal_religion');
            $table->string('personal_hobbies')->nullable();
            $table->string('personal_spouse')->nullable();
            $table->text('personal_dependents');

            // ---------------------------------------------
            // PROFESSIONAL BACKGROUND
            // ---------------------------------------------
            $table->string('professional_education');
            $table->string('professional_school');
            $table->string('professional_employment');
            $table->string('professional_occupation');
            $table->string('professional_job_title');
            $table->string('professional_company');
            $table->string('professional_years');
            $table->string('professional_company_address');
            $table->text('professional_responsibilities');
            $table->string('professional_business_nature')->nullable();
            $table->string('professional_company_contact');

            // ---------------------------------------------
            // BUSINESS BACKGROUND
            // ---------------------------------------------
            $table->string('business_experience');
            $table->string('business_name')->nullable();
            $table->string('business_years')->nullable();
            $table->string('business_industry')->nullable();
            $table->string('business_closed')->nullable();
            $table->text('business_closure_reason')->nullable();
            $table->text('business_venture_description')->nullable();

            // ---------------------------------------------
            // KAPE-ILOKANO BACKGROUND
            // ---------------------------------------------
            $table->string('ki_customer');
            $table->string('ki_affiliated');
            $table->string('ki_affiliated_details')->nullable();
            $table->string('ki_has_coffee_shop')->nullable();
            $table->string('ki_industry_knowledge')->nullable();
            $table->string('ki_passion')->nullable();
            $table->integer('ki_eagerness')->nullable();

            // ---------------------------------------------
            // BUSINESS PROPOSAL
            // ---------------------------------------------
            $table->string('proposal_location');
            $table->text('proposal_reason');
            $table->text('proposal_expectations');
            $table->text('proposal_involvement');
            $table->text('proposal_philosophy');
            $table->text('proposal_interests');
            $table->text('proposal_affiliations');

            // ---------------------------------------------
            // FINANCIAL
            // ---------------------------------------------
            $table->string('financial_investment');
            $table->string('financial_expected_sales');
            $table->string('financial_roi');

            // ---------------------------------------------
            // CHARACTER REFERENCES
            // ---------------------------------------------
            $table->text('references')->nullable();

            // ---------------------------------------------
            // FINAL CONSENT
            // ---------------------------------------------
            $table->boolean('consent_final')->default(false);
            $table->string('government_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchise_applications');
    }
};
