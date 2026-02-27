<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            // Add claim_key only if missing
            if (!Schema::hasColumn('claims', 'claim_key')) {
                // 255 is usually enough for your key and safer for indexing
                $table->string('claim_key', 255)->nullable()->after('claim_type');
            }

            // occurrence already exists in your DB, so DO NOT add it again
            // If you want to keep it safe anyway:
            // if (!Schema::hasColumn('claims', 'occurrence')) {
            //     $table->unsignedInteger('occurrence')->default(1)->after('claim_key');
            // }

            // Add index (will fail only if this exact index already exists)
            $table->index(['claim_key', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            // drop index name is auto-generated; safest is to drop by name:
            // If your DB auto-named it, it will likely be: claims_claim_key_created_at_index
            $table->dropIndex('claims_claim_key_created_at_index');

            if (Schema::hasColumn('claims', 'claim_key')) {
                $table->dropColumn('claim_key');
            }

            // do NOT drop occurrence if it was pre-existing in your schema
        });
    }
};