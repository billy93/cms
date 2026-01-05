<?php

namespace App\Http\Services;

use App\Models\Proposal;
use App\Models\Boq;
use Illuminate\Support\Facades\DB;
use Exception;

class ProposalService
{
    public function createProposal(array $data)
    {
        return DB::transaction(function () use ($data) {
            $boq_ids = null;
            if (array_key_exists('boq_ids', $data)) {
                $boq_ids = $data['boq_ids'];
                unset($data['boq_ids']);
            }

            $data['code'] = Proposal::generateCode();
            $data['status'] = "Draft";
            $proposal = Proposal::create($data);

            if (is_array($boq_ids)) {
                $foundBoqs = Boq::whereIn('id', $boq_ids)->get();
                foreach ($foundBoqs as $boq) {
                    $boq->replicateWithItems($proposal->id);
                }
            }

            return $proposal->fresh(['project']);
        });
    }

    public function getAllProposals()
    {
        return Proposal::with('project', 'invoices')->get();
    }

    public function getProposalById($id)
    {
        $proposal = Proposal::with(['project.customer', 'boqs', 'invoices.boqs'] )->find($id);
        if (!$proposal) {
            throw new Exception("Proposal with ID {$id} not found");
        }
        return $proposal;
    }

    public function updateProposal($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $proposal = Proposal::find($id);
            if (!$proposal) {
                throw new Exception("Proposal with ID {$id} not found");
            }

            // 🔒 Guard: Prevent proposal with status 'Win' from being updated
            if (strtolower($proposal->status) === 'win') {
                throw new Exception("Proposal with status 'Win' cannot be modified.");
            }

            $targetStatus = strtolower($data['status'] ?? '');
            if (in_array($targetStatus, ['submitted', 'win', 'lose'], true) && $proposal->boqs->isEmpty()) {
                throw new Exception("Cannot change status to '{$data['status']}' because this proposal has no BOQs.");
            }
            
            $proposal->update($data);

            if (($data['status'] ?? null) === 'Win') {
                $proposal->update([
                    'sales_code' => Proposal::generateSalesCode(
                        $proposal->project_id,
                        $proposal->id 
                    ),
                ]);
            }

            return $proposal->fresh(['project']);
        });
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

    // public function getBoqsByProposalId($id)
    // {
    //     $proposal = Proposal::find($id);
    //     if (!$proposal) {
    //         throw new Exception("Proposal with ID {$id} not found");
    //     }

    //     return Boq::with('items')
    //         ->where('proposal_id', $id)
    //         ->orderBy('header_order', 'asc')
    //         ->orderBy('id', 'asc')
    //         ->get();
    // }

    public function savePricingModel(array $data)
    {
        return DB::transaction(function () use ($data) {
            $id = $data['id'];
            $proposal = Proposal::find($id);
            
            // 🔒 Guard: Prevent proposal with status 'Win' from being updated
            if (strtolower($proposal->status) === 'win') {
                throw new Exception("Proposal with status 'Win' cannot be modified.");
            }
            
            // Normalize management fee
            $data['management_fee'] = $this->normalizePrice($data['management_fee']);
            
            // Extract BOQ data before updating proposal
            $boqData = $data['boqs'] ?? [];
            unset($data['boqs'], $data['id']);
            
            // Update proposal
            $proposal->update($data);

            // Handle BOQ updates
            if ($data['pricing_model'] === 'A') {
                // Type A: Clear all headers/subheaders
                $proposal->boqs()->update(['header' => null, 'subheader' => null, 'header_order' => 0]);
            } elseif ($data['pricing_model'] === 'B' && !empty($boqData)) {
                // Type B: Update each BOQ with provided data
                foreach ($boqData as $boq) {
                    Boq::where('id', $boq['boq_id'])
                        ->update([
                            'header' => $boq['header'] ?? null,
                            'subheader' => $boq['subheader'] ?? null,
                            'header_order' => $boq['header_order'] ?? 0,
                        ]);
                }
            }

            return $proposal->fresh();
        });
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
