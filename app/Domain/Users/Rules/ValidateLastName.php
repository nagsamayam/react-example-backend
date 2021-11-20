<?php

declare(strict_types=1);

namespace Domain\Users\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateLastName implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $lastName
     * @return bool
     */
    public function passes($attribute, $lastName)
    {
        return preg_match("/^[a-zA-Z\.'\s]+$/", $lastName);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.last_name.last_name');
    }
}
