<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CustomerRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('customer_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.customers.create':
            case 'customers.create':
                return $this->createRules();
            case 'api.customers.update':
            case 'customers.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_number' => ['nullable', 'string', 'max:50'],
            'bank_account_name' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['Active', 'Inactive'])],
            'notes' => ['nullable', 'string'],
        ];
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => ['required', 'exists:customers,id'],
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
