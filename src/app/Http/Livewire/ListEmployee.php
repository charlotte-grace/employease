<?php

namespace App\Http\Livewire;

use App\Lib\Employee\Employee;
use Livewire\Component;

class ListEmployee extends Component
{
    public function render()
    {
        $employees = Employee::latest()->paginate(20);

        return view('livewire.list-employee', ['employees' => $employees])
            ->extends('layouts.app')
            ->section('content');
    }
}
