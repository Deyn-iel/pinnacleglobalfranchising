<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',

        'morning_in',
        'morning_in_selfie',
        'morning_out',
        'morning_out_selfie',

        'afternoon_in',
        'afternoon_in_selfie',
        'afternoon_out',
        'afternoon_out_selfie',
    ];

    protected $casts = [
        'morning_in' => 'datetime',
        'morning_out' => 'datetime',
        'afternoon_in' => 'datetime',
        'afternoon_out' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



