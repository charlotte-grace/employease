<?php

namespace App\Http\Livewire;

use App\Lib\Employee\Employee;
use Livewire\Component;

class EditEmployee extends Component
{
    public $employee;

    public $success = false;

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

    public function mount($id)
    {
        $this->employee = Employee::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.edit-Employee')
            ->extends('layouts.app');
    }

    public function update($id)
    {
        $this->validate();
        $employee = Employee::find($id);
        $employee->fill($this->safe()->except('skills'));
        $employee->save();

        $employee->skills()->delete();
        $employee->skills()->createMany($this->input('skills', []));

        $this->success = true;
    }
}
