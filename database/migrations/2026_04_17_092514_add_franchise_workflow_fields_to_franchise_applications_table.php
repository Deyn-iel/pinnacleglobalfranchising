<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('franchise_applications', function (Blueprint $table) {

            $table->string('status')->default('Review in Progress')->after('government_id');

            $table->date('appointment_date')->nullable()->after('status');
            $table->time('appointment_time')->nullable()->after('appointment_date');
            $table->string('meeting_type')->nullable()->after('appointment_time');
            $table->string('meeting_link')->nullable()->after('meeting_type');
            $table->text('meeting_remarks')->nullable()->after('meeting_link');

            // MODULE 7 Discovery Meeting
            $table->timestamp('discovery_done_at')->nullable()->after('meeting_remarks');

            // MODULE 6 Internal Assignment
            $table->string('assigned_to')->nullable()->after('discovery_done_at');
        });
    }

    public function down(): void
    {
        Schema::table('franchise_applications', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'appointment_date',
                'appointment_time',
                'meeting_type',
                'meeting_link',
                'meeting_remarks',
                'discovery_done_at',
                'assigned_to',
            ]);
        });
    }
};
