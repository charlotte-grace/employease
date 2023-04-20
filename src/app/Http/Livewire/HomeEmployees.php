<?php

namespace App\Http\Livewire;

use App\Lib\Employee\Employee;
use Livewire\Component;

class HomeEmployees extends Component
{
    public function render()
    {
        $employees = Employee::latest()->paginate(20);

        return view('livewire.home-employees', ['employees' => $employees]);
    }
}
