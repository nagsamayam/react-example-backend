<?php

declare(strict_types=1);

namespace Domain\Users\V1\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Domain\Users\V1\Dtos\NewUserData;

class CreateNewUserAction
{
    public function __invoke(NewUserData $userData): User
    {
        $user = User::create([
            'first_name' => $userData->firstName,
            'last_name' => $userData->lastName,
            'email' => $userData->email,
            'password' => Hash::make($userData->password),
        ]);

        $user->assignRole($userData->role);

        return $user;
    }
}
