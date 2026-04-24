<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('tickets', function (Blueprint $table) {

        if (!Schema::hasColumn('tickets', 'pending_at')) {
            $table->timestamp('pending_at')->nullable()->after('status');
        }

        if (!Schema::hasColumn('tickets', 'in_progress_at')) {
            $table->timestamp('in_progress_at')->nullable()->after('pending_at');
        }

        if (!Schema::hasColumn('tickets', 'resolved_at')) {
            $table->timestamp('resolved_at')->nullable()->after('in_progress_at');
        }

    });
}

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {

            $table->dropColumn([
                'pending_at',
                'in_progress_at',
                'resolved_at'
            ]);

        });
    }
};
