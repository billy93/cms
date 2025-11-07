<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProposalRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('proposal_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.proposals.create':
            case 'proposals.create':
                return $this->createRules();
            case 'api.proposals.update':
            case 'proposals.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'status' => [
                'nullable',
                Rule::in(['Draft', 'Submitted', 'Win', 'Lose', 'Cancelled']),
            ],
            'boq_ids' => ['nullable', 'array'],
            'boq_ids.*' => ['integer', 'exists:boqs,id'],
        ];
    }

    protected function updateRules()
    {
        $rules = array_merge($this->createRules(), [
            'id' => 'required|exists:proposals,id',
        ]);

        // Hapus validasi untuk BOQ saat update
        unset($rules['boq_ids'], $rules['boq_ids.*']);

        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}
