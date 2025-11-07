<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Customer;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            $this->command->info('No customers found, seeder skipped.');
            return;
        }

        foreach ($customers as $customer) {
            $start = Carbon::now()->subDays(rand(0, 90));
            $end   = (clone $start)->addDays(rand(30, 90));
            $due   = (clone $end)->addDays(rand(5, 30));

            Project::create([
                'code'         => Project::generateCode(),
                'name'         => "Project for {$customer->name}",
                'ref_doc_no'   => 'REF-' . strtoupper(str()->random(6)),
                'value'        => number_format(rand(1_000_000, 100_000_000), 2, ',', '.'), // otomatis diolah oleh mutator
                'start_date'   => $start,
                'end_date'     => $end,
                'due_date'     => $due,
                'description'  => "Deskripsi untuk project {$customer->name}",
                'customer_id'  => $customer->id,
                'status'       => 'Active',
            ]);
        }

        $this->command->info('Projects seeded successfully.');
    }
}
