<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            if (!Schema::hasColumn('claims', 'claim_key')) {
                $table->string('claim_key', 255)->nullable()->after('claim_type');
            }

            $table->index(['claim_key', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropIndex('claims_claim_key_created_at_index');

            if (Schema::hasColumn('claims', 'claim_key')) {
                $table->dropColumn('claim_key');
            }

        });
    }
};