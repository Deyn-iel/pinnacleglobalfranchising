<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $fillable = [
        'user_id',
        'target_user_id',
        'department',
        'message',
        'type',
        'ticket_id',
        'is_read',
        'notified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}