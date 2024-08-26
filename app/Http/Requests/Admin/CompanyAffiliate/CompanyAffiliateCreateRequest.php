<?php

namespace App\Http\Requests\Admin\CompanyAffiliate;

use Illuminate\Foundation\Http\FormRequest;

class CompanyAffiliateCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
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

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'phone_number' => 'Номер телефона',
            'address' => 'Адрес',
            'is_main' => 'Главный адрес'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'latitude' => [
                'required' => 'Для адреса нужно выбрать элемент из списка'
            ]
        ];
    }
}
