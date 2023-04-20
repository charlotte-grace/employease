<?php

namespace App\Lib\Employee;

interface EmployeeRepository
{
    public function create(Employee $employee): Employee;
    public function update(Employee $employee): Employee;
    public function getById(int $id): ?Employee;
}
