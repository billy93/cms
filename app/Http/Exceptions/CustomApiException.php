<?php

namespace App\Http\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CustomApiException extends Exception
{
    public function __construct($message = "Internal Server Error", $code = 500) 
    {
        parent::__construct($message, $code);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage()
        ], $this->getCode() ?: 500);
    }
}
