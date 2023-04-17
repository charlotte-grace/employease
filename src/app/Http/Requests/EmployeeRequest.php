<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'email_address' => 'required|string|email|max:255|unique:employees,email_address,' . $this->employee,
            'date_of_birth' => 'required|date',
            'address' => 'array',
            'address.street_address' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.postal_code' => 'required|string|max:255',
            'address.country' => 'required|string|max:255',
            'skills' => 'array',
            'skills.*.employee_skill_level_id' => 'required|integer|exists:employee_skill_levels,id',
            'skills.*.skill_name' => 'required|string|max:255',
            'skills.*.years_experience' => 'required|integer|min:0',
        ];
    }
}
