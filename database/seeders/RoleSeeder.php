<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'Admin', 'slug'=> 'admin', 'description' => 'Administrator']);
        Role::firstOrCreate(['name' => 'User', 'slug'=> 'user', 'description' => 'Regular User']);
    }
}
