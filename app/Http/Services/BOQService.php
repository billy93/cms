<?php

namespace App\Http\Services;

use App\Models\Boq;
use App\Models\Product;
use App\Models\Proposal;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BoqService
{

    public function createBoq(array $data)
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'] ?? [];
            unset($data['items']); 
            
            $data['code'] = BOQ::generateCode();
            $data['proposal_id'] = $data['proposal_id'] ?? null;

            $boq = Boq::create($data);

            if (!empty($data['proposal_id'])) {
                $proposal = Proposal::find($data['proposal_id']);

                // 🔒 Guard: Prevent proposal with status 'Win' from being associated with new BOQ 
                if ($proposal && strtolower($proposal->status) === 'win') {
                   throw new Exception("Cannot associate a BOQ with a proposal that has been marked as 'Win'.");
                }

                $boq->proposal()->associate($proposal);
                $boq->save();
            }

            $totalAmountItems = 0;

            if ($data['form_type'] === 'A') {
                $totalAmountItems = $data['total_amount_items'];
            } else {
                foreach ($items as $itemData) {
                    switch ($data['form_type']) {
                        case 'B':
                            $itemData['unit_price'] = $itemData['amount'];
                            $itemData['title1_key'] = 'Person';
                            $itemData['title1_value'] = $itemData['qty'];
                            $multiplier = $itemData['qty'] * $itemData['amount'];
                            break;
                        case 'C':
                        case 'D':
                            $amount = $itemData['amount'] ;

                            if (!empty($itemData['product_id'])) {
                                $product = Product::find($itemData['product_id']);
                                $itemData['subheader'] = $product?->name ?? $itemData['subheader'];
                                $amount = $product->base_cost; 
                            }

                            $itemData['unit_price'] = $amount;
                            $multiplier = $amount;

                            for ($i = 1; $i <= 4; $i++) {
                                $valKey = "title{$i}_value";
                                if (!empty($itemData[$valKey])) {
                                    $multiplier *= $itemData[$valKey];
                                }
                            }

                            unset($itemData['amount']);
                            break;
                        default:
                            $multiplier = 0;
                    }

                    $itemData['multiplier_total'] = $multiplier;

                    $boq->items()->create($itemData);

                    $totalAmountItems += $multiplier;
                }
            }

            $managementFee = 0;
            if (!empty($data['management_fee'])) {
                if (($data['management_fee_type'] ?? 'percent') === 'percent') {
                    $managementFee = ($totalAmountItems * $data['management_fee']) / 100;
                } else {
                    $managementFee = $data['management_fee'];
                }
            }

            $salesAmount = $totalAmountItems + $managementFee;
            $vatRate = $data['vat_rate']; // langsung pakai number
            $vat = ($salesAmount * $vatRate / 100);
            $invoiceAmount = $salesAmount + $vat;

            $boq->update([
                'total_amount_items' => $totalAmountItems,
                'management_fee' => $data['management_fee'] ?? null,
                'sales_amount' => $salesAmount,
                'vat' => $vat,
                'invoice_amount' => $invoiceAmount
            ]);

            return $boq->fresh('items');
        });
    }

    public function getAllBoqs()
    {
        return Boq::with('items')->get();
    }

    public function getBoqById($id)
    {
        $boq = Boq::with(['proposal', 'items'])->find($id);
        if (!$boq) {
            throw new Exception("BOQ with ID {$id} not found");
        }

        return $boq;
    }

    public function updateBoq($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            /**
             * 1. Check if it exists.
             * 2. Get the related proposal and ensure its status is not equal to 'Win'.
             * 3. Separate BOQ items.
             * 4. Associate the proposal if it exists, associate an empty BOQ if proposal_id does not exist.
             */

            $boq = Boq::with('proposal')->find($id);
            if (!$boq) {
                throw new Exception("BOQ with ID {$id} not found");
            }

            // 🔒 Guard: Prevent BOQ with proposal status 'Win' from being updated
            if ($boq->proposal && strtolower($boq->proposal->status) === 'win') {
                throw new Exception("BOQ cannot be modified because the associated proposal has already been marked as 'Win'.");
            }

            $items = $data['items'] ?? [];
            unset($data['items']);
       
            if (!empty($data['proposal_id'])) {
                $proposal = Proposal::find($data['proposal_id']);
                $boq->proposal()->associate($proposal);
            } else {
                $boq->proposal()->dissociate();
            }

            // Save association update
            $boq->save();

            // Update BOQ fields
            $boq->update($data);

            // BOQ Items fully replaced
            $boq->items()->delete();

            $totalAmountItems = 0;

            // Creates BOQ Items
            if ($data['form_type'] === 'A') {
                $totalAmountItems = $data['total_amount_items'];
            } else {
                foreach ($items as $itemData) {
                    switch ($data['form_type']) {
                        case 'B':
                            $itemData['unit_price'] = $itemData['amount'];
                            $itemData['title1_key'] = 'Person';
                            $itemData['title1_value'] = $itemData['qty'];
                            $multiplier = $itemData['qty'] * $itemData['amount'];
                            break;

                        case 'C':
                        case 'D':
                            $amount = $itemData['amount'];

                            if (!empty($itemData['product_id'])) {
                                $product = Product::find($itemData['product_id']);
                                $itemData['subheader'] = $product?->name ?? $itemData['subheader'];
                                $amount = $product->base_cost; 
                            } 

                            $itemData['unit_price'] = $amount;
                            $multiplier = $amount;
                            for ($i = 1; $i <= 4; $i++) {
                                $valKey = "title{$i}_value";
                                if (!empty($itemData[$valKey])) {
                                    $multiplier *= $itemData[$valKey];
                                }
                            }

                            unset($itemData['amount']);
                            break;

                        default:
                            $multiplier = 0;
                    }

                    $itemData['multiplier_total'] = $multiplier;
                    $boq->items()->create($itemData);
                    $totalAmountItems += $itemData['multiplier_total'];
                }
            }

            // Calc management fee
            $managementFee = 0;
            if (!empty($data['management_fee'])) {
                if (($data['management_fee_type'] ?? 'percent') === 'percent') {
                    $managementFee = ($totalAmountItems * $data['management_fee']) / 100;
                } else {
                    $managementFee = $data['management_fee'];
                }
            }

            // Calc sales_amount
            $salesAmount = $totalAmountItems + $managementFee;

            // Calc VAT & invoice_amount
            $vatRate = $data['vat_rate'];
            $vat = ($salesAmount * $vatRate / 100);
            $invoiceAmount = $salesAmount + $vat;

            // Update BOQ
            $boq->update([
                'total_amount_items' => $totalAmountItems,
                'management_fee' => $data['management_fee'] ?? null,
                'sales_amount' => $salesAmount,
                'vat' => $vat,
                'invoice_amount' => $invoiceAmount
            ]);

            return $boq->fresh('items');
        });
    }

    
    public function replicate(array $boq_ids, ?int $proposal_id = null)
    {
        return DB::transaction(function () use ($boq_ids, $proposal_id) {
            // 🔹 Validasi proposal jika dikirim
            $proposal = null;
            if ($proposal_id) {
                $proposal = Proposal::find($proposal_id);

                if (!$proposal) {
                    throw new Exception("Proposal with ID {$proposal_id} not found.");
                }

                if (strtolower($proposal->status) === 'win') {
                    throw new Exception("Cannot bind BOQs to a 'Win' proposal.");
                }
            }

            $foundBoqs = Boq::whereIn('id', $boq_ids)->get();
            $foundIds = $foundBoqs->pluck('id')->toArray();
            $missingIds = array_diff($boq_ids, $foundIds);

            if (!empty($missingIds)) {
                $list = implode(', ', $missingIds);
                throw new Exception("BOQs with IDs [{$list}] not found.");
            }

            $newBoqs = collect();

            foreach ($foundBoqs as $boq) {
                // 🔹 Jika BOQ belum punya proposal, langsung associate
                if (is_null($boq->proposal_id)) {
                    $boq->proposal_id = $proposal_id;
                    $boq->save();

                    $newBoqs->push($boq);
                    continue;
                }

                // 🔹 Jika sudah punya proposal, replikasi penuh
                $newBoqs->push($boq->replicateWithItems($proposal_id));
            }

            return $newBoqs;
        });
    }

    public function unbindProposal(array $boq_ids = [], ?int $boq_id = null)
    {
        return DB::transaction(function () use ($boq_ids, $boq_id) {

            // Single BOQ
            $boqs = $boq_id
                ? Boq::with('proposal')->where('id', $boq_id)->get()
                : Boq::with('proposal')->whereIn('id', $boq_ids)->get();

            // Cek yang tidak ditemukan hanya untuk bulk
            if (!$boq_id) {
                $foundIds = $boqs->pluck('id')->toArray();
                $missingIds = array_diff($boq_ids, $foundIds);
                if (!empty($missingIds)) {
                    $list = implode(', ', $missingIds);
                    throw new \Exception("BOQs with IDs [{$list}] not found.");
                }
            }

            // Dissociate proposal dengan guard 'Win'
            $boqs->each(function ($boq) {
                if (!$boq->proposal) {
                    throw new \Exception("BOQ with ID {$boq->id} is not associated with any proposal.");
                }

                if (strtolower($boq->proposal->status) === 'win') {
                    throw new \Exception("Cannot unbind BOQ ID {$boq->id} because its proposal is 'Win'.");
                }

                $boq->proposal()->dissociate();
                $boq->save();
            });

            return $boqs->fresh('proposal');
        });
    }



    public function deleteBoq($id)
    {
        $boq = Boq::with('proposal')->find($id);
        if (!$boq) {
            throw new Exception("BOQ with ID {$id} not found");
        }

        // 🔒 Guard: Prevent BOQ with proposal status 'Win' from being deleted
        if ($boq->proposal && strtolower($boq->proposal->status) === 'win') {
            throw new Exception("BOQ cannot be deleted because the associated proposal has already been marked as 'Win'.");
        }

        $boq->delete();
    }

    public function deleteBoqs(array $boq_ids): int
    {
        return DB::transaction(function () use ($boq_ids) {
            $boqs = Boq::with('proposal')->whereIn('id', $boq_ids)->get();

            $foundIds = $boqs->pluck('id')->toArray();
            $missingIds = array_diff($boq_ids, $foundIds);

            if (!empty($missingIds)) {
                throw new \Exception("BOQs with IDs [" . implode(', ', $missingIds) . "] not found.");
            }

            $boqs->each(function ($boq) {
                if ($boq->proposal && strtolower($boq->proposal->status) === 'win') {
                    throw new \Exception("BOQ with ID {$boq->id} cannot be deleted because its proposal is 'Win'.");
                }

                $boq->delete();
            });

            return count($boq_ids);
        });
    }

}
