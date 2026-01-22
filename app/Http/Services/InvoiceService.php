<?php

namespace App\Http\Services;

use App\Models\Invoice;
use App\Models\Proposal;
use App\Models\ProposalItem;
use App\Models\Customer;
use App\Models\Boq;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Exception;

class InvoiceService
{
    public function createInvoice(array $data)
    {
        return DB::transaction(function () use ( $data) {
            // ------------------------------ FIT Project Flow ------------------------------
            if (isset($data['project_id'])) {
                $project = Project::find($data['project_id']);
                
                if (!$project) {
                    throw new Exception("Project with ID {$data['project_id']} not found.");
                }

                if ($project->type !== 'FIT') {
                    throw new Exception("Only FIT projects can generate invoices directly. Regular projects must use Proposals.");
                }

                $invoiceCode = Invoice::generateCodeFromProject($project);

                $customer = Customer::find($data['customer_id']);
                if (!$customer) {
                    throw new Exception("Customer with ID {$data['customer_id']} not found.");
                }

                $invoice = Invoice::create([
                    'project_id'          => $data['project_id'], // Direct link
                    'proposal_id'         => null,
                    'customer_id'         => $data['customer_id'],
                    'code'                => $invoiceCode,
                    'invoice_date'        => $data['invoice_date'],
                    'due_date'            => $data['due_date'],
                    'description'         => $data['description'] ?? null,
                    'status'              => $data['status'],
                    'type'                => $data['type'],
                    'payment_method'      => $data['payment_method'] ?? null,
                    'bill_to'             => $data['bill_to'] ?? null,
                    'ship_to'             => $data['ship_to'] ?? null,
                    'total_amount'        => $data['total_amount'],
                    'management_fee_type' => $data['management_fee_type'],
                    'management_fee'      => $data['management_fee'],
                    'vat_rate'            => $data['vat_rate'],
                    'note'                => $data['note'] ?? null    
                ]);

                return $invoice->fresh(['project', 'customer']);
            }

            // ------------------------------ Regular Project Flow ------------------------------
            if (!isset($data['proposal_id'])) {
                 throw new Exception("Proposal ID is required for regular invoices.");
            }

            $proposal = Proposal::with(['project', 'items'])->find($data['proposal_id']);

            if (!$proposal) {
                throw new Exception("Proposal with ID {$data['proposal_id']} not found.");
            }
            
            // Validate that the project is NOT FIT (Regular projects only)
            if ($proposal->project && $proposal->project->type !== 'Regular') {
                 throw new Exception("Only Regular Projects can generate invoices via Proposals. Type is '{$proposal->project->type}'.");
            }
            
            if ($proposal->status !== 'Win') {
                throw new Exception("Invoice can only be generated for win proposals.");
            }
            
            if (!$proposal->pricing_model) {
                throw new Exception("Proposal must have a pricing model configured to generate an invoice.");
            }
            
            // Check if type 'Full' is allowed (must be the only invoice)
            if ($data['type'] === 'Full') {
                $otherInvoicesCount = $proposal->invoices()
                    ->where('status', '!=', 'Cancelled')
                    ->count();

                if ($otherInvoicesCount > 0) {
                     // If there are other existing invoices, type cannot be Full
                    throw new Exception("Cannot create a 'Full' invoice because other invoices already exist for this proposal.");
                }
                
                // Verify ALL proposal items are available (invoice_id is null)
                $unavailableItems = $proposal->items->whereNotNull('invoice_id')->count();
                if ($unavailableItems > 0) {
                    throw new Exception("Cannot create a 'Full' invoice because some items are already invoiced.");
                }

                // If Full, force select ALL proposal items
                $data['item_ids'] = $proposal->items->pluck('id')->toArray();
            } 

            // Get only items from proposal that haven't been invoiced
            $availableItemIds = $proposal->items
                ->whereNull('invoice_id')
                ->pluck('id')
                ->toArray();

            if (empty($availableItemIds)) {
                throw new Exception("No available items to be billed for this proposal.");
            }
         
            // Ensure all selected items are valid
            if (array_diff($data['item_ids'], $availableItemIds)) {
                throw new Exception("Some selected items are not available for invoicing in this proposal.");
            }

            $customer = Customer::find($data['customer_id']);
            
            if (!$customer) {
                throw new Exception("Customer with ID {$data['customer_id']} not found.");
            }
            
            // Generate invoice code for Regular (via Invoice model)
            $invoiceCode = Invoice::generateCode($proposal); 

            // Calculate amounts from selected items and proposal
            $selectedItems = $proposal->items->whereIn('id', $data['item_ids']);
            $totalAmount = $selectedItems->sum('total_price');
            
            // Calculate management fee value to store
            $managementFeeToStore = $this->calculateProposalFeeValue($proposal, $totalAmount);

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
                'management_fee_type' => $proposal->management_fee_type,
                'management_fee'      => $managementFeeToStore,
                'vat_rate'            => $proposal->vat_rate,
                'note'                => $data['note'] ?? null    
            ]);
            
            // Link items to invoice
            ProposalItem::whereIn('id', $data['item_ids'])
                ->update(['invoice_id' => $invoice->id]);

            return $invoice->fresh(['proposal', 'customer', 'items']);
        });
    }

    
    public function getInvoiceById($id)
    {
        $invoice = Invoice::with(['proposal.project', 'proposal.items', 'customer', 'items'] )->find($id);
        if (!$invoice) {
            throw new Exception("Invoice with ID {$id} not found");
        }
        return $invoice;
    }

    public function updateInvoice(array $data)
    {
        return DB::transaction(function () use ( $data) {
            $invoice = Invoice::find($data['id']);

            if (!$invoice) {
                throw new Exception("Invoice with ID {$data['id']} not found.");
            }

            // ------------------------------ FIT Project Flow ------------------------------
            if ($invoice->project_id) {
                /* For FIT, we expect financial fields to be passed, but we trust the Model accessors for amounts.
                 * Just update the base values.
                 */
                $invoice->update([
                    'invoice_date'        => $data['invoice_date'],
                    'due_date'            => $data['due_date'],
                    'description'         => $data['description'] ?? null,
                    'status'              => $data['status'],
                    'type'                => $data['type'],
                    'payment_method'      => $data['payment_method'] ?? null,
                    'bill_to'             => $data['bill_to'] ?? null,
                    'ship_to'             => $data['ship_to'] ?? null,
                    'total_amount'        => $data['total_amount'],
                    'management_fee_type' => $data['management_fee_type'],
                    'management_fee'      => $data['management_fee'],
                    'vat_rate'            => $data['vat_rate'],
                    'note'                => $data['note'] ?? null,
                ]);

                return $invoice->fresh(['project', 'customer']);
            }

            // ------------------------------ Regular Project Flow ------------------------------
            $proposalId = $invoice->proposal_id;
            $proposal = Proposal::with(['items'])->find($proposalId);

            if (!$proposal) {
                throw new Exception("Proposal with ID {$proposalId} not found.");
            }
            
            if ($proposal->status !== 'Win') {
                throw new Exception("Invoice can only be edited for win proposals.");
            }

            if (!$proposal->pricing_model) {
                throw new Exception("Proposal must have a pricing model configured to generate an invoice.");
            }
            
            // Invoice Type Validation. Check if type 'Full' is allowed (must be the only invoice)
            if ($data['type'] === 'Full') {
                $otherInvoicesCount = $proposal->invoices()
                    ->where('id', '!=', $invoice->id) // Exclude current invoice
                    ->where('status', '!=', 'Cancelled')
                    ->count();

                if ($otherInvoicesCount > 0) {
                     // If there are other existing invoices, type cannot be Full
                    throw new Exception("Cannot set invoice type to 'Full' because other invoices already exist for this proposal.");
                }

                // Verify ALL proposal items are available (invoice_id is null OR owned by current invoice)
                $unavailableItems = $proposal->items
                    ->filter(fn($b) => $b->invoice_id !== null && $b->invoice_id !== $invoice->id)
                    ->count();

                if ($unavailableItems > 0) {
                    throw new Exception("Cannot set 'Full' type because some items are billed in other invoices.");
                }

                // If type is Full, force select ALL proposal items
                $data['item_ids'] = $proposal->items->pluck('id')->toArray();
            }

            // Get only items from proposal that haven't been invoiced
            $availableItemIds = $proposal->items
                ->filter(fn($item) => !$item->invoice_id || $item->invoice_id === $invoice->id)
                ->pluck('id')
                ->toArray();

            if (empty($availableItemIds)) {
                throw new Exception("No available items to be billed for this proposal.");
            }
         
             // Make sure all selected items are available
            if (array_diff($data['item_ids'], $availableItemIds)) {
                throw new Exception("Some selected items are not available for invoicing in this proposal.");
            } 

            $customer = Customer::find($data['customer_id']);
            
            if (!$customer) {
                throw new Exception("Customer with ID {$data['customer_id']} not found.");
            }
            
            // Calculate amounts from selected items and proposal
            $selectedItems = $proposal->items->whereIn('id', $data['item_ids']);
            $totalAmount = $selectedItems->sum('total_price');
            
            // Calculate management fee value to store
            $managementFeeToStore = $this->calculateProposalFeeValue($proposal, $totalAmount);
            
            $invoice->update([
                'invoice_date'        => $data['invoice_date'],
                'due_date'            => $data['due_date'],
                'status'              => $data['status'],
                'type'                => $data['type'],
                'payment_method'      => $data['payment_method'] ?? null,
                'bill_to'             => $data['bill_to'] ?? null,
                'ship_to'             => $data['ship_to'] ?? null,
                'total_amount'        => $totalAmount,
                'management_fee_type' => $proposal->management_fee_type,
                'management_fee'      => $managementFeeToStore,
                'vat_rate'            => $proposal->vat_rate,
                'note'                => $data['note'] ?? null,
            ]);
            
            // Reset old items
            ProposalItem::where('invoice_id', $invoice->id)->update(['invoice_id' => null]);

            // Relink new items
            ProposalItem::whereIn('id', $data['item_ids'])->update(['invoice_id' => $invoice->id]);

            return $invoice->fresh(['proposal', 'customer', 'items']);
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
     * Calculate Management Fee Value to Store (Logic for Proposal-based invoicing)
     * If percent: returns the Rate (e.g. 10).
     * If nominal: returns the Proportional Amount (e.g. 250000).
     */
    private function calculateProposalFeeValue(Proposal $proposal, $totalAmount)
    {
        $totalAmount = (float) $totalAmount;
        $managementFee = (float) ($proposal->management_fee ?? 0);

        if ($proposal->management_fee_type === 'percent') {
            // Return Rate
            return $managementFee;
        } else {
            // Nominal Proportional Logic
            // Return Calculated Amount
            $totalProposalAmount = (float) $proposal->items->sum('total_price');
            if ($totalProposalAmount > 0) {
                $proportion = $totalAmount / $totalProposalAmount;
                return $managementFee * $proportion;
            }
            return 0; // Or keep as 0 if inconsistent
        }
    }
}
