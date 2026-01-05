<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class BoqRequest extends ApiFormRequest
{
    public function validationData()
    {
        $data = $this->all();

        // Inject ID hanya jika route punya param `boq_id`
        if ($this->route('boq_id')) {
            $data['id'] = $this->route('boq_id');
        }

        $proposalFromRoute = $this->route('proposal_id');

        // Normalisasi nilai "null" jadi null
        if ($proposalFromRoute === 'null' || $proposalFromRoute === '') {
            $proposalFromRoute = null;
        }

        // inject hanya jika route punya param dan body gak punya
        if (!is_null($proposalFromRoute) && !$this->has('proposal_id')) {
            $data['proposal_id'] = $proposalFromRoute;
        }

        // Khusus bulk delete: ambil dari query params
        if ($this->routeIs('boqs.bulkDelete') || $this->routeIs('api.boqs.bulkDelete')) {
            $boqIds = $this->query('boq_ids', []);

            // Jika berupa string "1,2,3", ubah jadi array
            if (is_string($boqIds)) {
                $boqIds = array_filter(explode(',', $boqIds), fn($v) => $v !== '');
            }

            $data['boq_ids'] = $boqIds;
        }

        return $data;
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
            case 'api.boqs.replicate':
            case 'boqs.replicate':
                return $this->replicateRules();
            case 'api.boqs.unbindProposal':
            case 'boqs.unbindProposal':
                return $this->unbindProposalRules();
            case 'api.boqs.bulkDelete':
            case 'boqs.bulkDelete':
                return $this->bulkDeleteRules();
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

    protected function replicateRules()
    {
        return [
        'proposal_id' => 'nullable|integer|exists:proposals,id',
        'boq_ids' => 'required|array|min:1',
        'boq_ids.*' => 'exists:boqs,id',
        ];
    }

    protected function unbindProposalRules()
    {
        // Cek apakah ini single unbind (via route param)
        if (!empty($this->route('boq_id'))) {
            return [
                'id' => ["exists:boqs,id"],
                // Kalau single unbind, larang kirim array `boq_ids` di body
                'boq_ids' => ['prohibited'],
            ];
        }

        // Kalau bulk unbind (tanpa route param)
        return [
            'boq_ids' => ['required', 'array', 'min:1'],
            'boq_ids.*' => ['integer', 'exists:boqs,id'],
        ];
    }


    protected function bulkDeleteRules()
    {
        return [
            'boq_ids' => ['required', 'array', 'min:1'],
            'boq_ids.*' => ['integer', 'exists:boqs,id'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
