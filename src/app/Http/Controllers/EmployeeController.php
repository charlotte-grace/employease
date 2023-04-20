<?php

namespace App\Http\Controllers;

use App\Lib\Employee\Employee;
use App\Lib\Employee\EmployeeRequest;
use App\Lib\Employee\EmployeeResource;
use App\Lib\Employee\EmployeeService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EmployeeController extends ApiController
{
    /**
     * @param EmployeeService $employeeService
     */
    public function __construct(public EmployeeService $employeeService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $employees = Employee::query()->simplePaginate();

            return $this->sendResourceResponse(EmployeeResource::collection($employees));
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return $this->sendErrorResponse($e->getMessage());
        }
    }

    /**
     * @param EmployeeRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(EmployeeRequest $request): JsonResponse
    {
        try {
            $employee = $this->employeeService->createEmployee($request->all());

            return $this->sendResourceResponse(new EmployeeResource($employee));
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return $this->sendErrorResponse($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $employee = $this->employeeService->findById($id);

            return $this->sendResourceResponse(new EmployeeResource($employee));
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return $this->sendErrorResponse($e->getMessage());
        }
    }

    /**
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return JsonResponse
     * @throws Exception
     */
    public function update(EmployeeRequest $request, Employee $employee): JsonResponse
    {
        $employeeData = $request->validated();

        try {
            $employee = $this->employeeService->updateEmployee($employeeData, $employee);

            return $this->sendResourceResponse(new EmployeeResource($employee->load('skills')));
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return $this->sendErrorResponse($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse|Response
     */
    public function destroy(int $id): Response|JsonResponse
    {
        try {
            $employee = $this->employeeService->findById($id);
            $employee->delete();

            return response()->noContent();
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return $this->sendErrorResponse($e->getMessage());
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
