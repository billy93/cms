<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects
     */
    public function index(Request $request): JsonResponse
    {
        try {
            \Log::info('ProjectController@index called', $request->all());
            
            $query = Project::with('customer');

            // Search functionality
            if ($request->has('search') && $request->search) {
                $query->search($request->search);
            }

            // Filter by status
            if ($request->has('status') && $request->status) {
                $query->where('status', $request->status);
            }

            // Filter by customer
            if ($request->has('customer_id') && $request->customer_id) {
                $query->where('customer_id', $request->customer_id);
            }

            // Pagination
            $perPage = $request->get('per_page', 15);
            $projects = $query->orderBy('created_at', 'desc')->paginate($perPage);

            \Log::info('Projects found: ' . $projects->total());

            return response()->json([
                'success' => true,
                'data' => $projects->items(),
                'pagination' => [
                    'current_page' => $projects->currentPage(),
                    'last_page' => $projects->lastPage(),
                    'per_page' => $projects->perPage(),
                    'total' => $projects->total(),
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in ProjectController@index: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving projects: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created project
     */
    public function store(Request $request): JsonResponse
    {
        try {
            \Log::info('Project store request received', $request->all());
            
            $validator = Validator::make($request->all(), [
                'project_code' => 'required|string|max:20|unique:projects,project_code',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'customer_id' => 'required|exists:customers,id',
                'status' => 'nullable|in:active,inactive,completed,cancelled'
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            \Log::info('Validation passed, starting transaction');

            DB::beginTransaction();

            $project = Project::create([
                'project_code' => $request->project_code,
                'name' => $request->name,
                'description' => $request->description,
                'customer_id' => $request->customer_id,
                'status' => $request->status ?? 'active'
            ]);

            \Log::info('Project created successfully', $project->toArray());

            DB::commit();

            // Load customer relationship
            $project->load('customer');

            return response()->json([
                'success' => true,
                'message' => 'Project created successfully',
                'data' => $project
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating project: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error creating project: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified project
     */
    public function show($id): JsonResponse
    {
        try {
            $project = Project::with(['customer', 'proposal'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 404);
        }
    }

    /**
     * Update the specified project
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $project = Project::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'customer_id' => 'sometimes|required|exists:customers,id',
                'status' => 'nullable|in:active,inactive,completed,cancelled'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $project->update($request->only([
                'name',
                'description',
                'customer_id',
                'status'
            ]));

            DB::commit();

            // Load customer relationship
            $project->load('customer');

            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully',
                'data' => $project->fresh(['customer'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating project: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified project
     */
    public function destroy($id): JsonResponse
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting project: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get active projects for dropdown/select
     */
    public function getActiveProjects(): JsonResponse
    {
        try {
            $projects = Project::active()
                ->with('customer')
                ->select('id', 'project_code', 'name', 'customer_id')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $projects
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving active projects: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk update project status
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'project_ids' => 'required|array',
                'project_ids.*' => 'exists:projects,id',
                'status' => 'required|in:active,inactive,completed,cancelled'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            Project::whereIn('id', $request->project_ids)
                ->update(['status' => $request->status]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Project status updated successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating project status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search customers for autocomplete
     */
    public function searchCustomers(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            
            $customers = Customer::active()
                ->where(function($q) use ($query) {
                    $q->where('customer_name', 'LIKE', "%{$query}%")
                      ->orWhere('customer_code', 'LIKE', "%{$query}%");
                })
                ->select('id', 'customer_code', 'customer_name')
                ->orderBy('customer_name')
                ->limit(10)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $customers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error searching customers: ' . $e->getMessage()
            ], 500);
        }
    }
}