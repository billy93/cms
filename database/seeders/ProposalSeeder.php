<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Proposal;

class ProposalSeeder extends Seeder
{
    public function run(): void
    {
        // Get Regular project only (FIT doesn't need proposal)
        $regularProject = Project::where('type', 'Regular')->first();

        if (!$regularProject) {
            $this->command->info('No Regular project found, seeder skipped.');
            return;
        }

        // Create 1 Proposal for Regular Project with pricing model C (most complex for testing)
        $proposal = Proposal::create([
            'project_id' => $regularProject->id,
            'code' => Proposal::generateCode(),
            'status' => 'Win',
            'pricing_model' => 'C', // Incentive Trip - uses headers/subheaders
            'management_fee_type' => 'percent',
            'management_fee' => 10,
            'vat_rate' => 11,
            'pricing_model_description' => 'Corporate Event Package - Full Service',
            'note' => 'Proposal untuk Corporate Event Jakarta 2026',
        ]);

        // Generate sales code for Win proposal
        $proposal->update([
            'sales_code' => $proposal->generateSalesCode()
        ]);

        $this->command->info('Created 1 Proposal for Regular project (pricing model C).');
    }
}
