<?php

use App\Http\Controllers\AuthController;
use App\Http\Middlewares\AuthMiddleware;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPicController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierPicController;

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
  
  // Customer routes
  Route::prefix('customers')->name('api.customers.')->group(function() {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('{id}', [CustomerController::class, 'show'])->name('show');
    Route::put('{id}', [CustomerController::class, 'update'])->name('update');
    Route::delete('{id}', [CustomerController::class, 'destroy'])->name('destroy');
    Route::get('active/list', [CustomerController::class, 'getActiveCustomers'])->name('active');
    Route::post('bulk-status', [CustomerController::class, 'bulkUpdateStatus'])->name('bulk-status');
    
    // Customer PIC routes
    Route::prefix('{customerId}/pics')->name('pics.')->group(function() {
      Route::get('/', [CustomerPicController::class, 'index'])->name('index');
      Route::post('/', [CustomerPicController::class, 'store'])->name('store');
      Route::get('{picId}', [CustomerPicController::class, 'show'])->name('show');
      Route::put('{picId}', [CustomerPicController::class, 'update'])->name('update');
      Route::delete('{picId}', [CustomerPicController::class, 'destroy'])->name('destroy');
      Route::get('active/list', [CustomerPicController::class, 'getActivePics'])->name('active');
    });
  });
  
  // Supplier routes
  Route::prefix('suppliers')->name('api.suppliers.')->group(function() {
    Route::get('/', [SupplierController::class, 'index'])->name('index');
    Route::post('/', [SupplierController::class, 'store'])->name('store');
    Route::get('{id}', [SupplierController::class, 'show'])->name('show');
    Route::put('{id}', [SupplierController::class, 'update'])->name('update');
    Route::delete('{id}', [SupplierController::class, 'destroy'])->name('destroy');
    Route::get('active/list', [SupplierController::class, 'getActiveSuppliers'])->name('active');
    Route::post('bulk-status', [SupplierController::class, 'bulkUpdateStatus'])->name('bulk-status');
    
    // Supplier PIC routes
    Route::prefix('{supplierId}/pics')->name('pics.')->group(function() {
      Route::get('/', [SupplierPicController::class, 'index'])->name('index');
      Route::post('/', [SupplierPicController::class, 'store'])->name('store');
      Route::get('{picId}', [SupplierPicController::class, 'show'])->name('show');
      Route::put('{picId}', [SupplierPicController::class, 'update'])->name('update');
      Route::delete('{picId}', [SupplierPicController::class, 'destroy'])->name('destroy');
      Route::get('active/list', [SupplierPicController::class, 'getActivePics'])->name('active');
    });
  });
  
  // Test route
  Route::get('test', function() {
    return response()->json(['message' => 'API is working']);
  });
  
  // Test customers route
  Route::get('customers-test', function() {
    $customers = \App\Models\Customer::all();
    return response()->json([
        'message' => 'Customers test',
        'count' => $customers->count(),
        'customers' => $customers
    ]);
  });
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