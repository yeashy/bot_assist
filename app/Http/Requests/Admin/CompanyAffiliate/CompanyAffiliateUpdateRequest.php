<?php

namespace App\Http\Requests\Admin\CompanyAffiliate;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyAffiliateUpdateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'between:1,255'
            ],
            'address' => [
                'required',
                'string'
            ],
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90'
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180'
            ],
            'phone_number' => [
                'nullable',
                'string'
            ],
            'is_main' => [
                'nullable',
                'boolean'
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'phone_number' => 'Номер телефона',
            'address' => 'Адрес',
            'is_main' => 'Главный адрес'
        ];
    }

    public function messages(): array
    {
        return [
            'latitude' => [
                'required' => 'Для адреса нужно выбрать элемент из списка'
            ]
        ];
    }
}
