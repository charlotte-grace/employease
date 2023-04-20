<?php

namespace App\Http\Livewire;

namespace App\Http\Livewire;

use App\Lib\Employee\Employee;
use Illuminate\Contracts\Validation\ValidationRule;
use Livewire\Component;

class CreateEmployee extends Component
{
    public $success;
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

    public function render()
    {
        return view('livewire.create-employee')
            ->extends('layouts.app')
            ->section('content');
    }

    public function create(Employee $employee)
    {
        $this->validate();

        $employee->create($this->safe()->except('skills'));
        $employee->skills()->createMany($this->safe()->only('skills'));

        $this->success = true;
    }
}
