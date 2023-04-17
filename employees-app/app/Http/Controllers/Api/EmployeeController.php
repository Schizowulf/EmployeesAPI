<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Utils\EmployeeFields;
use App\Utils\ValidateRequest;
use App\Utils\EmployeeFilters;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index(Request $request, EmployeeFilters $filter, ValidateRequest $validator)
    {

        $validateResult = $validator->validateRequest($request, EmployeeFields::getFiltersRules());

        if ($validateResult !== true) 
        {
            return $validateResult;
        } 

        return EmployeeResource::collection($filter->filterRequest($request));
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request, ValidateRequest $validator)
    {
        $validateResult = $validator->validateRequest($request, EmployeeFields::getDbRules());

        if ($validateResult !== true) 
        {
            return $validateResult;
        }

        $newFields = $this->convertDate($request->all());
        $newEmployeeEntity = Employee::create($newFields);

        return new EmployeeResource($newEmployeeEntity);
    }

    /**
     * Display the specified employee.
     */
    public function show(string $id)
    {
        if(!is_numeric($id)) 
        {
            return $this->employeeNotFoundResponse();
        }      

        $employeeEntity = Employee::find($id);

        if(!is_null($employeeEntity))
        {
            return new EmployeeResource($employeeEntity);
        }

        return $this->employeeNotFoundResponse();
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, string $id, ValidateRequest $validator)
    {
        $validateResult = $validator->validateRequest($request, EmployeeFields::getDbRules());

        if ($validateResult !== true) 
        {
            return $validateResult;
        }

        $employeeEntity = Employee::find($id);

        if(is_null($employeeEntity))
        {
            return $this->employeeNotFoundResponse();
        }

        $newFields = $this->convertDate($request->all());
        $employeeEntity->update($newFields);

        return new EmployeeResource($employeeEntity);;
    }


    private function employeeNotFoundResponse() : JsonResponse
    {
        $notFoundCode = 404;
        return response()->json(['message' => 'Employee not found!', "errors" => []], $notFoundCode);
    }

    private function convertDate($fields)
    {
        $fields['birthday'] = date("Y-m-d", strtotime($fields['birthday']));
        return $fields;
    }
}
