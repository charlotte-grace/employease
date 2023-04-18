<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Lib\Employee\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Employee::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', "%$searchTerm%")
                    ->orWhere('last_name', 'like', "%$searchTerm%")
                    ->orWhere('email_address', 'like', "%$searchTerm%");
            });
        }
        $employees = $query->paginate();

        return EmployeeResource::collection($employees);
    }

    /**
     * @param \App\Http\Requests\EmployeeRequest $request
     * @param \App\Lib\Employee\Employee $employee
     * @return \App\Http\Resources\EmployeeResource
     */
    public function store(EmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->create($request->safe()->except('skills'));
        $employee->skills()->createMany($request->safe()->only('skills'));

        return new EmployeeResource($employee);
    }

    /**
     * @param int $id
     * @return \App\Http\Resources\EmployeeResource
     */
    public function show(int $id): EmployeeResource
    {
        $employee = Employee::findOrFail($id);

        return new EmployeeResource($employee);
    }

    /**
     * @param \App\Http\Requests\EmployeeRequest $request
     * @param \App\Lib\Employee\Employee $employee
     * @return \App\Http\Resources\EmployeeResource
     */
    public function update(EmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->fill($request->safe()->except('skills'));
        $employee->save();

        $employee->skills()->delete();
        $employee->skills()->createMany($request->input('skills', []));

        return new EmployeeResource($employee->load('skills'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response;
     */
    public function destroy(int $id): Response
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $searchTerm = $request->input('q');
        $employees = Employee::where('first_name', 'LIKE', "%$searchTerm%")
            ->orWhere('last_name', 'LIKE', "%$searchTerm%")
            ->orWhere('email_address', 'LIKE', "%$searchTerm%")
            ->get();

        return response()->json($employees);
    }
}
