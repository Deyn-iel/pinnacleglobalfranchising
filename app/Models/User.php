<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;

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
        'usertype',       
        'temp_password',
        'registered_device_id', 
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
        'temp_password',  
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

    public function sendPasswordResetNotification($token)
{
    $this->notify(new CustomResetPassword($token));
}
}
