<?php

declare(strict_types=1);

namespace App\Http\Requests\User\V1;

use Domain\Users\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => User::firstNameValidationRules(),
            'last_name' => User::lastNameValidationRules(),
            'email' => User::emailValidationRules(),
            'password' => User::passwordValidationRules(),
            'role_id' => ['required', Rule::exists('roles', 'id'),],
        ];
    }
}
