<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProposalSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        if ($projects->isEmpty()) {
            $this->command->info('No projects found, seeder skipped.');
            return;
        }

        foreach ($projects as $project) {
            Proposal::create([
                'project_id' => $project->id,
                'code' => Proposal::generateCode(),
                'sales_code' => null,
                // 'type_of_sales_code' => collect(['FIT', 'Non FIT'])->random(),
                // 'year_of_sales' => null,
                // 'destination' => collect(['Indonesia', 'Overseas'])->random(),
                // 'city' => 'City ' . rand(1,10),
                // 'activity' => collect([
                //     'Awarding', 'Conference and Seminar', 'Exhibitions', 'Gala Dinner', 'Gathering', 
                //     'Holidays', 'Incentive Trip', 'Meeting', 'Product Launching', 'Shareholders Meeting (RUPS)', 
                //     'Workshop', 'Others'
                // ])->random(),
                // 'date_from' => Carbon::now()->addDays(rand(0,10)),
                // 'date_to' => Carbon::now()->addDays(rand(11,20)),
                'invoice_no' => null,
                'status' => 'Draft',
            ]);
        }
    }
}

