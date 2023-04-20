<?php

namespace App\Lib\Employee;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'personal.first_name' => 'required|string|max:255',
            'personal.last_name' => 'required|string|max:255',
            'personal.contact_number' => 'required|unique:employees,contact_number',
            'personal.email_address' => 'required|string|email|max:255|unique:employees,email_address',
            'personal.date_of_birth' => 'required|date',
            'personal.street_address' => 'required|string|max:255',
            'personal.city' => 'required|string|max:255',
            'personal.postal_code' => 'required|string|max:255',
            'personal.country' => 'required|string|max:255',
            'skills' => 'array',
            'skills.*.skill_level' => 'sometimes|nullable|exists:skill_levels,slug',
            'skills.*.skill_name' => 'sometimes|nullable',
            'skills.*.years_experience' => 'sometimes|nullable',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'personal.first_name.required' => 'First Name required',
            'personal.last_name.required' => 'Last Name required',
            'personal.contact_number.required' => 'Contact Number required',
            'personal.contact_number.unique' => 'Contact Number already exists',
            'personal.email_address.required' => 'Email required',
            'personal.email_address.email' => 'Email invalid',
            'personal.email_address.unique' => 'Email already already exists',
            'personal.date_of_birth.required' => 'Date of Birth required',
            'personal.date_of_birth.date' => 'Invalid date',
            'personal.street_address.required' => 'Street Address required',
            'personal.city.required' => 'City required',
            'personal.postal_code.required' => 'Postal Code required',
            'personal.country.required' => 'Country required',
        ];
    }
}
