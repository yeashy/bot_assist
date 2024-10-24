<?php

namespace App\Http\Requests\Client;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
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
                'required',
                'string',
                'between:1,255',
            ],
            'surname' => [
                'required',
                'string',
                'between:1,255',
            ],
            'patronymic' => [
                'nullable',
                'string',
                'between:1,255',
            ],
            'phone_number' => [
                'required',
                'string',
                'regex:/^\+?7[\s\-()]*\d{3}[\s\-()]*\d{3}[\s\-()]*\d{2}[\s\-()]*\d{2}$/u',
            ],
        ];
    }

    /**
     * @return array<string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'phone_number' => 'Номер телефона',
        ];
    }
}
