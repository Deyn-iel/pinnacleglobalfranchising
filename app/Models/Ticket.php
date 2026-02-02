<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_no',
        'user_id',
        'subject',
        'description',
        'department',
        'priority',
        'status',
    ];

    // RELATION
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
