<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class BankRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('bank_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.banks.create':
            case 'banks.create':
                return $this->createRules();
            case 'api.banks.update':
            case 'banks.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'bank_code' => ['required', 'digits:3', 'unique:banks,bank_code'],
            'bank_name' => ['required', 'string'],
            'bank_address' => ['nullable', 'string'],
            'bank_brand' => ['nullable', 'string', 'max:50'],
        ];
    }

    protected function updateRules()
    {
        $id = $this->route('bank_id');
        return [
            'id' => ['required', 'exists:banks,id'],
            'bank_code' => ['required', 'digits:3', Rule::unique('banks', 'bank_code')->ignore($id)],
            'bank_name' => ['required', 'string'],
            'bank_address' => ['nullable', 'string'],
            'bank_brand' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
