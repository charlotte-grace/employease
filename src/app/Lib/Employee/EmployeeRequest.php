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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|unique:employees,contact_number',
            'email_address' => 'required|string|email|max:255|unique:employees,email_address',
            'date_of_birth' => 'required|date',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
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
            'first_name.required' => 'First Name required',
            'last_name.required' => 'Last Name required',
            'contact_number.required' => 'Contact Number required',
            'contact_number.unique' => 'Contact Number already exists',
            'email_address.required' => 'Email required',
            'email_address.email' => 'Email invalid',
            'email_address.unique' => 'Email already already exists',
            'date_of_birth.required' => 'Date of Birth required',
            'date_of_birth.date' => 'Invalid date',
            'street_address.required' => 'Street Address required',
            'city.required' => 'City required',
            'postal_code.required' => 'Postal Code required',
            'country.required' => 'Country required',
        ];
    }
}
