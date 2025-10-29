<?php

namespace App\Http\Services;

use App\Models\Proposal;
use Illuminate\Support\Facades\DB;
use Exception;

class ProposalService
{
    public function createProposal(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['code'] = Proposal::generateCode();
            $proposal = Proposal::create($data);
            return $proposal->fresh(['project']);
        });
    }

    public function getAllProposals()
    {
        return Proposal::with('project')->get();
    }

    public function getProposalById($id)
    {
        $proposal = Proposal::with('project')->find($id);
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

            $proposal->update($data);
            return $proposal->fresh(['project']);
        });
    }

    public function deleteProposal($id)
    {
        $proposal = Proposal::find($id);
        if (!$proposal) {
            throw new Exception("Proposal with ID {$id} not found");
        }
        $proposal->delete();
    }
}
