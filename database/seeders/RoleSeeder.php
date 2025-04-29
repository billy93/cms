<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin', 'description' => 'Administrator']);
        Role::firstOrCreate(['name' => 'user', 'description' => 'Regular User']);
    }
}
