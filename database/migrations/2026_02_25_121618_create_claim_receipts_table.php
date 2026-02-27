<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('claim_receipts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('claim_id')->constrained()->cascadeOnDelete();
      $table->string('category');
      $table->string('description');
      $table->decimal('amount', 12, 2);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('claim_receipts');
  }
};
