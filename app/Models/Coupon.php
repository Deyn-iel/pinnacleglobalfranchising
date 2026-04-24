<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'booklet_serial_number',
        'unique_code',
        'claimable_item',
        'coupon_status',
        'claim_status',
        'selling_status',
        'buyer_name',
        'buyer_address',
        'buyer_email',
        'buyer_contact',
        'mode_of_payment',
        'payment_reference',
        'requires_code',
        'sold_at',
        'claimed_at',
    ];

    protected $casts = [
        'sold_at' => 'datetime',
        'claimed_at' => 'datetime',
        'requires_code' => 'boolean',
    ];
}