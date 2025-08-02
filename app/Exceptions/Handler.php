<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Exception;


class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    
    public function register()
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        });
        
        $this->renderable(function (\CustomApiException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (JWTException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token not parsed'
            ], 401);
        });
    }

    // protected function unauthenticated($request, AuthenticationException $e)
    // {
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Unauthenticated'
    //     ], 401);
    // }
}
