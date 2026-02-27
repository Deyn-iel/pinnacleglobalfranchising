<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('claims', function (Blueprint $table) {
      $table->id();
      $table->string('claim_code')->unique();                 // CLM-xxxxx
      $table->foreignId('hr_user_id')->constrained('users');  // submitter HR

      $table->string('employee_surname');
      $table->string('employee_given');
      $table->string('employee_middle')->nullable();
      $table->date('employee_dob');
      $table->string('civil_status');

      $table->string('employment_status'); // Regular/Seasonal
      $table->string('claim_type');        // Personal / Dependent
      $table->string('benefit');           // Basic/Major/Dread/Accident

      $table->unsignedInteger('occurrence')->default(1); // 1st/2nd/3rd

      // Dependent fields (nullable)
      $table->string('dependent_name')->nullable();
      $table->string('dependent_relationship')->nullable();
      $table->date('dependent_dob')->nullable();

      // Major Medical admit fields (nullable)
      $table->date('room_date')->nullable();
      $table->time('time_in')->nullable();
      $table->time('time_out')->nullable();
      $table->decimal('amount_per_receipt', 12, 2)->nullable();

      // Status / workflow
      $table->string('status')->default('Submitted'); // Submitted, Accepted, Reviewing, For Checking, Approved, etc.
      $table->date('approved_at')->nullable();

      // Totals
      $table->decimal('total_amount', 12, 2)->default(0);
      $table->decimal('recomputed_total', 12, 2)->default(0);

      // Recompute fields
      $table->boolean('is_recomputed')->default(false);
      $table->string('recomputation_reason')->nullable();
      $table->text('recomputation_remarks')->nullable();

      // Notes
      $table->text('assessment')->nullable();
      $table->text('remarks')->nullable();

      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('claims');
  }
};
