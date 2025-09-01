<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $menuId = $this->route('menu') ? $this->route('menu')->id : null;

        $rules = [
            'label' => 'required|string|max:255',
            'path' => [
                'required',
                'string',
                'max:255',
                Rule::unique('menus', 'path')->ignore($menuId)
            ],
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ];

        // Additional validation for parent_id to prevent circular reference
        if ($menuId) {
            $rules['parent_id'][] = function ($attribute, $value, $fail) use ($menuId) {
                if ($value == $menuId) {
                    $fail('A menu cannot be its own parent.');
                }
                
                // Check if the selected parent is a child of current menu
                if ($value && $this->isChildOf($menuId, $value)) {
                    $fail('Cannot set a child menu as parent (circular reference).');
                }
            };
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'label.required' => 'Menu label is required.',
            'label.max' => 'Menu label cannot exceed 255 characters.',
            'path.required' => 'Menu path is required.',
            'path.unique' => 'This menu path already exists.',
            'path.max' => 'Menu path cannot exceed 255 characters.',
            'icon.max' => 'Icon name cannot exceed 255 characters.',
            'parent_id.exists' => 'Selected parent menu does not exist.',
            'sort.integer' => 'Sort order must be a number.',
            'sort.min' => 'Sort order must be at least 0.',
            'is_active.boolean' => 'Active status must be true or false.'
        ];
    }

    private function isChildOf(int $parentId, int $childId): bool
    {
        $menu = \App\Models\Menu::find($childId);
        
        while ($menu && $menu->parent_id) {
            if ($menu->parent_id == $parentId) {
                return true;
            }
            $menu = $menu->parent;
        }
        
        return false;
    }
}