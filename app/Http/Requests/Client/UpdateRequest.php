<?php

namespace App\Http\Requests\Client;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<string>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'between:1,255',
            ],
            'surname' => [
                'nullable',
                'string',
                'between:1,255',
            ],
            'patronymic' => [
                'nullable',
                'string',
                'between:1,255',
            ],
            'phone_number' => [
                'nullable',
                'string',
                'regex:/^\+?7[\s\-()]*\d{3}[\s\-()]*\d{3}[\s\-()]*\d{2}[\s\-()]*\d{2}$/u',
            ],
        ];
    }
}
