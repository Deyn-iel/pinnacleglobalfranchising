<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Give explicit names para madaling i-drop
    private string $idxTarget = 'support_messages_target_user_id_index';
    private string $idxTargetId = 'support_messages_target_user_id_id_index';

    public function up(): void
    {
        if (!Schema::hasTable('support_messages')) {
            return;
        }

        Schema::table('support_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('support_messages', 'target_user_id')) {
                $table->unsignedBigInteger('target_user_id')->after('user_id');
            }
            $table->index('target_user_id', $this->idxTarget);
            $table->index(['target_user_id', 'id'], $this->idxTargetId);
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('support_messages')) {
            return;
        }
        Schema::table('support_messages', function (Blueprint $table) {
            $table->dropIndex($this->idxTarget);
            $table->dropIndex($this->idxTargetId);

            if (Schema::hasColumn('support_messages', 'target_user_id')) {
                $table->dropColumn('target_user_id');
            }
        });
    }
};
