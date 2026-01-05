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
            case 'proposals.savePricingModel':
                return $this->savePricingModelRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'boq_ids' => ['nullable', 'array'],
            'boq_ids.*' => ['integer', 'exists:boqs,id'],
        ];
    }

    protected function updateRules()
    {
        $rules = array_merge($this->createRules(), [
            'id' => 'required|exists:proposals,id',
            'status' => [
                'nullable',
                Rule::in(['Draft', 'Submitted', 'Win', 'Lose', 'Cancelled']),
            ],
            'note' => ['nullable', 'string', 'required_if:status,Lose'], 
        ]);

        // Hapus validasi untuk BOQ saat update
        unset($rules['boq_ids'], $rules['boq_ids.*']);

        return $rules;
    }

    protected function savePricingModelRules()
    {
        return [
            'id' => 'required|exists:proposals,id',
            'pricing_model' => 'required|in:A,B,C',
            'management_fee_type' => 'required|in:nominal,percent',
            'management_fee' => 'required|regex:/^\d{1,3}(\.\d{3})*(,\d{1,2})?$/',
            'vat_rate' => 'required|integer|in:1,11',
            'pricing_model_description' => 'nullable|string',
            'boqs' => 'nullable|array',
            'boqs.*.boq_id' => 'required|exists:boqs,id',
            'boqs.*.header' => 'nullable|string',
            'boqs.*.subheader' => 'nullable|string',
            'boqs.*.header_order' => 'nullable|integer|min:0',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
