<?php

namespace App\Utils;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator as ValidationValidator;

class ValidateRequest
{
    protected ValidationValidator $validator;

    public function validateRequest(Request $request, array $rules)
    {
        $this->validator = Validator::make($request->all(), $rules);

        if ($this->validator->fails()) 
        {
            $unprocessedEntityCode = 422;
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $this->validator->errors()], $unprocessedEntityCode);
        }
        
        return true;
    }
}