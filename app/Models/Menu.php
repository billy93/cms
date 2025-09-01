<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'path',
        'icon',
        'parent_id',
        'sort',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort' => 'integer'
    ];

    // Parent relationship
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Children relationship
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort');
    }

    // Get all children recursively
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // Scope for active menus
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for parent menus (no parent_id)
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Check if menu has children
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    // Get menu hierarchy
    public static function getHierarchy()
    {
        return self::with('allChildren')
            ->parents()
            ->active()
            ->orderBy('sort')
            ->get();
    }

    // Relationship with roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_roles', 'menu_id', 'role_id');
    }
}