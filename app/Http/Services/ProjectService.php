<?php

namespace App\Http\Services;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Exception;

class ProjectService
{
    public function createProject(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['code'] = Project::generateCode();
            $project = Project::create($data); 

            if (isset($data['type']) && $data['type'] === 'FIT') {
                $project->sales_code = $project->generateSalesCode();
                $project->save();
            }
            
            return $project->fresh(['customer']);
        });
    }

    public function getAllProjects()
    {
        return Project::with(['customer', 'proposals'])->get();
    }

    public function getProjectById($id)
    {
        $project = Project::with(['customer', 'proposals', 'invoices.pcmiBank.bank', 'invoices.items'])->find($id);
        if (!$project) {
            throw new Exception("Project with ID {$id} not found");
        }
        return $project;
    }

    public function updateProject($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $project = Project::find($id);
            if (!$project) {
                throw new Exception("Project with ID {$id} not found");
            }

            // Prevent changing type TO FIT if proposals exist (FIT projects should not have proposals)
            if (isset($data['type']) && $data['type'] === 'FIT' && $project->type === 'Regular') {
                if ($project->proposals()->exists()) {
                    throw new Exception("Cannot change Project Type to FIT because it has existing Proposals. FIT projects cannot have proposals.");
                }
                $data['sales_code'] = $project->generateSalesCode();
            }

            if (isset($data['type']) && $data['type'] === 'Regular' && $project->type === 'FIT') {
                if ($project->invoices()->exists()) {
                    throw new Exception("Cannot change Project Type to Regular because it has existing Invoices. Regular projects cannot have invoices.");
                }
                $data['sales_code'] = null;
            }

            $project->update($data);
            return $project->fresh(['customer']);
        });
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        if (!$project) {
            throw new Exception("Project with ID {$id} not found");
        }
        $project->delete();
    }
}
