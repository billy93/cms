<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class BoqRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('boq_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.boqs.create':
            case 'boqs.create':
                return $this->createRules();
            case 'api.boqs.update':
            case 'boqs.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        $rules = [  
            'project_id' => 'nullable|exists:projects,id',
            'proposal_id' => 'nullable|exists:proposals,id',
            'form_type' => ['required', Rule::in(['type-a','type-b','type-c','type-d'])],
            'description' => 'required|string',
            'total_amount_items' => ['required_if:form_type,type-a','numeric','min:0'],
            'management_fee' => 'nullable|numeric|min:0',
            'management_fee_type' => ['nullable', Rule::in(['percent','nominal'])],
            'vat_rate' => ['required', Rule::in([1, 11])],
        ];

        // Items required for type B, C, D
        $rules['items'] = ['required_if:form_type,type-b,type-c,type-d','array','min:1'];
        
        // Type B specific
        $rules['items.*.subheader'] = ['required_if:form_type,type-b','string', Rule::in(['Adult','Child','Infant'])];
        $rules['items.*.qty'] = ['required_if:form_type,type-b','integer','min:0'];
        $rules['items.*.amount'] = ['required_if:form_type,type-b','numeric','min:0'];

        return $rules;
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:boqs,id',
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
