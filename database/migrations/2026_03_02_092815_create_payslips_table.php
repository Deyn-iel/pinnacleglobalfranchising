<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();

            $table->string('folder_key', 7);
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');

            $table->string('batch_name')->nullable();

            $table->string('original_name');
            $table->string('stored_name');
            $table->string('file_path');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('mime_type', 100)->nullable();

            // Uploader
            $table->unsignedBigInteger('uploaded_by')->nullable();

            $table->timestamps();

            $table->index(['folder_key', 'created_at']);
            $table->index(['year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
