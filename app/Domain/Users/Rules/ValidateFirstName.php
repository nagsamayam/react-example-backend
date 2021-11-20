<?php

declare(strict_types=1);

namespace Domain\Users\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateFirstName implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $firstName
     * @return bool
     */
    public function passes($attribute, $firstName)
    {
        return preg_match("/^[a-zA-Z\.'\s]+$/", $firstName);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.first_name.first_name');
    }
}
