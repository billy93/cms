<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'code' => Customer::generateCode(),
                'name' => 'PT Maju Bersama',
                'status' => 'active',
                'notes' => 'Customer utama untuk proyek IT infrastructure'
            ],
            [
                'code' => Customer::generateCode(),
                'name' => 'CV Sukses Mandiri',
                'status' => 'active',
                'notes' => 'Konsultan manajemen dan training'
            ],
            [
                'code' => Customer::generateCode(),
                'name' => 'PT Global Teknologi',
                'status' => 'active',
                'notes' => 'Perusahaan teknologi informasi'
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
} 