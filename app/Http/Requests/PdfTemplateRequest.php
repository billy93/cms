<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PdfTemplateRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('template_id'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.pdf-templates.create':
            case 'pdf-templates.create':
                return $this->createRules();
            case 'api.pdf-templates.update':
            case 'pdf-templates.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules(): array
    {
        return [
            'name' => [
                'required', 'string', 'max:255', Rule::unique('pdf_templates', 'name')->ignore($this->route('template_id')),
            ],
            'type' => [
                'required', 'string', Rule::in(['proposal', 'invoice']),
            ],
            'html_content' => [
                'required', 'string',
            ],
            'variables' => [
                'nullable', 'array',
            ],
            'variables.*.name' => [
                'required', 'string', 'max:255',
            ],
            'variables.*.label' => [
                'required', 'string', 'max:255',
            ],
            'description' => [
                'nullable', 'string',
            ],
            'is_active' => [
                'nullable', 'boolean',
            ],
        ];
    }

    protected function updateRules(): array
    {
        return array_merge($this->createRules(), [
            'id' => 'required|exists:pdf_templates,id',
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
