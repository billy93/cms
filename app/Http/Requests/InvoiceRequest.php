<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class InvoiceRequest extends ApiFormRequest
{
    public function validationData()
    {
        $data = $this->all();

        if ($this->route('invoice_id')) {
            $data['id'] = $this->route('invoice_id');
        }

        return $data;
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.invoices.create':
            case 'invoices.create':
                return $this->createRules();
            case 'api.invoices.update':
            case 'invoices.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'proposal_id' => ['required', 'exists:proposals,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'item_ids' => ['required_if:type,Partial', 'array'],
            'item_ids.*' => ['integer', 'exists:proposal_items,id'],
            'invoice_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:invoice_date'],
            'status' => ['required', Rule::in(['Unpaid','Paid','Cancelled'])],
            'type' => ['required', Rule::in(['Full','Partial'])],
            'payment_method' => ['nullable', 'string'],
            'bill_to' => ['nullable', 'string'],
            'ship_to' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
        ];
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:invoices,id',
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
