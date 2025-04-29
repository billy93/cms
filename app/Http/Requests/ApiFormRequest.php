<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiFormRequest extends FormRequest
{
  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      response()->json([
        'status' => 'error',
        'message' => 'Validation Error',
        'errors' => $validator->errors()
      ], 400)
    );
  }
}