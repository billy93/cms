<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RoleRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('role_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        return match ($action) {
            'roles.create', 'api.roles.create' => $this->createRules(),
            'roles.update', 'api.roles.update' => $this->updateRules(),
            default => [],
        };
    }

    protected function createRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', 'unique:roles,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'permission_ids' => ['nullable', 'array'],
            'permission_ids.*' => ['exists:permissions,id'],
            'menu_ids' => ['nullable', 'array'],
            'menu_ids.*' => ['exists:menus,id'],
        ];
    }

    protected function updateRules(): array
    {
        $rules = array_merge($this->createRules(), [
            'id' => ['required', 'exists:roles,id'],
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('roles', 'name')->ignore($this->role_id),
            ],
        ]);

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
