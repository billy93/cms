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
            'project_id' => ['required_without:proposal_id', 'nullable', 'exists:projects,id'],
            'proposal_id' => ['required_without:project_id', 'nullable', 'exists:proposals,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'billing_option_id' => ['required', 'exists:billing_options,id'],
            'pcmi_bank_id' => ['required', 'exists:pcmi_banks,id'],
            'item_ids' => [
                Rule::requiredIf(fn() => $this->proposal_id && $this->billing_type === 'Partly Payment'),
                'array'
            ],
            'item_ids.*' => ['integer', 'exists:sales_items,id'],
            'invoice_number' => ['required', 'string'], // User Input
            'due_date' => ['required', 'date'],
            'description' => ['required_without:proposal_id', 'nullable', 'string'],
            'billing_type' => ['required', Rule::in(['Full Amount','Partly Payment'])],
            'tax_type' => ['required', Rule::in(['No Tax', 'Tax - Non WAPU', 'Tax - WAPU'])],
            'total_amount' => ['required_without:proposal_id', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['VOID','REVISED','PREPARED','SENT'])],
            'payment_status' => [
                'required', 
                function ($attribute, $value, $fail) {
                    $billingType = request()->input('billing_type');
                    if ($billingType === 'Full Amount' && !in_array($value, ['UNPAID', 'FULLY PAID'])) {
                        $fail("The payment status must be UNPAID or FULLY PAID for Full Amount invoices.");
                    }
                    if ($billingType === 'Partly Payment' && !in_array($value, ['UNPAID', 'PARTLY PAID'])) {
                        $fail("The payment status must be UNPAID or PARTLY PAID for Partly Payment invoices.");
                    }
                },
                Rule::in(['UNPAID', 'PARTLY PAID', 'FULLY PAID'])
            ],
            'management_fee_type' => ['required_without:proposal_id', Rule::in(['nominal', 'percent'])],
            'management_fee' => ['required_without:proposal_id', 'numeric', 'min:0'],
            'vat_rate' => ['required_without:proposal_id', 'integer', Rule::in([1, 11])],
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
