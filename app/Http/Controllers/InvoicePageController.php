<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoicePageController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices', compact('invoices'));
    }
}
