<?php

declare(strict_types=1);

namespace Domain\Users\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateEmailDomain implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $inputEmail
     * @return bool
     */
    public function passes($attribute, $inputEmail): bool
    {
        $emailArray = explode("@", $inputEmail);

        return checkdnsrr(array_pop($emailArray), "MX");
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Invalid email domain';
    }
}
