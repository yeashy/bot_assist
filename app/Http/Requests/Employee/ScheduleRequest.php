<?php

namespace App\Http\Requests\Employee;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => [
                'nullable',
                'date'
            ],
            'employee_ids' => [
                'nullable',
                'array'
            ],
            'employee_ids.*' => [
                'nullable',
                'exists:employees,id'
            ],
            'service_id' => [
                'required',
                'exists:services,id'
            ]
        ];
    }
}
