<?php

namespace App\Http\Livewire;

use App\Lib\Employee\Employee;
use Livewire\Component;

class ReadEmployee extends Component
{
    public $employee;

    public function mount($id)
    {
        $this->employee = Employee::where('id', $id)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.read-employee')
            ->extends('layouts.app');
    }
}
