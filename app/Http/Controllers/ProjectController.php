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
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $projects = Project::with(['proposals', 'customer']);

            return DataTables::eloquent($projects)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(code) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(ref_doc_no) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                            ->orWhereHas('customer', fn($p) =>
                                $p->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                            )
                            ->orWhereHas('proposals', fn($p) =>
                                $p->whereRaw('LOWER(code) LIKE ?', ["%{$search}%"])
                            );
                        });
                    }
                })
                ->addColumn('customer_name', fn($p) => $p->customer->name ?? '-')
                ->addColumn('actions', function ($p) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('projects.read', ['project_id' => $p->id]).'"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a  
                                    class="dropdown-item c_project_edit_btn" 
                                    href="#" 
                                    data-url="'.route('projects.read', ['project_id' => $p->id]).'"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_project_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-url="'.route('projects.delete', ['project_id' => $p->id]).'"
                                >
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

    public function read(Request $request, $project_id)
    {
        if($request->wantsJson() || $request->ajax()) {
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
        
        $project = $this->projectService->getProjectById($project_id);
        return view('projects.detail', compact('project'));
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
