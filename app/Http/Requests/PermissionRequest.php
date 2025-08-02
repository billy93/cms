<?php

namespace App\Http\Requests;

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

    switch ($action) {
      case 'api.permissions.create':
      case 'permissions.create':
        return $this->createRules();
      case 'api.permissions.update':
      case 'permissions.update':
        return $this->updateRules();
      default:
        return [];
    }
  }

  protected function createRules(): array
  {
    return [
      'module' => 'required|string|max:255|unique:permissions,module',
      'description' => 'nullable|string|max:255',
      'role_ids' => 'sometimes|array',
      'role_ids.*' => 'integer|exists:roles,id',
   ];
  }

  protected function updateRules(): array
  {
    return [
      'id' => 'required|exists:permissions,id',
      'module' => 'required|string|max:255|unique:permissions,module,' . $this->route('permission_id'),
      'description' => 'nullable|string|max:255',
      'role_ids' => 'sometimes|array',
      'role_ids.*' => 'integer|exists:roles,id',
    ];
  }

  public function messages()
  {
    return [
      'id.required' => 'The permission ID is required.',
      'id.exists' => 'The specified permission does not exist.',

      'module.required' => 'The module field is required.',
      'module.string' => 'The module must be a string.',
      'module.max' => 'The module may not be greater than :max characters.',
      'module.unique' => 'The module has already been taken.',
      
      'description.string' => 'The description must be a string.',
      'description.max' => 'The description may not be greater than :max characters.',

      'role_ids.array' => 'The role_ids field must be an array.',
      'role_ids.*.integer' => 'Each role ID must be an integer.',
      'role_ids.*.exists' => 'One or more selected roles do not exist.',    
    ];
  }

  public function authorize()
  {
    return true;
  }
}
