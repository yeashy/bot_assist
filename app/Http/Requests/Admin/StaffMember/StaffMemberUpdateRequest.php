<?php

namespace App\Http\Requests\Admin\StaffMember;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StaffMemberUpdateRequest extends FormRequest
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
                'string'
            ],
            'surname' => [
                'required',
                'string'
            ],
            'patronymic' => [
                'nullable',
                'string'
            ],
            'phone_number' => [
                'nullable',
                'numeric'
            ],
            'date_of_birth' => [
                'nullable',
                'date_format:Y-m-d'
            ],
            'gender' => [
                'required',
                'exists:genders,id'
            ],
            'description' => [
                'nullable',
                'string',
                'between:5,5000'
            ],
            'photo_path' => [
                'nullable',
                'mimes:jpg,jpeg,png,webp,svg'
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'phone_number' => 'Номер телефона',
            'date_of_birth' => 'Дата рождения',
            'gender' => 'Пол',
            'description' => 'Доп. информация',
            'photo_path' => 'Фото'
        ];
    }
}
