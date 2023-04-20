<?php

namespace Database\Factories\Lib\Employee;

use App\Lib\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Lib\Employee\Employee>
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
            'employee_uuid' => Str::upper(substr(fake()->uuid, 0, 6)),
            'contact_number' => fake()->unique()->phoneNumber(),
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'email_address' => fake()->unique()->safeEmail(),
            'street_address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'date_of_birth' => fake()->date('Y-m-d'),
        ];
    }
}
