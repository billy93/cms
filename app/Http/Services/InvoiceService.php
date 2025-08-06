<?php

namespace App\Http\Services;

use App\Models\Invoice;
use App\Http\Exceptions\CustomApiException;

class InvoiceService
{
    public function createInvoice(array $data)
    {
        return Invoice::create([
            'invoice_date' => $data['invoice_date'],
            'payment_method' => $data['payment_method'] ?? null,
            'status' => $data['status'] ?? null,
            'description' => $data['description'],
            'signature_name' => $data['signature_name'] ?? null,
            'signature_image' => $data['signature_image'] ?? null,
            'notes' => $data['notes'] ?? null,
            'terms_and_conditions' => $data['terms_and_conditions'] ?? null,
            'subtotal' => $data['subtotal'],
            'discount' => $data['discount'] ?? null,
            'extra_discount' => $data['extra_discount'] ?? null,
            'tax' => $data['tax'] ?? null,
            'total' => $data['total'],
        ]);
    }

    public function getAllInvoices()
    {
        return Invoice::all();
    }

    public function getInvoiceById($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            throw new CustomApiException("Invoice with ID {$id} not found", 404);
        }

        return $invoice;
    }

    public function updateInvoice($id, array $data)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            throw new CustomApiException("Invoice with ID {$id} not found", 404);
        }

        $invoice->update([
            'invoice_date' => $data['invoice_date'],
            'payment_method' => $data['payment_method'] ?? null,
            'status' => $data['status'] ?? null,
            'description' => $data['description'],
            'signature_name' => $data['signature_name'] ?? null,
            'signature_image' => $data['signature_image'] ?? null,
            'notes' => $data['notes'] ?? null,
            'terms_and_conditions' => $data['terms_and_conditions'] ?? null,
            'subtotal' => $data['subtotal'],
            'discount' => $data['discount'] ?? null,
            'extra_discount' => $data['extra_discount'] ?? null,
            'tax' => $data['tax'] ?? null,
            'total' => $data['total'],
        ]);

        return $invoice;
    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            throw new CustomApiException("Invoice with ID {$id} not found", 404);
        }

        $invoice->delete();
    }
}
