<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('franchise_applications', function (Blueprint $table) {
        $table->dateTime('site_visit_schedule')->nullable()->after('proposal_affiliations');
        $table->string('site_visit_confirmation')->nullable()->after('site_visit_schedule');
        $table->string('site_visit_evaluator')->nullable()->after('site_visit_confirmation');
        $table->string('site_visit_building_type')->nullable()->after('site_visit_evaluator');
        $table->string('site_visit_lease_term')->nullable()->after('site_visit_building_type');
        $table->string('site_visit_monthly_rent')->nullable()->after('site_visit_lease_term');
    });
}

public function down(): void
{
    Schema::table('franchise_applications', function (Blueprint $table) {
        $table->dropColumn([
            'site_visit_schedule',
            'site_visit_confirmation',
            'site_visit_evaluator',
            'site_visit_building_type',
            'site_visit_lease_term',
            'site_visit_monthly_rent',
        ]);
    });
}
};
