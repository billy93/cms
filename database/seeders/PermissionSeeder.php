<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage-users',
            'deals',
            'deal-reports',
            'deals-details',
            'deals-kanban',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'description' => ucfirst(str_replace('-', ' ', $permission))]);
        }

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        if ($adminRole) {
            $adminRole->permissions()->sync(Permission::all()->pluck('id')); 
        }

        if ($userRole) {
            $userRole->permissions()->sync([
                Permission::where('name', 'manage-users')->first()->id,
            ]);
        }
    }
}