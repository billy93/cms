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
            'manage-users' => 'User Management',
            'deals' => 'Deals',
            'deal-reports' => 'Deal Reports',
            'deals-details' => 'Deal Details',
            'deals-kanban' => 'Deals Kanban',
        ];
        
        foreach ($permissions as $key => $value) {
            Permission::firstOrCreate(
                ['module' => $key],
                ['description' => $value]
            );
        }

        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        if ($adminRole) {
            $adminRole->permissions()->sync(Permission::all()->pluck('id')); 
        }

        if ($userRole) {
            $userRole->permissions()->sync([
                Permission::where('module', 'manage-users')->first()->id,
            ]);
        }
    }
}