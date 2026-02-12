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
        // ✅ Prevent crash kapag wala pang table
        if (!Schema::hasTable('support_messages')) {
            return;
        }

        Schema::table('support_messages', function (Blueprint $table) {
            // ✅ add column only if missing
            if (!Schema::hasColumn('support_messages', 'target_user_id')) {
                $table->unsignedBigInteger('target_user_id')->after('user_id');
            }

            // ✅ add indexes with explicit names
            // NOTE: Laravel will error if index already exists, but since migration runs once, ok.
            $table->index('target_user_id', $this->idxTarget);
            $table->index(['target_user_id', 'id'], $this->idxTargetId);
        });
    }

    public function down(): void
    {
        // ✅ Prevent crash kapag wala pa rin table
        if (!Schema::hasTable('support_messages')) {
            return;
        }

        Schema::table('support_messages', function (Blueprint $table) {
            // ✅ drop indexes by name (sure)
            // (Wrap in try? optional, pero usually ok as long as migration ran)
            $table->dropIndex($this->idxTarget);
            $table->dropIndex($this->idxTargetId);

            // ✅ drop column if exists
            if (Schema::hasColumn('support_messages', 'target_user_id')) {
                $table->dropColumn('target_user_id');
            }
        });
    }
};
