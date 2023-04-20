<?php

namespace Tests\Feature;

use App\Lib\Employee\Employee;
use App\Lib\Employee\EmployeeSkill;
use App\Lib\Employee\SkillLevel;
use Database\Seeders\SkillLevelsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 */
class EmployeeDatabaseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var string
     */
    protected string $seeder = SkillLevelsTableSeeder::class;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function itCanCreateAnEmployeeWithSkills(): void
    {
        $employee = Employee::factory()->createOne();

        $skills = EmployeeSkill::factory()->count(4)->create([
            'employee_id' => $employee->id,
        ]);

        $this->assertTrue($employee->exists);
        $this->assertTrue($employee->skills->contains($skills->first()));
        $this->assertEquals(4, $employee->skills->count());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $employee->skills);
    }

    /** @test */
    public function itCanUpdateAnEmployeeWithSkills(): void
    {
        $employee = Employee::factory()->createOne();

        $skills = EmployeeSkill::factory()->count(4)->create([
            'employee_id' => $employee->id,
        ]);

        $employeeCloned = clone $employee;

        $skillLevel = SkillLevel::where('slug', 'expert')->limit(1)->first();

        $newData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        $employee->update($newData);

        $this->assertTrue($employeeCloned->first_name !== $employee->first_name);
        $this->assertTrue($employeeCloned->last_name !== $employee->last_name);
        $this->assertDatabaseHas('employees', array_merge($newData, ['id' => $employee->id]));
    }

    /** @test */
    public function itCanDeleteAnEmployee(): void
    {
        $employee = Employee::factory()->createOne();

        $employee->delete();
        $this->assertTrue($employee->trashed());
    }

}
