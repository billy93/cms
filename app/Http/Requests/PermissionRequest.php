<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PermissionRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('permission_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        return match ($action) {
            'permissions.create', 'api.permissions.create' => $this->createRules(),
            'permissions.update', 'api.permissions.update' => $this->updateRules(),
            default => [],
        };
    }

    protected function createRules(): array
    {
        return [
            'route' => ['required', 'string', 'max:150', 'unique:permissions,route'],
            'method' => ['nullable', 'string', 'max:10'],
            'path' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function updateRules(): array
    {
        return [
            'id' => ['required', 'exists:permissions,id'],
            'route' => [
                'required', 'string', 'max:150',
                Rule::unique('permissions', 'route')->ignore($this->route("permission_id")),
            ],
            'method' => ['nullable', 'string', 'max:10'],
            'path' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
