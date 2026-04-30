<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('franchise_applications', function (Blueprint $table) {
            $table->string('voucher_option')->nullable()->after('discovery_done_at');
            $table->foreignId('coupon_id')->nullable()->after('voucher_option')->constrained('coupons')->nullOnDelete();
            $table->timestamp('franchisee_registered_at')->nullable()->after('coupon_id');
            $table->timestamp('agreement_printed_at')->nullable()->after('franchisee_registered_at');
            $table->string('payment_reference_no')->nullable()->after('agreement_printed_at');
            $table->string('sales_invoice_no')->nullable()->after('payment_reference_no');
            $table->timestamp('payment_confirmed_at')->nullable()->after('sales_invoice_no');
            $table->foreignId('franchise_reservation_id')->nullable()->after('payment_confirmed_at')->constrained('franchise_reservations')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('franchise_applications', function (Blueprint $table) {
            $table->dropConstrainedForeignId('franchise_reservation_id');
            $table->dropColumn([
                'payment_confirmed_at',
                'sales_invoice_no',
                'payment_reference_no',
                'agreement_printed_at',
                'franchisee_registered_at',
            ]);
            $table->dropConstrainedForeignId('coupon_id');
            $table->dropColumn('voucher_option');
        });
    }
};
