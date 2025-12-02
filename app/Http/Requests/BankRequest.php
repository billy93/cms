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
            'bank_code' => ['required', 'string', 'max:10'],
            'bank_name' => ['required', 'string'],
            'bank_address' => ['nullable', 'string'],
        ];
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:banks,id',
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
