<?php

declare(strict_types=1);

namespace Domain\Users\V1\Dtos;

use App\Http\Requests\User\V1\UpdateProfileRequest;
use Domain\Users\Models\Role;
use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public Role $role,
    ) {
    }

    public static function fromRequest(UpdateProfileRequest $request): self
    {
        return new self(
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            role: Role::find($request->input('role_id')),
        );
    }
}
