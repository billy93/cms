<?php

namespace App\Http\Services;

use App\Models\Invoice;
use App\Models\Proposal;
use App\Models\Customer;
use App\Models\Boq;
use Illuminate\Support\Facades\DB;
use Exception;

class InvoiceService
{
    /**
     * Generate invoice from a proposal
     */
    public function createInvoice(array $data)
    {
        return DB::transaction(function () use ( $data) {
            $proposal = Proposal::with(['project', 'boqs'])->find($data['proposal_id']);

            if (!$proposal) {
                throw new Exception("Proposal with ID {$data['proposal_id']} not found.");
            }
            
            if ($proposal->status !== 'Win') {
                throw new Exception("Invoice can only be generated for win proposals.");
            }
            
            // Ambil hanya BOQ dari proposal yang belum diinvoice
            $availableBoqIds = $proposal->boqs
                ->whereNull('invoice_id')
                ->pluck('id')
                ->toArray();

            if (empty($availableBoqIds)) {
                throw new Exception("No available BOQs to be billed for this proposal.");
            }
         
             // Pastikan semua BOQ yang dipilih valid
            if (array_diff($data['boq_ids'], $availableBoqIds)) {
                throw new Exception("Some selected BOQs are not available for invoicing in this proposal.");
            } 
            
            $customer = Customer::find($data['customer_id']);
            
            if (!$customer) {
                throw new Exception("Customer with ID {$data['customer_id']} not found.");
            }
            
            // Hitung total dari semua BOQ
            $totalAmount = $proposal->boqs
                ->whereIn('id', $data['boq_ids'])
                ->sum('invoice_amount'); 
            
            // Generate invoice code
            $invoiceCode = Invoice::generateCode($proposal); 

             // Buat invoice baru
            $invoice = Invoice::create([
                'proposal_id'    => $data['proposal_id'],
                'customer_id'    => $data['customer_id'],
                'code'           => $invoiceCode,
                'invoice_date'   => $data['invoice_date'],
                'due_date'       => $data['due_date'],
                'status'         => $data['status'],
                'type'           => $data['type'],
                'payment_method' => $data['payment_method'],
                'bill_to'        => $data['bill_to'],
                'ship_to'        => $data['ship_to'],
                'total_amount'   => $totalAmount,
                'note'           => $data['note']    
            ]);
            // Link BOQs ke invoice
            Boq::whereIn('id', $data['boq_ids'])
                ->update(['invoice_id' => $invoice->id]);

            return $invoice->fresh(['proposal', 'customer', 'boqs']);
        });
    }

    
    public function getInvoiceById($id)
    {
        $invoice = Invoice::with(['proposal.project', 'proposal.boqs', 'customer', 'boqs'] )->find($id);
        if (!$invoice) {
            throw new Exception("Invoice with ID {$id} not found");
        }
        return $invoice;
    }

    public function updateInvoice(array $data)
    {
        return DB::transaction(function () use ( $data) {
            $invoice = Invoice::with(['boqs'])->find($data['id']);
            $proposal = Proposal::with(['boqs'])->find($data['proposal_id']);

            if (!$invoice) {
                throw new Exception("Invoice with ID {$data['id']} not found.");
            }

            if (!$proposal) {
                throw new Exception("Proposal with ID {$data['proposal_id']} not found.");
            }
            
            if ($proposal->status !== 'Win') {
                throw new Exception("Invoice can only be edited for win proposals.");
            }
            
            // Ambil hanya BOQ dari proposal yang belum diinvoice
            $availableBoqIds = $proposal->boqs
                ->filter(fn($boq) => !$boq->invoice_id || $boq->invoice_id === $invoice->id)
                ->pluck('id')
                ->toArray();

            if (empty($availableBoqIds)) {
                throw new Exception("No available BOQs to be billed for this proposal.");
            }
         
             // Pastikan semua BOQ yang dipilih valid
            if (array_diff($data['boq_ids'], $availableBoqIds)) {
                throw new Exception("Some selected BOQs are not available for invoicing in this proposal.");
            } 
            
            $customer = Customer::find($data['customer_id']);
            
            if (!$customer) {
                throw new Exception("Customer with ID {$data['customer_id']} not found.");
            }
            
            // Hitung total dari semua BOQ
            $totalAmount = $proposal->boqs
                ->whereIn('id', $data['boq_ids'])
                ->sum('invoice_amount'); 
            
                 
            $invoice->update([
                // 'proposal_id'    => $data['proposal_id'],
                // 'customer_id'    => $data['customer_id'],
                'invoice_date'   => $data['invoice_date'],
                'due_date'       => $data['due_date'],
                'status'         => $data['status'],
                'type'           => $data['type'],
                'payment_method' => $data['payment_method'] ?? null,
                'bill_to'        => $data['bill_to'] ?? null,
                'ship_to'        => $data['ship_to'] ?? null,
                'total_amount'   => $totalAmount,
                'note'           => $data['note'] ?? null,
            ]);
            
            // --- Reset semua BOQ lama ---
            Boq::where('invoice_id', $invoice->id)->update(['invoice_id' => null]);

            // --- Relink BOQ baru ---
            Boq::whereIn('id', $data['boq_ids'])->update(['invoice_id' => $invoice->id]);

            return $invoice->fresh(['proposal', 'customer', 'boqs']);
        });
    }
    
    public function deleteInvoice($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            throw new Exception("Invoice with ID {$id} not found");
        }

        $invoice->delete();
    }
}
