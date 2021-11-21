<?php

declare(strict_types=1);

namespace App\Http\Requests\Products\V1;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => ['required', 'min:3',],
            'description' => ['required', 'min:20',],
            'image' => ['required', 'min:3',],
            'price' => ['required', 'numeric', 'min:10'],
        ];
    }
}
