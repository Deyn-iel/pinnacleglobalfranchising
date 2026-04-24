<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('claims', function (Blueprint $table) {
      $table->id();
      $table->string('claim_code')->unique();            
      $table->foreignId('hr_user_id')->constrained('users');  

      $table->string('employee_surname');
      $table->string('employee_given');
      $table->string('employee_middle')->nullable();
      $table->date('employee_dob');
      $table->string('civil_status');

      $table->string('employment_status'); 
      $table->string('claim_type');      
      $table->string('benefit');       

      $table->unsignedInteger('occurrence')->default(1); 

      $table->string('dependent_name')->nullable();
      $table->string('dependent_relationship')->nullable();
      $table->date('dependent_dob')->nullable();

      $table->date('room_date')->nullable();
      $table->time('time_in')->nullable();
      $table->time('time_out')->nullable();
      $table->decimal('amount_per_receipt', 12, 2)->nullable();

      $table->string('status')->default('Submitted');
      $table->date('approved_at')->nullable();

      $table->decimal('total_amount', 12, 2)->default(0);
      $table->decimal('recomputed_total', 12, 2)->default(0);

      $table->boolean('is_recomputed')->default(false);
      $table->string('recomputation_reason')->nullable();
      $table->text('recomputation_remarks')->nullable();

      $table->text('assessment')->nullable();
      $table->text('remarks')->nullable();

      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('claims');
  }
};
