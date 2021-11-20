<?php

declare(strict_types=1);

namespace Domain\Users\Models\Traits;

use Illuminate\Validation\Rule;
use Domain\Users\Rules\ValidateLastName;
use Domain\Users\Rules\ValidateFirstName;
use Illuminate\Validation\Rules\Password;
use Domain\Users\Rules\ValidateEmailDomain;

trait HasValidationRules
{

    public static function firstNameValidationRules(): array
    {
        return ['bail', 'required', 'string', 'min:3', 'max:255', new ValidateFirstName,];
    }

    public static function lastNameValidationRules(): array
    {
        return ['bail', 'required', 'string', 'min:1', 'max:255', new ValidateLastName,];
    }

    public static function emailValidationRules(): array
    {
        return [
            'bail',
            'required',
            'string',
            'email',
            'max:255',
            Rule::when(app()->environment() !== 'local', 'indisposable'),
            new ValidateEmailDomain, 'unique:users',
        ];
    }

    public static function passwordValidationRules(): array
    {
        return ['bail', 'required', Password::defaults(), 'confirmed',];
    }
}
