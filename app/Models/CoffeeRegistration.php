<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name','last_name','email','phone',
        'event_name','event_date_range','event_venue',
        'session_title','session_speaker','session_datetime',
        'rate_type','rate_amount',
        'payment_method','reference_no',
        'notes','status','admin_notes',
        'request_approval_path',
        'travel_order_path',
        'registration_ticket_path',
        'completed_at',

    ];

    protected $casts = [
        'completed_at' => 'datetime',
        ];


    // ✅ ADD THIS
    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }
}
