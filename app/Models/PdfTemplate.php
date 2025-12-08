<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'html_content',
        'variables',
        'description',
        'is_active',
    ];

    protected $casts = [
        'variables' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to filter by template type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get only active templates
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Render template with provided data
     * Replaces {{variable_name}} with actual values
     */
    public function render(array $data): string
    {
        $html = $this->html_content;
        
        foreach ($data as $key => $value) {
            $html = str_replace('{{' . $key . '}}', $value, $html);
        }
        
        return $html;
    }

    /**
     * Get available variable names from the template
     */
    public function getVariableNames(): array
    {
        if (!$this->variables) {
            return [];
        }
        
        return array_column($this->variables, 'name');
    }
}
