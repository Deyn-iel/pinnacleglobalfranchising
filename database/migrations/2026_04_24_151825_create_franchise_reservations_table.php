<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('franchise_reservations', function (Blueprint $table) {
            $table->id();

            // Applicant Info
            $table->date('reservation_date')->nullable();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();

            // Package Info
            $table->json('packages')->nullable();
            $table->json('package_counts')->nullable();
            $table->string('location')->nullable();
            $table->boolean('location_tba')->default(false);
            $table->unsignedInteger('total')->default(0);

            // Payment
            $table->decimal('fee', 12, 2)->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('check_no')->nullable();
            $table->string('payee')->default('Pinnacle Global Franchising Group Inc.');
            $table->string('bank')->default('RCBC 7591-149-263');

            // Declaration
            $table->string('signature')->nullable();
            $table->date('signature_date')->nullable();

            // Kape-Ilokano Office Use Only
            $table->string('official_receipt_no')->nullable();

            $table->string('receipt_issued_by')->nullable();
            $table->date('receipt_issued_date')->nullable();

            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();

            $table->string('endorsed_by')->nullable();
            $table->date('endorsed_date')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchise_reservations');
    }
};