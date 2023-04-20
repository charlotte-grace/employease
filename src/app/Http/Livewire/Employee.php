<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Employee extends Component
{
    public $mode = 'list';

    public function render()
    {
        $employees = \App\Lib\Employee\Employee::all();

        return view('livewire.employee', [
            'employees' => $employees,
        ]);
    }
}
