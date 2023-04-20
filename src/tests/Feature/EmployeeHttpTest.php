<?php

namespace Tests\Feature;

use App\Http\Controllers\EmployeeController;
use App\Lib\Employee\Employee;
use App\Lib\Employee\EmployeeRequest;
use App\Lib\Employee\EmployeeService;
use App\Lib\Employee\EmployeeSkill;
use App\Lib\Employee\SkillLevel;
use Database\Seeders\SkillLevelsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

/**
 * @internal
 */
class EmployeeHttpTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected string $seeder = SkillLevelsTableSeeder::class;

    /** @var EmployeeService */
    protected EmployeeService $mockedEmployeeService;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->mockedEmployeeService =
            Mockery::mock(EmployeeService::class);

        app()->instance(
            EmployeeService::class,
            $this->mockedEmployeeService
        );
    }

    /** @test
     * @throws \Exception
     */
    public function itCanCreateEmployeeSuccessfully()
    {
        $employeeData = [
            'employee_uuid' => 'QM-6838',
            'contact_number' => '630-935-5560',
            'first_name' => 'Prof. Martina Dare Jr.',
            'last_name' => 'Conroy',
            'email_address' => 'paufderhar@example.com',
            'street_address' => '5166 Brock Garden',
            'city' => 'Port Caitlynstad',
            'postal_code' => '21623-1948',
            'country' => 'Malta',
            'date_of_birth' => '1987-01-10',
        ];

        $skillLevel = SkillLevel::where('slug', 'expert')->firstOrFail();

        $skillData = [
            [
                'skill_level_id' => $skillLevel->id,
                'skill_name' => 'PHP',
                'years_experience' => 8,
            ],
            [
                'skill_level_id' => $skillLevel->id,
                'skill_name' => 'JavaScript',
                'years_experience' => 8,
            ],
            [
                'skill_level_id' => $skillLevel->id,
                'skill_name' => 'MySql',
                'years_experience' => 8,
            ],
        ];

        $employeeData['skills'] = $skillData;

        $request = EmployeeRequest::create(
            '/',
            'POST',
            $employeeData
        );

        $controller = new EmployeeController($this->mockedEmployeeService);
        $response = $controller->store($request);

        $this->assertFalse($response);
        //        $this->assertJson(['data' => $employeeData]);

    }

    /** @test */
    public function itCanGetListOfEmployeesSuccessfully(): void
    {
        $employee = Employee::factory()
            ->count(10)
            ->has(EmployeeSkill::factory()->count(2), 'skills')
            ->create();

        $response = $this->getJson('/api/employees');

        $response->assertOk();
        $response->assertJsonIsObject();
    }
}
