<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->string('ticket_no')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('subject');
            $table->text('description');
            $table->string('department');
            $table->enum('priority', ['low','medium','high'])->default('medium');
            $table->enum('status', ['pending','in_progress','resolved'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

