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
            'proposal_id' => [
                'nullable',
                'exists:proposals,id',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $proposal = \App\Models\Proposal::find($value);
                        if ($proposal && strtolower($proposal->status) !== 'win') {
                            $fail("The selected proposal must have a 'Win' status.");
                        }
                    }
                }
            ],
            'items' => ['required','array','min:1']
        ];
        
        // All types now use the same structure: product_id, qty, freq
        $rules['items.*.product_id'] = ['required', 'exists:products,id'];
        $rules['items.*.description'] = ['nullable', 'string', 'max:255'];
        $rules['items.*.qty'] = ['required', 'integer', 'min:1'];
        $rules['items.*.freq'] = ['required', 'integer', 'min:1'];
        $rules['items.*.freq_unit'] = ['required', 'string'];
        $rules['items.*.selling_price'] = ['required', 'string'];

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
        'proposal_id' => [
            'nullable',
            'integer',
            'exists:proposals,id',
            function ($attribute, $value, $fail) {
                if ($value) {
                    $proposal = \App\Models\Proposal::find($value);
                    if ($proposal && strtolower($proposal->status) !== 'win') {
                        $fail("The selected proposal must have a 'Win' status.");
                    }
                }
            }
        ],
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
