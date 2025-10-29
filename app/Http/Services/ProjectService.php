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
            return $project->fresh(['customer']);
        });
    }

    public function getAllProjects()
    {
        return Project::with(['customer', 'proposals'])->get();
    }

    public function getProjectById($id)
    {
        $project = Project::with(['customer', 'proposals'])->find($id);
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
