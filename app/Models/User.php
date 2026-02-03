<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',        // ✅ FIXED
        'temp_password',
        'registered_device_id', // ✅ ADD THIS
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
        'temp_password',  // 🔒 optional pero recommended
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ======================
       ROLE HELPERS (OPTIONAL BUT CLEAN)
    ====================== */

    public function isAdmin(): bool
    {
        return $this->usertype === 'admin';
    }

    public function isUser(): bool
    {
        return $this->usertype === 'user';
    }
    
    public function isSupplies()
    {
        return $this->usertype === 'supplies';
    }
    
    public function isTicket()
    {
        return $this->usertype === 'ticket';
    }
}
