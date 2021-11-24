<?php

declare(strict_types=1);

namespace Domain\Users\V1\Actions;

use Domain\Users\Models\User;
use Domain\Users\V1\Dtos\UpdateUserData;

class UpdateProfileInfoAction
{
    public function __invoke(User $user, UpdateUserData $userData): User
    {
        $user->forceFill([
            'first_name' => $userData->firstName,
            'last_name' => $userData->lastName,
            'email' => $userData->email,
        ])->save();

        $user->roles()->detach();
        $user->assignRole($userData->role);
        $user->forgetCachedPermissions();

        return $user;
    }
}
