<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Menu;

class AdminMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil role admin
        $adminRole = Role::where('slug', 'admin')->first();

        if (!$adminRole) {
            $this->command->error("Role 'admin' belum ada. Jalankan RoleSeeder dulu.");
            return;
        }

        // Ambil semua menu
        $allMenus = Menu::all();

        if ($allMenus->isEmpty()) {
            $this->command->warn("Tidak ada menu untuk di-assign.");
            return;
        }

        // Assign semua menu ke admin
        $adminRole->menus()->sync($allMenus->pluck('id')->toArray());

        $this->command->info("Semua menu telah di-assign ke role Admin.");
    }
}
