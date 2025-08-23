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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

// Category routes
Route::prefix('categories')->name('api.categories.')->group(function() {
  Route::get('/all', [CategoryController::class, 'apiIndex'])->name('index');
  Route::post('/store', [CategoryController::class, 'store'])->name('store');
  Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
  Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
  Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
  Route::get('/active', [CategoryController::class, 'getActiveCategories'])->name('active');
});

// Product routes
Route::prefix('products')->name('api.products.')->group(function() {
  Route::get('/all', [ProductController::class, 'apiIndex'])->name('index');
  Route::post('/store', [ProductController::class, 'store'])->name('store');
  Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
  Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
  Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
  Route::get('/active', [ProductController::class, 'getActiveProducts'])->name('active');
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