<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user'); 
        });

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@crms.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ])->assignRole('admin');  
    }
}
