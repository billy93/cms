<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProjectRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('project_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.projects.create':
            case 'projects.create':
                return $this->createRules();
            case 'api.projects.update':
            case 'projects.update':
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
            'customer_id' => ['required', 'exists:customers,id'],
            'status' => [
                'nullable',
                Rule::in(['Active', 'Inactive', 'Completed', 'Cancelled']),
            ],
        ];
    }

    protected function updateRules()
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:projects,id',
        ]);
    }

    public function authorize()
    {
        return true;
    }
}
