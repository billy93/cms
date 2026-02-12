<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class BillingOptionRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('billing_option_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'billing-options.create':
                return $this->createRules();
            case 'billing-options.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'cp_name' => ['nullable', 'string', 'max:255'],
            'cp_title_division' => ['nullable', 'string', 'max:255'],
            'cp_email' => ['nullable', 'email', 'max:255'],
            'cp_office_number' => ['nullable', 'string', 'max:30'],
            'cp_mobile_number' => ['nullable', 'string', 'max:30'],
            'is_overseas' => ['nullable', 'boolean'],
            'address' => ['nullable', 'string'],
        ];
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => ['required', 'exists:billing_options,id'],
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
