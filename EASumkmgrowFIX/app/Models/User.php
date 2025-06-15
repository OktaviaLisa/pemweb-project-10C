<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'namalengkap',
        'password',      
    ];


    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accessor untuk "password" virtual agar bisa diakses tapi mengambil password_hash
    public function getPasswordAttribute()
    {
        return $this->password_hash;
    }

    // Mutator untuk meng-hash password dan simpan ke kolom password_hash
    public function setPasswordAttribute($value)
    {
        $this->attributes['password_hash'] = bcrypt($value);
    }

    // Override method default Laravel Auth untuk pakai password_hash
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}