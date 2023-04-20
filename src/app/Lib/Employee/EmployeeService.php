<?php

namespace App\Lib\Employee;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    /**
     * @param array $employeeData
     * @return Employee
     * @throws Exception
     */
    public function createEmployee(array $employeeData): Employee
    {
        DB::beginTransaction();

        try {
            $employee = new Employee($employeeData['personal']);
            $employee->save();

            $skills = $employeeData['skills'] ?? null;

            $employeeSkills = new Collection();

            foreach ($skills as $skill) {
                $skillLevel = SkillLevel::getBySlug($skill['skill_level']);

                $employeeSkills->push(new EmployeeSkill([
                    'employee_id' => $employee->getkey(),
                    'skill_name' => $skill['skill_name'],
                    'years_experience' => $skill['years_experience'],
                    'skill_level_id' => $skillLevel->id,
                ]));
            }

            if (!is_null($skills)) {
                $employee->setSkills($employeeSkills);
            }

            DB::commit();

            return $employee;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * @param array $employeeData
     * @param Employee $employee
     * @return Employee
     * @throws Exception
     */
    public function updateEmployee(array $employeeData, Employee $employee): Employee
    {
        DB::beginTransaction();

        try {
            $employee = $this->findByUuid($employeeData['personal']['employee_uuid']);
            $skills = $employeeData['skills'] ?? null;

            $employee->update($employeeData['personal']);

            if (!is_null($skills)) {
                $employee->setSkills($skills);
            }

            DB::commit();

            return $employee;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * @param int $id
     * @return Employee|null
     */
    public function findById(int $id): ?Employee
    {
        return Employee::find($id);
    }

    /**
     * @param int $uuid
     * @return Employee|null
     */
    public function findByUuid(int $uuid): ?Employee
    {
        return Employee::where('employee_uuid', $uuid)->first() ?? new Employee();
    }
}
