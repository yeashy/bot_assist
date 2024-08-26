<?php

namespace App\Http\Requests\Admin\Company;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'email' => [
                'required',
                'email'
            ],
            'phone_number' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string'
            ],
            'main_link' => [
                'required',
                'url'
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Почта',
            'phone_number' => 'Номер телефона',
            'address' => 'Главный адрес',
            'main_link' => 'Ссылка на сайт'
        ];
    }
}
