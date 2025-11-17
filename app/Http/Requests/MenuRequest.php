<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class MenuRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('menu_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        return match ($action) {
            'menus.create', 'api.menus.create' => $this->createRules(),
            'menus.update', 'api.menus.update' => $this->updateRules(),
            default => [],
        };
    }

    protected function createRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            // 'route_name' => ['nullable', 'string', 'max:150'],
            'parent_id' => ['nullable', 'integer', 'exists:menus,id'],
            'permission_id' => ['nullable', 'integer', 'exists:permissions,id'],
            'order_index' => ['required', 'integer'],
            'is_visible' => ['required', 'boolean'],
        ];
    }

    protected function updateRules(): array
    {
        return [
            'id' => ['required', 'exists:menus,id'],
            'name' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            // 'route_name' => ['nullable', 'string', 'max:150'],
            'parent_id' => ['nullable', 'integer', 'exists:menus,id'],
            'permission_id' => ['nullable', 'integer', 'exists:permissions,id'],
            'order_index' => ['required', 'integer'],
            'is_visible' => ['required', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
