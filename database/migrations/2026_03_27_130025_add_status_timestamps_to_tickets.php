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
    Schema::table('tickets', function (Blueprint $table) {
        $table->timestamp('in_progress_at')->nullable()->after('status');
        $table->timestamp('resolved_at')->nullable()->after('in_progress_at');
    });
}

public function down(): void
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropColumn(['in_progress_at','resolved_at']);
    });
}
};
