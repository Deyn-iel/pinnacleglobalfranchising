<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_messages', function (Blueprint $table) {
            $table->id();

            // sender
            $table->unsignedBigInteger('user_id');

            // owner ng conversation (target account)
            $table->unsignedBigInteger('target_user_id');

            $table->text('message');
            $table->timestamps();

            // ✅ indexes for performance
            $table->index('target_user_id');
            $table->index(['target_user_id', 'id']); // after_id queries
            $table->index('user_id');

            // ✅ optional foreign keys (pwede mong alisin kung ayaw mo)
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('target_user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_messages');
    }
};
