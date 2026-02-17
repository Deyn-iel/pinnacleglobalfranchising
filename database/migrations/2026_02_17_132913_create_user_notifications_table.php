<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('type')->default('info'); // info, success, warning, danger
            $table->string('title');
            $table->text('message')->nullable();

            // optional: link to a registration + file links
            $table->foreignId('coffee_registration_id')->nullable()->constrained('coffee_registrations')->nullOnDelete();

            $table->json('meta')->nullable(); // store file paths/urls
            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_notifications');
    }
};
