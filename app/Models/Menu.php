<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'icon',
        // 'route_name',
        'permission_id',
        'order_index',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'order_index' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order_index');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_menu', 'menu_id', 'role_id')
                    ->withTimestamps();
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
