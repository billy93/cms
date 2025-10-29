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
            'type_of_sales_code' => ['required', Rule::in(['FIT', 'Non FIT'])],
            'year_of_sales' => ['nullable', 'integer', 'digits:4'],
            'destination' => ['required', Rule::in(['Indonesia', 'Overseas'])],
            'city' => ['required', 'string'],
            'activity' => [
                'required',
                Rule::in([
                    'Awarding',
                    'Conference and Seminar',
                    'Exhibitions',
                    'Gala Dinner',
                    'Gathering',
                    'Holidays',
                    'Incentive Trip',
                    'Meeting',
                    'Product Launching',
                    'Shareholders Meeting (RUPS)',
                    'Workshop',
                    'Others',
                ]),
            ],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date', 'after_or_equal:date_from'],

            'status' => [
                'nullable',
                Rule::in(['Draft', 'Submitted', 'Approved', 'Rejected', 'Cancelled']),
            ],
        ];
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:proposals,id',
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
