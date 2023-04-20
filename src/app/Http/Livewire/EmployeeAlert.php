<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmployeeAlert extends Component
{
    public $liked = false;

    public function render()
    {
        return view('livewire.employee-alert')
            ->extends('layouts.app')
            ->section('content');
    }

    public function toggleLike()
    {
        $this->liked = !$this->liked;
    }
}
