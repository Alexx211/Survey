<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    public function isAdmin()
    {
        return $this->is_admin; // Asigură-te că `is_admin` este definit în migrarea pentru tabelul `users`
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts =[

        'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',

        ];

}
