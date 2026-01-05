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

                if ($proposal && strtolower($proposal->status) === 'win') {
                   throw new Exception("Cannot associate a BOQ with a proposal that has been marked as 'Win'.");
                }

                $boq->proposal()->associate($proposal);
                $boq->save();
            }

            $totalAmountItems = 0;

            foreach ($items as $itemData) {
                if (empty($itemData['product_id'])) {
                    throw new Exception("Product selection is required for each BOQ item.");
                }

                $product = Product::with('categories')->find($itemData['product_id']);
                if (!$product) {
                    throw new Exception("Product with ID {$itemData['product_id']} not found.");
                }

                $itemData['description'] = $product->description;
                $itemData['category_name'] = $product->categories->first()?->name ?? 'Uncategorized';
                $itemData['unit_price'] = (float) str_replace(['.', ','], ['', '.'], $product->getRawOriginal('base_cost'));

                $qty = $itemData['qty'] ?? 1;
                $freq = $itemData['freq'] ?? 1;
                $multiplier = $qty * $freq * $itemData['unit_price'];

                $itemData['multiplier_total'] = $multiplier;

                $boq->items()->create($itemData);

                $totalAmountItems += $multiplier;
            }

            $boq->update([
                'total_amount_items' => $totalAmountItems,
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

            $boq->save();
            $boq->update($data);
            $boq->items()->delete();

            $totalAmountItems = 0;

            foreach ($items as $itemData) {
                if (empty($itemData['product_id'])) {
                    throw new Exception("Product selection is required for each BOQ item.");
                }

                $product = Product::with('categories')->find($itemData['product_id']);
                if (!$product) {
                    throw new Exception("Product with ID {$itemData['product_id']} not found.");
                }

                $itemData['description'] = $product->description;
                $itemData['category_name'] = $product->categories->first()?->name ?? 'Uncategorized';
                $itemData['unit_price'] = (float) str_replace(['.', ','], ['', '.'], $product->getRawOriginal('base_cost'));

                $qty = $itemData['qty'] ?? 1;
                $freq = $itemData['freq'] ?? 1;
                $multiplier = $qty * $freq * $itemData['unit_price'];

                $itemData['multiplier_total'] = $multiplier;
                $boq->items()->create($itemData);
                $totalAmountItems += $itemData['multiplier_total'];
            }

            $boq->update([
                'total_amount_items' => $totalAmountItems,
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
