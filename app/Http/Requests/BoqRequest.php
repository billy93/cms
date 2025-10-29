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
            'form_type' => ['required', Rule::in(['A','B','C','D'])],
            'description' => 'required|string',
            'total_amount_items' => ['required_if:form_type,A','numeric','min:0'],
            'management_fee' => 'nullable|numeric|min:0',
            'management_fee_type' => ['nullable', Rule::in(['percent','nominal'])],
            'vat_rate' => ['required', Rule::in([1, 11])],
            'items' => ['required_if:form_type,B,C,D','array','min:1']
        ];
        
        // Type B specific
        if ($this->input('form_type') === 'B') {
            $rules['items.*.subheader'] = ['required','string', Rule::in(['Adult','Child','Infant'])];
            $rules['items.*.qty'] = ['required','integer','min:0'];
            $rules['items.*.amount'] = ['required','numeric','min:0'];
        }

        // Type C & D specific
        if (in_array($this->input('form_type'), ['C','D'])) {
            $rules['items.*.header'] = ['required','string'];
            $rules['items.*.subheader'] = ['nullable','string'];
            $rules['items.*.product_id'] = ['nullable','exists:products,id'];
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
            'id' => 'required|exists:boqs,id',
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
