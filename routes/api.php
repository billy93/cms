<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BoqController;

Route::apiResource('invoices', InvoiceController::class);
Route::apiResource('boqs', BoqController::class);