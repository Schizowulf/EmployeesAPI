<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Utils\EmployeeFields;
use App\Utils\ValidateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request, ValidateRequest $validator)
    {
        $validateResult = $validator->validateRequest($request, EmployeeFields::getRules());

        if ($validateResult !== true) 
        {
            return $validateResult;
        } 

        $newEmployeeEntity = Employee::create($request->all());

        return $this->singleEmployeeToResponseForm($newEmployeeEntity);
    }

    /**
     * Display the specified employee.
     */
    public function show(string $id)
    {
        $employeeEntity = Employee::find($id);

        if(!is_null($employeeEntity))
        {
            return $this->singleEmployeeToResponseForm($employeeEntity);
        }

        return $this->employeeNotFoundResponse();
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, string $id, ValidateRequest $validator)
    {
        $validateResult = $validator->validateRequest($request, EmployeeFields::getRules());

        if ($validateResult !== true) 
        {
            return $validateResult;
        }

        $employeeEntity = Employee::find($id);

        if(is_null($employeeEntity))
        {
            return $this->employeeNotFoundResponse();
        }

        $employeeEntity->update($request->all());

        return $this->singleEmployeeToResponseForm($employeeEntity);
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function singleEmployeeToResponseForm(Employee $entity, $meta = null) : JsonResponse
    {
        return response()->json(["data" => [$entity->attributesToArray()], "meta" => $meta]);
    }

    private function employeeNotFoundResponse() : JsonResponse
    {
        $notFoundCode = 404;
        return response()->json(['message' => 'Employee not found!', "errors" => []], $notFoundCode);
    }
}
