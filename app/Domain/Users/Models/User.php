<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Laravel\Sanctum\HasApiTokens;
use Database\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Domain\Users\Models\Traits\HasValidationRules;
use Domain\Users\Models\Traits\HasGetters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasGetters;
    use HasValidationRules;
    use Notifiable;
    use HasRoles;

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
        $this->attributes['email'] = strtolower(trim($email));
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public static function guardName(): string
    {
        return 'sanctum';
    }
}
