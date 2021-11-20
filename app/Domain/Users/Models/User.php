<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Domain\Users\Models\Traits\HasValidationRules;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasValidationRules;
    use Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setFirstNameAttribute(string $firstName): void
    {
        $this->attributes['first_name'] = ucwords(trim($firstName));
    }

    public function setLastNameAttribute(string $lastName): void
    {
        $this->attributes['last_name'] = ucwords(trim($lastName));
    }

    public function setEmailAttribute(string $email): void
    {
        if ($this->email) {
            return;
        }

        $this->attributes['email'] = strtolower(trim($email));
    }
}
