<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coffee_registrations', function (Blueprint $table) {
            $table->enum('status', ['Pending','Approved','Rejected','Confirmed'])
                  ->default('Pending')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('coffee_registrations', function (Blueprint $table) {
            $table->enum('status', ['Pending','Approved','Rejected'])
                  ->default('Pending')
                  ->change();
        });
    }
};
