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
        return $this->createRules();
      case 'api.permissions.update':
        return $this->updateRules();
      default:
        return [];
    }
  }

  protected function createRules(): array
  {
    return [
      'name' => 'required|string|max:255|unique:permissions,name',
      'description' => 'nullable|string|max:255',
      'role_ids' => 'sometimes|array',
      'role_ids.*' => 'integer|exists:roles,id',
   ];
  }

  protected function updateRules(): array
  {
    return [
      'id' => 'required|exists:permissions,id',
      'name' => 'required|string|max:255|unique:permissions,name,' . $this->route('permission_id'),
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

      'name.required' => 'The name field is required.',
      'name.string' => 'The name must be a string.',
      'name.max' => 'The name may not be greater than 255 characters.',
      'name.unique' => 'The name has already been taken.',
      
      'description.string' => 'The description must be a string.',
      'description.max' => 'The description may not be greater than 255 characters.',

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
