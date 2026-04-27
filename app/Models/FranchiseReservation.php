<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseReservation extends Model
{
    protected $fillable = [
        'reservation_date',
        'name',
        'address',
        'contact',
        'email',

        'packages',
        'package_counts',
        'location',
        'location_tba',
        'total',

        'fee',
        'payment_mode',
        'check_no',
        'payee',
        'bank',

        'signature',
        'signature_date',

        'official_receipt_no',
        'receipt_issued_by',
        'receipt_issued_date',
        'reviewed_by',
        'reviewed_date',
        'endorsed_by',
        'endorsed_date',

        'created_by',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'packages' => 'array',
        'package_counts' => 'array',
        'location_tba' => 'boolean',
        'fee' => 'decimal:2',
        'signature_date' => 'date',
        'receipt_issued_date' => 'date',
        'reviewed_date' => 'date',
        'endorsed_date' => 'date',
    ];
}