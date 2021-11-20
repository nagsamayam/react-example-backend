<?php

declare(strict_types=1);

namespace Domain\Users\V1\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordAction
{
    public function __invoke(User $user, string $newPassword): User
    {
        $user->forceFill([
            'password' => Hash::make($newPassword),
        ])->save();

        return $user;
    }
}
