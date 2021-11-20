<?php

declare(strict_types=1);

namespace Domain\Users\V1\Dtos;

use App\Http\Requests\User\V1\RegisterRequest;
use Spatie\LaravelData\Data;

class NewUserData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
    ) {
    }

    public static function fromRequest(RegisterRequest $request): self
    {
        return new self(
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            password: $request->input('password')
        );
    }
}
