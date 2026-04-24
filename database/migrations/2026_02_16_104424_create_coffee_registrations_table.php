<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('coffee_registrations', function (Blueprint $table) {
      $table->id();

      $table->string('first_name', 80);
      $table->string('last_name', 80);
      $table->string('email', 120)->index();
      $table->string('phone', 40)->nullable();

      $table->string('event_name', 160)->default('WOFEX Drinks + Bakes — Coffee Track');
      $table->string('event_date_range', 60)->default('Feb. 25–27, 2026');
      $table->string('event_venue', 160)->default('World Trade Center, Pasay City');

      $table->string('session_title', 220);     
      $table->string('session_speaker', 120);   
      $table->string('session_datetime', 80);   

      $table->string('rate_type', 120);          
      $table->decimal('rate_amount', 10, 2);     

      $table->string('payment_method', 60)->nullable(); 
      $table->string('reference_no', 120)->nullable();

      $table->text('notes')->nullable();

      $table->enum('status', ['Pending','Approved','Rejected'])->default('Pending');
      $table->text('admin_notes')->nullable();

      $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('coffee_registrations');
  }
};

