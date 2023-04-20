<?php

namespace App\Lib\Employee;

use Illuminate\Support\Facades\DB;

class EmployeeService
{
    /**
     * Create a new employee with the given data.
     *
     * @param array $employeeData
     * @return Employee
     * @throws \Exception
     */
    public function createEmployee(array $employeeData): Employee
    {
        DB::beginTransaction();

        try {
            $skills = $employeeData['skills'] ?? null;
            unset($employeeData['skills']);

            $employee = Employee::create($employeeData);

            if (!is_null($skills)) {
                $employee->setSkills($skills);
            }

            $employee->save();
            DB::commit();

            return $employee;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Update an existing employee with the given data.
     *
     * @param array $employeeData
     * @param Employee $employee
     * @return Employee
     * @throws \Exception
     */
    public function updateEmployee(array $employeeData, Employee $employee): Employee
    {
        DB::beginTransaction();

        try {
            $skills = $employeeData['skills'] ?? null;
            unset($employeeData['skills']);

            if ($skills) {
                $employee->setSkills($skills);
            }

            $employee->update($employeeData);

            DB::commit();

            return $employee;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Find an employee by ID.
     *
     * @param int $id
     * @return Employee|null
     */
    public function findById(int $id): ?Employee
    {
        return Employee::find($id);
    }
}
