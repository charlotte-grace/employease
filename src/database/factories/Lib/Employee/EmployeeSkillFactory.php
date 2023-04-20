<?php

namespace Database\Factories\Lib\Employee;

use App\Lib\Employee\Employee;
use App\Lib\Employee\EmployeeSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Lib\Employee\Employee>
 */
class EmployeeSkillFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = EmployeeSkill::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'skill_name' => fake()->word(),
            'skill_level_id' => 2,
            'years_experience' => fake()->numberBetween(1, 10),
        ];
    }
}
