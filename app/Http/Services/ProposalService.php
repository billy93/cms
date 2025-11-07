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
            $boq_ids = $data['boq_ids'];
            \Log::info($boq_ids);
            unset($data['boq_ids']);

            $data['code'] = Proposal::generateCode();
            $proposal = Proposal::create($data);

            $foundBoqs = Boq::whereIn('id', $boq_ids)->get();
            $newBoqs = collect();

            foreach ($foundBoqs as $boq) {
                $newBoqs->push($boq->replicateWithItems($proposal->id));
            } 

            return $proposal->fresh(['project']);
        });
    }

    public function getAllProposals()
    {
        return Proposal::with('project')->get();
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
}
