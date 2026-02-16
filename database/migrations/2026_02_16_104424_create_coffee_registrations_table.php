<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('coffee_registrations', function (Blueprint $table) {
      $table->id();

      // --- Applicant details ---
      $table->string('first_name', 80);
      $table->string('last_name', 80);
      $table->string('email', 120)->index();
      $table->string('phone', 40)->nullable();

      // --- Event details (from poster) ---
      // WOFEX Drinks + Bakes · Coffee Track
      $table->string('event_name', 160)->default('WOFEX Drinks + Bakes — Coffee Track');
      $table->string('event_date_range', 60)->default('Feb. 25–27, 2026');
      $table->string('event_venue', 160)->default('World Trade Center, Pasay City');

      // --- Choose one seminar session (Feb 27 schedule) ---
      $table->string('session_title', 220);      // e.g. "How to Design a Café Menu..."
      $table->string('session_speaker', 120);    // e.g. "Ernest Martin"
      $table->string('session_datetime', 80);    // e.g. "Feb 27, 2026 · 10:30 AM – 12:30 PM"

      // --- Payment package (Rates & Packages) ---
      $table->string('rate_type', 120);          // Per Topic / Per Track / Bakes & Cakes (2 days) / Drinks,Bakes,&Coffee (3 days)
      $table->decimal('rate_amount', 10, 2);     // 2000.00 / 5000.00 / 8000.00 / 10500.00

      // --- Optional payment info (if needed) ---
      $table->string('payment_method', 60)->nullable(); // GCash/Bank/Onsite
      $table->string('reference_no', 120)->nullable();

      // --- User message ---
      $table->text('notes')->nullable();

      // --- Admin management ---
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

