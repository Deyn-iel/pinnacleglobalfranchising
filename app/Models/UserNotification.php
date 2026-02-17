<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'coffee_registration_id',
        'meta',
        'read_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'read_at' => 'datetime',
    ];
}
