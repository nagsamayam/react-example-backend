<?php

declare(strict_types=1);

namespace App\Http\Requests\User\V1;

use Domain\Users\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => User::passwordValidationRules()
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $currentInputPassword = $this->input('current_password');
            if (($currentInputPassword === null) || !Hash::check($currentInputPassword, $this->user()->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });
    }
}
