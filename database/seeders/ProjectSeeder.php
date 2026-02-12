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
        $customers = Customer::take(2)->get();

        if ($customers->count() < 2) {
            $this->command->info('Need at least 2 customers, seeder skipped.');
            return;
        }

        $customerRegular = $customers->first();
        $customerFit = $customers->last();

        $start = Carbon::now()->subDays(30);
        $end = (clone $start)->addDays(60);
        $due = (clone $end)->addDays(14);

        // 1. Regular Project (uses Proposal flow)
        $regularProject = Project::create([
            'code' => Project::generateCode(),
            'name' => 'Corporate Event Jakarta 2026',
            'ref_doc_no' => 'REF-REG-001',
            'value' => '500000000,00', // 500 juta
            'start_date' => $start,
            'end_date' => $end,
            'due_date' => $due,
            'description' => 'Event management untuk corporate gathering 500 orang di Jakarta. Termasuk venue, catering, entertainment, dan dokumentasi.',
            'customer_id' => $customerRegular->id,
            'status' => 'Active',
            'type' => 'Regular',
        ]);

        // 2. FIT Project (direct transaction, no proposal)
        $fitProject = Project::create([
            'code' => Project::generateCode(),
            'name' => 'Business Trip Support Q1 2026',
            'ref_doc_no' => 'REF-FIT-001',
            'value' => '25000000,00', // 25 juta
            'start_date' => $start,
            'end_date' => $end,
            'due_date' => $due,
            'description' => 'Pembelian tiket pesawat, hotel, dan transportasi untuk business trip tim sales.',
            'customer_id' => $customerFit->id,
            'status' => 'Active',
            'type' => 'FIT',
        ]);

        // Generate sales code for FIT project
        $fitProject->update([
            'sales_code' => $fitProject->generateSalesCode()
        ]);

        $this->command->info('Created 2 projects: 1 Regular, 1 FIT');
    }
}

