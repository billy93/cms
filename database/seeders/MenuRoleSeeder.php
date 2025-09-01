<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all menus and roles
        $menus = DB::table('menus')->get();
        $roles = DB::table('roles')->get();
        
        // Sample data: Assign some menus to roles
        $menuRoles = [];
        
        foreach ($roles as $role) {
            // Admin role gets all menus
            if (strtolower($role->name) === 'admin') {
                foreach ($menus as $menu) {
                    $menuRoles[] = [
                        'menu_id' => $menu->id,
                        'role_id' => $role->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            } else {
                // Other roles get limited menus (first 3 menus as example)
                $limitedMenus = $menus->take(3);
                foreach ($limitedMenus as $menu) {
                    $menuRoles[] = [
                        'menu_id' => $menu->id,
                        'role_id' => $role->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }
        
        // Insert menu roles if not empty
        if (!empty($menuRoles)) {
            DB::table('menu_roles')->insert($menuRoles);
        }
    }
}
