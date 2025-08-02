<?php

use App\Http\Controllers\AuthController;
use App\Http\Middlewares\AuthMiddleware;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;

Route::middleware('api')->group(function() {
  Route::post('signin', [AuthController:: class, 'signinJson'])->name('api.auth.signin');
  
});

Route::middleware(['api', 'auth:api'])->group(function () {
  // Route::apiResource('invoices', InvoiceController::class)->names('api.invoices');

  Route::prefix('users')->name('api.users.')->group(function() {
    Route::post('/', [UserController::class, 'create'])->name('create');
    Route::get('/', [UserController::class, 'readAll'])->name('readAll');
    Route::get('{user_id}', [UserController::class, 'read'])->name('read');
    Route::put('{user_id}', [UserController::class, 'update'])->name('update');
    Route::delete('{user_id}', [UserController::class, 'delete'])->name('delete');
  });
  
 
  Route::prefix('roles')->name('api.roles.')->group(function () {
    Route::post('/', [RoleController::class, 'create'])->name('create');
    Route::get('/', [RoleController::class, 'readAll'])->name('readAll');
    Route::get('{role_id}', [RoleController::class, 'read'])->name('read');
    Route::put('{role_id}', [RoleController::class, 'update'])->name('update');
    Route::delete('{role_id}', [RoleController::class, 'delete'])->name('delete');
  });

  Route::prefix('permissions')->name('api.permissions.')->group(function () {
    Route::post('/', [PermissionController::class, 'create'])->name('create');
    Route::get('/', [PermissionController::class, 'readAll'])->name('readAll');
    Route::get('{permission_id}', [PermissionController::class, 'read'])->name('read');
    Route::put('{permission_id}', [PermissionController::class, 'update'])->name('update');
    Route::delete('{permission_id}', [PermissionController::class, 'delete'])->name('delete');
  });

  Route::prefix('invoices')->name('api.invoices.')->group(function () {
    Route::post('/', [InvoiceController::class, 'create'])->name('create');
    Route::get('/', [InvoiceController::class, 'readAll'])->name('readAll');
    Route::get('{invoice_id}', [InvoiceController::class, 'read'])->name('read');
    Route::put('{invoice_id}', [InvoiceController::class, 'update'])->name('update');
    Route::delete('{invoice_id}', [InvoiceController::class, 'delete'])->name('delete');
  });
});