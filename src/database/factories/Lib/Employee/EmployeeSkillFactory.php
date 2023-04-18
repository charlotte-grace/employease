<?php

namespace database\factories\Lib\Employee;

use App\Lib\Employee\Employee;
use App\Lib\Employee\EmployeeSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EmployeeSkill>
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
            'skill_name' => $this->faker->word(),
            'skill_level_id' => 2,
            'years_experience' => $this->faker->numberBetween(1, 10),
        ];
    }
}
