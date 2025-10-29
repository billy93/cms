<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Customer;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua customer
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            $this->command->info('No customers found, seeder skipped.');
            return;
        }

        // Generate 10 project per customer
        foreach ($customers as $customer) {
            Project::create([
                'code' => Project::generateCode(),
                'name' => 'Project for ' . $customer->name,
                'description' => 'Deskripsi untuk project ' . $customer->name,
                'customer_id' => $customer->id,
                'status' => 'Active'
            ]);
        }
    }
}
