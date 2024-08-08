<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'address' => [
                'nullable',
                'string'
            ],
            'date_of_birth' => [
                'nullable',
                'date_format:Y-m-d'
            ],
            'phone_number' => [
                'nullable',
                'numeric'
            ],
            'gender' => [
                'required',
                'exists:genders,id'
            ],
            'description' => [
                'nullable',
                'string',
                'between:5,5000'
            ]
        ];
    }
}
