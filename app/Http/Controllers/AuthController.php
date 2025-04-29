<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
  public function signinJson(AuthRequest $request) : JsonResponse
  {
    $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
      $user = Auth::user();

      $token = JWTAuth::fromUser($user);
      \Log::info('Auth Response: ' . json_encode([
        'user' => $user, 
        'token' => $token
      ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
      return response()->json(['access_token' => $token]);
    }

    return response()->json([
      'error' => true,
      'message' => 'Unauthorized'
    ], 401);
  }

  public function signin(Request $request) 
  {
    $remember = $request->remember ? true : false;
    \Log::info('Auth Response: ' . json_encode([
      'email' => $request->email,
      'password' => $request->password, 
      'remember' => $request->remember, 
      'remember2' => $remember 
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    $credentials = $request->validate([
      'email' => 'required|string|email',
      'password' => 'required'
    ]);

    $credentials = $request->only(['email', 'password']);

    if(Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();
      return redirect()->intended('/dashboard');
    } 

    $user = User::where('email', $request->email)->first();

    // Return With Specific Error Message
    if(!$user) return back()->with('access_denied', 'Invalid email or password!')->withInput($request->except('password'));
    if($user && !Hash::check($request->password, $user->password)) return back()->with('access_denied', 'Invalid email or password!')->withInput($request->except('password'));
  }


  public function signout()
  {
      Auth::logout();
      return response()->json([
          'message' => 'Successfully logged out!',
      ]);
  }
}
