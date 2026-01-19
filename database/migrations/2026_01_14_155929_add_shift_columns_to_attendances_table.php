<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            // MORNING
            $table->timestamp('morning_in')->nullable();
            $table->string('morning_in_selfie')->nullable();

            $table->timestamp('morning_out')->nullable();
            $table->string('morning_out_selfie')->nullable();

            // AFTERNOON
            $table->timestamp('afternoon_in')->nullable();
            $table->string('afternoon_in_selfie')->nullable();

            $table->timestamp('afternoon_out')->nullable();
            $table->string('afternoon_out_selfie')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn([
                'morning_in',
                'morning_in_selfie',
                'morning_out',
                'morning_out_selfie',
                'afternoon_in',
                'afternoon_in_selfie',
                'afternoon_out',
                'afternoon_out_selfie',
            ]);
        });
    }
};
