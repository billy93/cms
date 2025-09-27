<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // === Dashboard Group ===
        $dashboard = Menu::create([
            'label' => 'Dashboard',
            'path'  => '#',
            'icon'  => 'ti ti-layout-2',
            'sort'  => 1,
            'is_active' => true,
        ]);

        Menu::create([
            'label' => 'Project Dashboard',
            'path'  => '/project-dashboard',
            'icon'  => null,
            'sort'  => 1,
            'is_active' => true,
            'parent_id' => $dashboard->id,
        ]);

        // === Products Group ===
        $products = Menu::create([
            'label' => 'Products',
            'path'  => '#',
            'icon'  => 'ti ti-package',
            'sort'  => 2,
            'is_active' => true,
        ]);

        Menu::create([
            'label' => 'Categories',
            'path'  => '/categories',
            'icon'  => 'ti ti-category',
            'sort'  => 1,
            'is_active' => true,
            'parent_id' => $products->id,
        ]);

        Menu::create([
            'label' => 'Products',
            'path'  => '/products',
            'icon'  => 'ti ti-package',
            'sort'  => 2,
            'is_active' => true,
            'parent_id' => $products->id,
        ]);

        // === MAIN Group ===
        $main = Menu::create([
            'label' => 'MAIN',
            'path'  => '#',
            'icon'  => null,
            'sort'  => 3,
            'is_active' => true,
        ]);

        $mainItems = [
            ['Bank Accounts', '/contacts', 'ti ti-user-up'],
            ['Clients', '/companies', 'ti ti-building-community'],
            ['Customers', '/customers', 'ti ti-users'],
            ['Suppliers', '/suppliers', 'ti ti-truck'],
            ['Projects', '/projects', 'ti ti-atom-2'],
            ['Proposals', '/proposals', 'ti ti-file-star'],
            ['Invoices', '/invoices', 'ti ti-file-invoice'],
            ['BoQ', '/boqs', 'ti ti-file-invoice'],
            ['Payments', '/payments', 'ti ti-report-money'],
        ];

        foreach ($mainItems as $i => [$label, $path, $icon]) {
            Menu::create([
                'label' => $label,
                'path'  => $path,
                'icon'  => $icon,
                'sort'  => $i + 1,
                'is_active' => true,
                'parent_id' => $main->id,
            ]);
        }

        // === User Management Group ===
        $userMgmt = Menu::create([
            'label' => 'User Management',
            'path'  => '#',
            'icon'  => null,
            'sort'  => 4,
            'is_active' => true,
        ]);

        $userMgmtItems = [
            ['Manage Users', '/manage-users', 'ti ti-users'],
            ['Roles & Permissions', '/roles-permissions', 'ti ti-navigation-cog'],
            ['Menu Management', '/manage-menus', 'ti ti-menu-2'],
            ['Permissions', '/permissions', 'ti ti-lock-cog'],
            ['Delete Request', '/delete-request', 'ti ti-flag-question'],
        ];

        foreach ($userMgmtItems as $i => [$label, $path, $icon]) {
            Menu::create([
                'label' => $label,
                'path'  => $path,
                'icon'  => $icon,
                'sort'  => $i + 1,
                'is_active' => true,
                'parent_id' => $userMgmt->id,
            ]);
        }

        // === Assign to Admin role ===
        $admin = Role::where('slug', 'admin')->first();
        if ($admin) {
            $menuIds = Menu::pluck('id');
            $admin->menus()->sync($menuIds);
        }
    }
}
