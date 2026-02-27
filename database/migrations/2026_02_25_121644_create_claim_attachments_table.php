<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('claim_attachments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('claim_id')->constrained()->cascadeOnDelete();
      $table->string('label');     // "Policy Data Page", "Claim Form", etc.
      $table->string('path');      // storage path
      $table->string('original');  // original filename
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('claim_attachments');
  }
};
