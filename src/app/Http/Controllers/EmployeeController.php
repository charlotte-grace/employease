<?php

namespace App\Http\Controllers;

use App\Lib\Employee\Employee;
use App\Lib\Employee\EmployeeRequest;
use App\Lib\Employee\EmployeeResource;
use App\Lib\Employee\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * @param EmployeeService $employeeService
     */
    public function __construct(public EmployeeService $employeeService)
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $searchTerm = $request->input('search');

        $employees = Employee::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('first_name', 'like', "%$searchTerm%")
                        ->orWhere('last_name', 'like', "%$searchTerm%")
                        ->orWhere('email_address', 'like', "%$searchTerm%");
                });
            })
            ->paginate();

        return EmployeeResource::collection($employees);
    }

    /**
     * @param EmployeeRequest $request
     * @return EmployeeResource|false
     * @throws \Exception
     */
    public function store(EmployeeRequest $request): bool|EmployeeResource
    {
        $employeeData = $request->all();

        try {
            $employee = $this->employeeService->createEmployee($employeeData);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return false;
        }

        return new EmployeeResource($employee);
    }

    /**
     * @param int $id
     * @return EmployeeResource|false
     */
    public function show(int $id): bool|EmployeeResource
    {
        try {
            $employee = $this->employeeService->findById($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return false;
        }

        return new EmployeeResource($employee);
    }

    /**
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return EmployeeResource|false
     * @throws \Exception
     */
    public function update(EmployeeRequest $request, Employee $employee): bool|EmployeeResource
    {
        $employeeData = $request->validated();

        try {
            $employee = $this->employeeService->updateEmployee($employeeData, $employee);

            return new EmployeeResource($employee->load('skills'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return false;
        }
    }

    /**
     * @param int $id
     * @return false|Response
     */
    public function destroy(int $id): Response|bool
    {
        try {
            $employee = $this->employeeService->findById($id);
            $employee->delete();

            return response()->noContent();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return false;
        }
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        $searchTerm = $request->input('q');

        $employees = Employee::query()
            ->where('first_name', 'like', "%$searchTerm%")
            ->orWhere('last_name', 'like', "%$searchTerm%")
            ->orWhere('email_address', 'like', "%$searchTerm%")
            ->get();

        return EmployeeResource::collection($employees);
    }
}
