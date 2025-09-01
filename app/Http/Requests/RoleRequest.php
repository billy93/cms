<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

    switch ($action) {
      case 'api.roles.create':
      case 'roles.create':
        return $this->createRules(); 
      case 'api.roles.update':
      case 'roles.update':
        return $this->updateRules(); 
      default:
        return [];
    }
  }

  protected function createRules()
  {
    return [
      'name' => 'required|string|max:255|unique:roles,name', 
      'description' => 'nullable|string|max:255',
    ];
  }

  protected function updateRules()
  {
    return [
      'id' => 'required|exists:roles,id',
      'name' => 'required|string|max:255|unique:roles,name,' . $this->route('role_id'),
      'description' => 'nullable|string|max:255',
    ];
  }

  public function messages()
  {
    return [
      'id.required' => 'The role ID is required.',
      'id.exists' => 'The specified role does not exist.',
      
      'name.required' => 'The name field is required.',
      'name.string' => 'The name must be a string.',
      'name.max' => 'The name may not be greater than :max characters.',
      'name.unique' => 'The name has already been taken.',



      'description.string' => 'The description must be a string.',
      'description.max' => 'The description may not be greater than :max characters.',
      
    
    ];
  }

  public function authorize()
  {
    return true;
  }
}
