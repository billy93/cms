<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Get all invoices
    public function index()
    {
        return response()->json(Invoice::all());
    }

    // Create new invoice
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|integer',
            'bill_to' => 'required|string',
            'ship_to' => 'nullable|string',
            'project_id' => 'nullable|integer',
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'payment_method' => 'nullable|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'signature_name' => 'nullable|string',
            'signature_image' => 'nullable|string',
            'notes' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'subtotal' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'extra_discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'total' => 'required|numeric',
        ]);

        $invoice = Invoice::create($validated);

        return response()->json($invoice, 201);
    }

    // Get single invoice
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return response()->json($invoice);
    }

    // Update invoice
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'sometimes|integer',
            'bill_to' => 'sometimes|string',
            'ship_to' => 'sometimes|string',
            'project_id' => 'sometimes|integer',
            'amount' => 'sometimes|numeric',
            'currency' => 'sometimes|string',
            'invoice_date' => 'sometimes|date',
            'due_date' => 'sometimes|date',
            'payment_method' => 'sometimes|string',
            'status' => 'sometimes|string',
            'description' => 'sometimes|string',
            'signature_name' => 'sometimes|string',
            'signature_image' => 'sometimes|string',
            'notes' => 'sometimes|string',
            'terms_and_conditions' => 'sometimes|string',
            'subtotal' => 'sometimes|numeric',
            'discount' => 'sometimes|numeric',
            'extra_discount' => 'sometimes|numeric',
            'tax' => 'sometimes|numeric',
            'total' => 'sometimes|numeric',
        ]);

        $invoice->update($validated);

        return response()->json($invoice);
    }

    // Delete invoice
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(null, 204);
    }
}
