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

    protected function createRules(): array
    {
        $rules = [
            'project_id' => ['required', 'exists:projects,id'],
            'pricing_model' => 'required|in:A,B,C,D',
            'management_fee_type' => 'required|in:nominal,percent',
            'management_fee' => 'required|regex:/^\d{1,3}(\.\d{3})*(,\d{1,2})?$/',
            'vat_rate' => 'required|integer|in:1,11',
            'pricing_model_description' => 'required|string',
            'total_amount_items' => 'required_if:pricing_model,A|regex:/^\d{1,3}(\.\d{3})*(,\d{1,2})?$/',
            'items' => 'required_if:pricing_model,B,C,D|array|min:1',
            'status' => 'required|in:Draft,Submitted,Win,Lose,Cancelled',
            'note' => 'nullable|string|required_if:status,Lose',
        ];

        if ($this->input('pricing_model') === 'B') {
            $rules['items.*.description'] = ['required','string', Rule::in(['Adult','Child','Infant'])];
            $rules['items.*.qty'] = ['required','integer','min:0'];
            $rules['items.*.selling_price'] = ['required','regex:/^\d{1,3}(\.\d{3})*(,\d{1,2})?$/'];
        }

        // Type C & D specific
        if (in_array($this->input('pricing_model'), ['C','D'])) {
            $rules['items.*.header'] = ['required','string'];
            $rules['items.*.subheader'] = ['nullable','string'];
            $rules['items.*.product_id'] = ['nullable','exists:products,id'];
            $rules['items.*.description'] = ['nullable','string'];
            $rules['items.*.selling_price'] = ['required','regex:/^\d{1,3}(\.\d{3})*(,\d{1,2})?$/'];
            $rules['items.*.title1_key'] = ['nullable','string'];
            $rules['items.*.title1_value'] = ['nullable','integer'];
            $rules['items.*.title2_key'] = ['nullable','string'];
            $rules['items.*.title2_value'] = ['nullable','integer'];
            $rules['items.*.title3_key'] = ['nullable','string'];
            $rules['items.*.title3_value'] = ['nullable','integer'];
            $rules['items.*.title4_key'] = ['nullable','string'];
            $rules['items.*.title4_value'] = ['nullable','integer'];

            $rules['items.*'][] = function($attribute, $value, $fail) {
                $pairs = [
                    ['title1_key','title1_value'],
                    ['title2_key','title2_value'],
                    ['title3_key','title3_value'],
                    ['title4_key','title4_value'],
                ];

                $hasValidPair = false;
                foreach ($pairs as $pair) {
                    $keyFilled = !empty($value[$pair[0]]);
                    $valFilled = !empty($value[$pair[1]]);

                    if ($keyFilled xor $valFilled) {
                        $fail("Both {$pair[0]} & {$pair[1]} must be provided together.");
                        return;
                    }

                    if ($keyFilled && $valFilled) {
                        $hasValidPair = true;
                    }
                }

                if (!$hasValidPair) {
                    $fail('At least one title key & value pair must be provided.');
                }
            };
        }

        return $rules;
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:proposals,id',
        ]);
    }

    protected function savePricingModelRules()
    {
        return [
            'id' => 'required|exists:proposals,id',
            'pricing_model' => 'required|in:A,B,C,D',
            'management_fee_type' => 'required|in:nominal,percent',
            'management_fee' => 'required|regex:/^\d{1,3}(\.\d{3})*(,\d{1,2})?$/',
            'vat_rate' => 'required|integer|in:1,11',
            'pricing_model_description' => 'nullable|string',
            'items' => 'nullable|array',
            
            'items.*.header' => 'nullable|string',
            'items.*.subheader' => 'nullable|string',
            'items.*.product_id' => 'nullable|exists:products,id',
            
            'items.*.amount' => 'required|numeric',
            
            'items.*.title1_key' => 'nullable|string',
            'items.*.title1_value' => 'nullable|integer',
            'items.*.title2_key' => 'nullable|string',
            'items.*.title2_value' => 'nullable|integer',
            'items.*.title3_key' => 'nullable|string',
            'items.*.title3_value' => 'nullable|integer',
            'items.*.title4_key' => 'nullable|string',
            'items.*.title4_value' => 'nullable|integer',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
