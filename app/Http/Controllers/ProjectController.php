<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProjectRequest;
use App\Http\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::with(['proposals', 'customer']);

            return DataTables::eloquent($projects)
                ->addColumn('customer_name', fn($p) => $p->customer->name ?? '-')
                ->addColumn('proposal_action', function ($project) {
                    $createBtn = '<button class="btn btn-sm btn-outline-primary" data-project-id="' . $project->id . '">Create Proposal</button>';

                    $viewBtn = '';
                    if ($project->proposals && $project->proposals->count() > 0) {
                        $viewBtn = '<button class="btn btn-sm btn-outline-success ms-1" data-project-id="' . $project->id . '">View Proposal</button>';
                    }

                    return '
                        <div class="d-flex gap-2">
                            ' . $createBtn . '
                            ' . $viewBtn . '
                        </div>
                    ';
                })
                ->addColumn('status_badge', fn($p) =>
                    match ($p->status) {
                        'Active' => '<span class="badge badge-status bg-success">Active</span>',
                        'Inactive' => '<span class="badge badge-status bg-secondary">Inactive</span>',
                        'Completed' => '<span class="badge badge-status bg-primary">Completed</span>',
                        'Cancelled' => '<span class="badge badge-status bg-danger">Cancelled</span>',
                        default => '<span class="badge badge-status bg-dark">Unknown</span>'
                    }
                )
                ->addColumn('actions', function ($p) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('projects.show', ['project_id' => $p->id]).'"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a  
                                    class="dropdown-item c_project_edit" 
                                    href="#" 
                                    data-id="'.$p->id.'" 
                                    data-url="'.route('projects.read', ['project_id' => $p->id]).'"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas_add">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_project_delete" 
                                    href="javascript:void(0);" 
                                    data-id="'.$p->id.'" 
                                    data-url="'.route('projects.delete', ['project_id' => $p->id]).'"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete_project_modal">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['proposal_action', 'status_badge', 'actions'])
                ->make(true);
        }

        return view('projects');
    }

    public function show($project_id)
    {
        $project = $this->projectService->getProjectById($project_id);
        
        return view('projects.show', compact('project'));
    }
    
    public function create(ProjectRequest $request): JsonResponse
    {
        try {
            $project = $this->projectService->createProject($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Project created successfully',
                'data' => $project
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating Project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Project'
            ], 500);
        }
    }

    public function readAll(): JsonResponse
    {
        $projects = $this->projectService->getAllProjects();
        return response()->json([
            'status' => 'success',
            'data' => $projects
        ], 200);
    }

    public function read($project_id): JsonResponse
    {
        try {
            $project = $this->projectService->getProjectById($project_id);
            return response()->json([
                'success' => true,
                'data' => $project
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error reading Project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load Project'
            ], 500);
        }
    }

    public function update(ProjectRequest $request, $project_id): JsonResponse
    {
        try {
            $project = $this->projectService->updateProject($project_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully',
                'data' => $project
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating Project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Project'
            ], 500);
        }
    }

    public function delete($project_id): JsonResponse
    {
        try {
            $this->projectService->deleteProject($project_id);
            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting Project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Project'
            ], 500);
        }
    }
}
