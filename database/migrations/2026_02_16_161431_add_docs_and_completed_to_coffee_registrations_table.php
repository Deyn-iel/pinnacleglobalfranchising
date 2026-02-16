<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coffee_registrations', function (Blueprint $table) {
            $table->string('request_approval_path')->nullable();
            $table->string('travel_order_path')->nullable();
            $table->string('registration_ticket_path')->nullable();
            $table->timestamp('completed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('coffee_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'request_approval_path',
                'travel_order_path',
                'registration_ticket_path',
                'completed_at',
            ]);
        });
    }
};
