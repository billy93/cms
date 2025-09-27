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
            for ($i = 1; $i <= 3; $i++) {
                Project::create([
                    'project_code' => 'PRJ-' . $customer->id . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'name' => 'Project ' . $i . ' for ' . $customer->name,
                    'description' => 'Deskripsi untuk project ' . $i,
                    'customer_id' => $customer->id,
                    'status' => 'active'
                ]);
            }
        }
    }
}
