<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('booklet_serial_number')->nullable();
            $table->string('unique_code')->unique()->nullable();

            $table->string('claimable_item');
            $table->decimal('amount', 10, 2)->default(0);

            $table->string('coupon_status')->default('Active'); // Active / Inactive
            $table->string('claim_status')->default('Unclaimed'); // Claimed / Unclaimed
            $table->string('selling_status')->default('For Selling'); // For Selling / Sold

            $table->string('buyer_name')->nullable();
            $table->text('buyer_address')->nullable();
            $table->string('buyer_email')->nullable();
            $table->string('buyer_contact')->nullable();

            $table->string('mode_of_payment')->nullable(); // Cash / GCash / Bank / etc
            $table->string('payment_reference')->nullable();

            $table->boolean('requires_code')->default(true);

            $table->timestamp('sold_at')->nullable();
            $table->timestamp('claimed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};