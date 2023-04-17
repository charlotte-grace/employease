<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Lib\Employee\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Employee::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('email_address', 'like', "%$search%");
        }

        $employees = $query->paginate();

        return EmployeeResource::collection($employees);
    }

    /**
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function store(EmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->create($request->safe()->except('skills'));
        $employee->skills()->createMany($request->safe()->only('skills'));

        return new EmployeeResource($employee);
    }

    /**
     * @param $id
     * @return EmployeeResource
     */
    public function show($id): EmployeeResource
    {
        $employee = Employee::findOrFail($id);

        return new EmployeeResource($employee);
    }

    /**
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function update(EmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $employee->fill($request->safe()->except(['skills']));
        $employee->save();

        $employee->skills()->delete();
        $employee->skills()->createMany($request->input('skills', []));

        return new EmployeeResource($employee->load(['skills']));
    }

    /**
     * @param $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->noContent();
    }
}
