<?php

namespace App\Http\Requests;

class UserRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('user_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.users.create':
                return $this->createRules();
            case 'api.users.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'name' => 'required|string|max:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,suspended',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }

    protected function updateRules()
    {
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->route('user_id'),
            'password' => 'sometimes|string|min:6',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,suspended',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The user ID is required.',
            'id.exists' => 'The specified user does not exist.',

            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'The email has already been taken.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 6 characters.',

            'phone.string' => 'The phone must be a string.',
            'phone.max' => 'The phone may not be greater than 20 characters.',

            'location.string' => 'The location must be a string.',
            'location.max' => 'The location may not be greater than 255 characters.',

            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be one of: active, inactive, suspended.',

            'role_id.exists' => 'The selected role does not exist.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
