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
            
            if (!$proposal->pricing_model) {
                throw new Exception("Proposal must have a pricing model configured to generate an invoice.");
            }
            
            // --- Validation for Invoice Type ---
            // 1. Check if 'Full' is allowed (must be the only invoice)
            if ($data['type'] === 'Full') {
                $otherInvoicesCount = $proposal->invoices()
                    ->where('status', '!=', 'Cancelled')
                    ->count();

                if ($otherInvoicesCount > 0) {
                     // If there are existing invoices, type cannot be Full
                    throw new Exception("Cannot create a 'Full' invoice because other invoices already exist for this proposal.");
                }
                
                // Verify ALL proposal BOQs are available (invoice_id is null)
                $unavailableBoqs = $proposal->boqs->whereNotNull('invoice_id')->count();
                if ($unavailableBoqs > 0) {
                    throw new Exception("Cannot create a 'Full' invoice because some BOQs are already invoiced.");
                }

                // If Full, force select ALL proposal BOQs
                $data['boq_ids'] = $proposal->boqs->pluck('id')->toArray();
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
            
            // Generate invoice code
            $invoiceCode = Invoice::generateCode($proposal); 

            // Calculate amounts from selected BOQs and proposal
            $selectedBoqs = $proposal->boqs->whereIn('id', $data['boq_ids']);
            $totalAmount = $selectedBoqs->sum('total_amount_items');
            
            // Calculate management fee from proposal (proportional for partial invoices)
            // Calculate amounts using shared logic
            $amounts = $this->calculateInvoiceAmounts($proposal, $totalAmount);
            $managementFeeAmount = $amounts['management_fee'];
            $salesAmount = $amounts['sales_amount'];
            $vatAmount = $amounts['vat_amount'];
            $invoiceAmount = $amounts['invoice_amount'];

             // Buat invoice baru
            $invoice = Invoice::create([
                'proposal_id'         => $data['proposal_id'],
                'customer_id'         => $data['customer_id'],
                'code'                => $invoiceCode,
                'invoice_date'        => $data['invoice_date'],
                'due_date'            => $data['due_date'],
                'status'              => $data['status'],
                'type'                => $data['type'],
                'payment_method'      => $data['payment_method'] ?? null,
                'bill_to'             => $data['bill_to'] ?? null,
                'ship_to'             => $data['ship_to'] ?? null,
                'total_amount'        => $totalAmount,
                'management_fee'      => $managementFeeAmount,
                'sales_amount'        => $salesAmount,
                'vat_amount'          => $vatAmount,
                'invoice_amount'      => $invoiceAmount,
                'note'                => $data['note'] ?? null    
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
            
            // --- Validation for Invoice Type ---
            // 1. Check if 'Full' is allowed (must be the only invoice)
            if ($data['type'] === 'Full') {
                $otherInvoicesCount = $proposal->invoices()
                    ->where('id', '!=', $invoice->id) // Exclude current invoice
                    ->where('status', '!=', 'Cancelled')
                    ->count();

                if ($otherInvoicesCount > 0) {
                     // If there are other existing invoices, type cannot be Full
                    throw new Exception("Cannot set invoice type to 'Full' because other invoices already exist for this proposal.");
                }

                // Verify ALL proposal BOQs are available (invoice_id is null OR owned by current invoice)
                $unavailableBoqs = $proposal->boqs
                    ->filter(fn($b) => $b->invoice_id !== null && $b->invoice_id !== $invoice->id)
                    ->count();

                if ($unavailableBoqs > 0) {
                    throw new Exception("Cannot set 'Full' type because some BOQs are billed in other invoices.");
                }

                 // If Full, force select ALL proposal BOQs
                 $data['boq_ids'] = $proposal->boqs->pluck('id')->toArray();
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
            
            // Calculate amounts from selected BOQs and proposal
            $selectedBoqs = $proposal->boqs->whereIn('id', $data['boq_ids']);
            $totalAmount = $selectedBoqs->sum('total_amount_items');
            
            // Calculate amounts using shared logic
            $amounts = $this->calculateInvoiceAmounts($proposal, $totalAmount);
            $managementFeeAmount = $amounts['management_fee'];
            $salesAmount = $amounts['sales_amount'];
            $vatAmount = $amounts['vat_amount'];
            $invoiceAmount = $amounts['invoice_amount'];
            
            $invoice->update([
                'invoice_date'        => $data['invoice_date'],
                'due_date'            => $data['due_date'],
                'status'              => $data['status'],
                'type'                => $data['type'],
                'payment_method'      => $data['payment_method'] ?? null,
                'bill_to'             => $data['bill_to'] ?? null,
                'ship_to'             => $data['ship_to'] ?? null,
                'total_amount'        => $totalAmount,
                'management_fee'      => $managementFeeAmount,
                'sales_amount'        => $salesAmount,
                'vat_amount'          => $vatAmount,
                'invoice_amount'      => $invoiceAmount,
                'note'                => $data['note'] ?? null,
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

    /**
     * Calculate all invoice amounts based on selected BOQ total and proposal settings.
     */
    private function calculateInvoiceAmounts(Proposal $proposal, $totalAmount)
    {
        // Calculate management fee
        $managementFeeAmount = 0;
        
        // Ensure inputs are numeric to prevent overflow from weird types
        $totalAmount = (float) $totalAmount;
        $managementFee = (float) ($proposal->management_fee ?? 0);
        
        if ($proposal->management_fee_type === 'percent') {
            // Percent: automatically proportional
            $managementFeeAmount = ($totalAmount * $managementFee) / 100;
        } else {
            // Nominal: calculate proportion based on selected BOQ vs total BOQ
            $totalProposalAmount = (float) $proposal->boqs->sum('total_amount_items');
            
            if ($totalProposalAmount > 0) {
                // Prevent division by zero and weird infinite numbers
                $proportion = $totalAmount / $totalProposalAmount;
                $managementFeeAmount = $managementFee * $proportion;
            } else {
                 // Check if totalAmount is also 0, then fee is 0. 
                 // If totalAmount > 0 but totalProposalAmount is 0 (should imply data inconsistency), default to 0 to be safe.
                $managementFeeAmount = 0;
            }
        }
        
        $managementFeeAmount = round($managementFeeAmount, 2);
        
        // Sales amount = total_amount + management_fee
        $salesAmount = round($totalAmount + $managementFeeAmount, 2);

        // Calculate VAT from proposal vat_rate
        $vatRate = (float) $proposal->vat_rate;
        $vatAmount = round(($salesAmount * $vatRate) / 100, 2);
        
        // Invoice amount = sales_amount + vat_amount
        $invoiceAmount = round($salesAmount + $vatAmount, 2);

        return [
            'management_fee' => $managementFeeAmount,
            'sales_amount' => $salesAmount,
            'vat_amount' => $vatAmount,
            'invoice_amount' => $invoiceAmount,
        ];
    }
}
