<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Role extends Model
// {
//     use HasFactory;

//     protected $fillable = ['name', 'description'];



//     public function users()
//     {
//         return $this->hasMany(User::class);
//     }
// }

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_roles', 'role_id', 'menu_id');
    }

       public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}