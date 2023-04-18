<?php

namespace database\factories\Lib\Employee;

use App\Lib\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Employee::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_uuid' => Str::upper(substr($this->faker->uuid, 0, 6)),
            'contact_number' => $this->faker->phoneNumber(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email_address' => $this->faker->unique()->safeEmail(),
            'street_address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'date_of_birth' => $this->faker->date('Y-m-d'),
        ];
    }
}
