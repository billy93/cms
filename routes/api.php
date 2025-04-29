<?php

use App\Http\Controllers\AuthController;
use App\Http\Middlewares\AuthMiddleware;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;

Route::middleware('api')->group(function() {
  Route::post('signin', [AuthController:: class, 'signinJson'])->name('api.auth.signin');
  
  Route::prefix('users')->name('api.users.')->group(function() {
    Route::post('/', [UserController::class, 'create'])->name('create');
    Route::get('/', [UserController::class, 'getAll'])->name('get_all');
    Route::get('{user_id}', [UserController::class, 'getById'])->name('get');
    Route::put('{user_id}', [UserController::class, 'update'])->name('update');
    Route::delete('{user_id}', [UserController::class, 'delete'])->name('delete');
  });
  
  Route::apiResource('invoices', InvoiceController::class);
});

Route::middleware(['api', 'auth:api'])->group(function () {
  Route::prefix('roles')->name('api.roles.')->group(function () {
    Route::post('/', [RoleController::class, 'create'])->name('create');
    Route::get('/', [RoleController::class, 'getAll'])->name('get_all');
    Route::get('{role_id}', [RoleController::class, 'getById'])->name('get');
    Route::put('{role_id}', [RoleController::class, 'update'])->name('update');
    Route::delete('{role_id}', [RoleController::class, 'delete'])->name('delete');
  });

  Route::prefix('permissions')->name('api.permissions.')->group(function () {
    Route::post('/', [PermissionController::class, 'create'])->name('create');
    Route::get('/', [PermissionController::class, 'getAll'])->name('get_all');
    Route::get('{permission_id}', [PermissionController::class, 'getById'])->name('get');
    Route::put('{permission_id}', [PermissionController::class, 'update'])->name('update');
    Route::delete('{permission_id}', [PermissionController::class, 'delete'])->name('delete');
  });
});