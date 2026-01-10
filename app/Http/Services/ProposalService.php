<?php

namespace App\Http\Services;

use App\Models\Proposal;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class ProposalService
{
    public function createProposal(array $data)
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'] ?? [];
            unset($data['items']);

            $data['code'] = Proposal::generateCode();
            
            $totalAmountItems = 0;
            
            // Normalize inputs
            if (isset($data['management_fee'])) {
                $data['management_fee'] = $this->normalizePrice($data['management_fee']);
            }
            // For Type A, total_amount_items is direct input
            if (($data['pricing_model'] ?? '') === 'A' && isset($data['total_amount_items'])) {
                $data['total_amount_items'] = $this->normalizePrice($data['total_amount_items']);
                $totalAmountItems = $data['total_amount_items'];
            }
            $proposal = Proposal::create($data);

            if ($data['pricing_model'] === 'A') {
                // Type A: Create a single item for the total amount to allow invoicing
                $proposal->items()->create([
                    'proposal_id' => $proposal->id,
                    'description' => $proposal->pricing_model_description,
                    'selling_price' => $totalAmountItems,
                    'total_price' => $totalAmountItems,
                    'title1_key' => 'Qty',
                    'title1_value' => 1,
                    // No validation on fields as Type A is summary
                ]);
            } else {
                foreach ($items as $itemData) {
                    $multiplier = 0;
                    $sellingPrice = 0;

                    if (isset($itemData['selling_price'])) {
                        $itemData['selling_price'] = $this->normalizePrice($itemData['selling_price']);
                    }

                    switch ($data['pricing_model']) {
                        case 'B':
                            // Type B: selling_price is the input. Qty is multiplier.
                            $sellingPrice = $itemData['selling_price']; 
                            
                            $itemData['title1_key'] = 'Qty';
                            $itemData['title1_value'] = $itemData['qty'];
                            
                            $multiplier = $itemData['qty'] * $sellingPrice;
                            break;

                        case 'C':
                        case 'D':
                            // Type C/D: Use selling_price from payload
                            // Type C sends selling_price. Type D might need flexible handling but user said "ga ada amount".
                            
                            if (!empty($itemData['product_id'])) {
                                $product = Product::find($itemData['product_id']);
                                if ($product) {
                                     $itemData['subheader'] = $itemData['subheader'] ?? $product->name;
                                     if (!$itemData['subheader']) $itemData['subheader'] = $product->name;
                                }
                            }
                            
                            $sellingPrice = $itemData['selling_price'] ?? 0;
                            $multiplier = $sellingPrice;

                            for ($i = 1; $i <= 4; $i++) {
                                $valKey = "title{$i}_value";
                                if (!empty($itemData[$valKey])) {
                                    $multiplier *= $itemData[$valKey];
                                }
                            }
                            break;
                            
                        default:
                            $multiplier = 0;
                    }

                    // Prepare DB Data
                    $dbItem = [
                        'proposal_id' => $proposal->id,
                        'product_id' => $itemData['product_id'] ?? null,
                        'header' => $itemData['header'] ?? null,
                        'subheader' => $itemData['subheader'] ?? ($itemData['description'] ?? null),
                        'selling_price' => $sellingPrice,
                        'total_price' => $multiplier,
                        'description' => $itemData['description'] ?? null,
                        'title1_key' => $itemData['title1_key'] ?? null,
                        'title1_value' => $itemData['title1_value'] ?? null,
                        'title2_key' => $itemData['title2_key'] ?? null,
                        'title2_value' => $itemData['title2_value'] ?? null,
                        'title3_key' => $itemData['title3_key'] ?? null,
                        'title3_value' => $itemData['title3_value'] ?? null,
                        'title4_key' => $itemData['title4_key'] ?? null,
                        'title4_value' => $itemData['title4_value'] ?? null,
                    ];
                    
                    $proposal->items()->create($dbItem);

                    $totalAmountItems += $multiplier;
                }
            }

            $proposal->update([
                'total_amount_items' => $totalAmountItems,
            ]);

            return $proposal->fresh(['project.customer', 'items.product']);
        });
    }

    public function updateProposal($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $proposal = Proposal::with('items')->find($id);
            if (!$proposal) {
                throw new Exception("Proposal with ID {$id} not found");
            }

            if (strtolower($proposal->status) === 'win') {
                throw new Exception("Proposal with status 'Win' cannot be modified.");
            }

            $items = $data['items'] ?? [];
            unset($data['items']);
            
            $totalAmountItems = 0;
            
             // Normalize inputs
            if (isset($data['management_fee'])) {
                $data['management_fee'] = $this->normalizePrice($data['management_fee']);
            }
            // For Type A, total_amount_items is direct input
            if (($data['pricing_model'] ?? '') === 'A' && isset($data['total_amount_items'])) {
                $data['total_amount_items'] = $this->normalizePrice($data['total_amount_items']);
                $totalAmountItems = $data['total_amount_items'];
            }

            // Update Proposal fields
            $proposal->update($data);
            
            // Delete existing items
            $proposal->items()->delete();

            if ($data['pricing_model'] === 'A') {
                // Type A: Create a single item for the total amount
                 $proposal->items()->create([
                    'proposal_id' => $proposal->id,
                    'description' => $proposal->pricing_model_description,
                    'selling_price' => $totalAmountItems,
                    'total_price' => $totalAmountItems,
                    'title1_key' => 'Qty',
                    'title1_value' => 1,
                ]);
            } else {
                foreach ($items as $itemData) {
                    $multiplier = 0;
                    $sellingPrice = 0;

                    if (isset($itemData['selling_price'])) {
                        $itemData['selling_price'] = $this->normalizePrice($itemData['selling_price']);
                    }

                    switch ($data['pricing_model']) {
                        case 'B':
                            // Type B: selling_price is the input. Qty is multiplier.
                            $sellingPrice = $itemData['selling_price']; 
                            
                            $itemData['title1_key'] = 'Person';
                            $itemData['title1_value'] = $itemData['qty'];
                            
                            $multiplier = $itemData['qty'] * $sellingPrice;
                            break;

                        case 'C':
                        case 'D':
                            // Type C/D: Use selling_price from payload
                            // Type C sends selling_price. Type D might need flexible handling but user said "ga ada amount".
                            
                            if (!empty($itemData['product_id'])) {
                                $product = Product::find($itemData['product_id']);
                                if ($product) {
                                     $itemData['subheader'] = $itemData['subheader'] ?? $product->name;
                                     if (!$itemData['subheader']) $itemData['subheader'] = $product->name;
                                }
                            }
                            
                            $sellingPrice = $itemData['selling_price'] ?? 0;
                            $multiplier = $sellingPrice;

                            for ($i = 1; $i <= 4; $i++) {
                                $valKey = "title{$i}_value";
                                if (!empty($itemData[$valKey])) {
                                    $multiplier *= $itemData[$valKey];
                                }
                            }
                            break;
                            
                        default:
                            $multiplier = 0;
                    }

                    // Prepare DB Data
                    $dbItem = [
                        'proposal_id' => $proposal->id,
                        'product_id' => $itemData['product_id'] ?? null,
                        'header' => $itemData['header'] ?? null,
                        'subheader' => $itemData['subheader'] ?? ($itemData['description'] ?? null),
                        'selling_price' => $sellingPrice,
                        'total_price' => $multiplier,
                        'description' => $itemData['description'] ?? null,
                        'title1_key' => $itemData['title1_key'] ?? null,
                        'title1_value' => $itemData['title1_value'] ?? null,
                        'title2_key' => $itemData['title2_key'] ?? null,
                        'title2_value' => $itemData['title2_value'] ?? null,
                        'title3_key' => $itemData['title3_key'] ?? null,
                        'title3_value' => $itemData['title3_value'] ?? null,
                        'title4_key' => $itemData['title4_key'] ?? null,
                        'title4_value' => $itemData['title4_value'] ?? null,
                    ];
                    
                    $proposal->items()->create($dbItem);

                    $totalAmountItems += $multiplier;
                }
            }

            $proposal->update([
                'total_amount_items' => $totalAmountItems,
            ]);
            
            // Check for Win status to generate sales code
             if (($data['status'] ?? null) === 'Win') {
                 if (!$proposal->sales_code) {
                    $proposal->update([
                        'sales_code' => Proposal::generateSalesCode(
                            $proposal->project_id,
                            $proposal->id 
                        ),
                    ]);
                 }
            }

            return $proposal->fresh(['project.customer', 'items.product']);
        });
    }

    public function getAllProposals()
    {
        return Proposal::with('project', 'invoices')->get();
    }

    public function getProposalById($id)
    {
        $proposal = Proposal::with([
            'project.customer',
            'items.product' => function ($q) {
                $q->with([
                    'activePriceVersion',
                    'priceVersions',
                ]);
            },
            'invoices.items',
        ])->find($id);

        if (!$proposal) {
            throw new Exception("Proposal with ID {$id} not found");
        }
        return $proposal;
    }

    public function deleteProposal($id)
    {
        $proposal = Proposal::find($id);
        if (!$proposal) {
            throw new Exception("Proposal with ID {$id} not found");
        }

        // 🔒 Guard: Prevent proposal with status 'Win' from being deleted
        if (strtolower($proposal->status) === 'win') {
            throw new Exception("Proposal with status 'Win' cannot be modified.");
        }

        $proposal->delete();
    }
    
    public function savePricingModel(array $data)
    {
         // Can be removed as it's likely unused now, but keeping as placeholder if needed or redirecting to updateProposal
         return $this->updateProposal($data['id'], $data);
    }

    private function normalizePrice(string|int|float|null $value): float
    {
        if ($value === null) {
            return 0.0;
        }

        if (is_int($value) || is_float($value)) {
            return (float) $value;
        }

        // 22.000.000,75 → 22000000.75
        $normalized = str_replace('.', '', $value);
        $normalized = str_replace(',', '.', $normalized);

        return (float) $normalized;
    }
}
