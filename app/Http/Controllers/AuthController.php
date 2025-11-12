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
      'status' => 'error',
      'message' => 'Invalid email or password!'
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

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();

      // 🔹 Cek apakah request dari Postman / JSON client
      if ($request->expectsJson() || $request->isJson()) {
        return response()->json([
          'message' => 'Login success',
          'user' => Auth::user(),
          'csrf_token' => csrf_token(), // token baru setelah session diregenerate
        ]);
      }

      // 🔹 Kalau dari form biasa (web)
      return redirect()->intended('/project-dashboard');
    } 

    // 🔹 Gagal login
    $user = User::where('email', $request->email)->first();
    $errorMessage = 'Invalid email or password!';

    if ($request->expectsJson() || $request->isJson()) {
      return response()->json([
          'message' => $errorMessage,
          'status' => 'error',
          'csrf_token' => csrf_token(), // tetap balikin token biar bisa retry login
      ], 401);
    }

    // 🔹 Kalau dari form biasa
    if (!$user || ($user && !Hash::check($request->password, $user->password))) {
      return back()
        ->with('access_denied', $errorMessage)
        ->withInput($request->except('password'));
    }
  }

  public function getCsrf(Request $request)
  {
    // Ambil token dari helper bawaan Laravel
    $token = csrf_token();

    // Laravel juga otomatis akan set cookie "XSRF-TOKEN" jika middleware web aktif
    return response()->json([
      'csrf_token' => $token
    ]);
  }

  public function signout()
  {
      Auth::logout();
      return redirect('/');
  }
}
