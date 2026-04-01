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

        // ✅ para malaman kung nag request na ng approval
        $table->boolean('approval_requested')->default(false)->after('status');

        // ✅ kailan nag request
        $table->timestamp('approval_requested_at')->nullable()->after('approval_requested');

        // ✅ reason pag dinecline ng user
        $table->text('approval_decline_reason')->nullable()->after('approval_requested_at');

        // ✅ kailan in-accept ng user
        $table->timestamp('approved_at')->nullable()->after('approval_decline_reason');

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('tickets', function (Blueprint $table) {

        $table->dropColumn([
            'approval_requested',
            'approval_requested_at',
            'approval_decline_reason',
            'approved_at'
        ]);

    });
}
};
