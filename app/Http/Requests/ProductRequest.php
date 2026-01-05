<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProductRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('product_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.products.create':
            case 'products.create':
                return $this->createRules();
            case 'api.products.update':
            case 'products.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'unit' => ['required', 'string', 'max:32'],
            'price' => [
                'required',
                'regex:/^\d{1,3}(\.\d{3})*(,\d{1,2})?$/',
            ],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:product_categories,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
        ];
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:products,id',
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
