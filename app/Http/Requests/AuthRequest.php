<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends ApiFormRequest
{

  public function rules()
  {
    $action = $this->route()->getName(); 

    switch ($action) {
      case 'api.auth.signin':
        return $this->signinRules(); 
      default:
        return [];
    }
  }

  protected function signinRules()
  {
    return [
      'email' => 'required|email',
      'password' => 'required|string',
    ];
  }

  public function authorize()
  {
    return true;
  }
}
