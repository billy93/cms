<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProductCategoryRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('category_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.categories.create':
            case 'categories.create':
                return $this->createRules();
            case 'api.categories.update':
            case 'categories.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:product_categories,name'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    protected function updateRules()
    {
        return [
            'id' => ['required', 'exists:product_categories,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_categories', 'name')->ignore($this->id),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
