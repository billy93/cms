<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Services\RoleService;
use Exception;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

		/**
		 * Retrieve paginated users with ordering, excluding the password field,
		 * and pass the data to the manage-users view.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @return \Illuminate\View\View
		 */
		public function index(Request $request)
		{
			
			if($request->ajax())
		{
			$roles = Role::select(['id', 'name', 'description', 'created_at']);
			$result = DataTables::eloquent($roles)
			->addColumn('formatted_created_at', function($role) {
				return Carbon::parse($role->created_at)->format('d-M-Y');
			}) 
			->addColumn('actions', function($role) {
				return '
					<div class="dropdown table-action">
						<a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-ellipsis-v"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a 
								id="c_role_edit" 
								class="dropdown-item" 
								href="#" 
								data-id="'.$role->id.'" 
								data-url="'.route('roles.read', ['role_id' => $role->id]).'"
								data-bs-toggle="modal" 
								data-bs-target="#edit_role">
									<i class="ti ti-edit text-blue"></i> Edit
								</a>
								<a 
									id="c_role_delete" 
									class="dropdown-item" 
									href="javascript:void(0);" 
									data-id="'.$role->id.'" 
									data-url="'.route('roles.delete', ['role_id' => $role->id]).'"
									data-bs-toggle="modal" 
									data-bs-target="#delete_role_modal">
										<i class="ti ti-trash text-danger"></i> Delete
									</a>
							</div>
					</div>
				';
				}
			)
			->rawColumns(['actions'])
			->make(true);
				\Log::info('Response (roles.index): ' . json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
				return $result; 
			}

			$permissions = Permission::all();
			return view('roles-permissions', compact('permissions'));
		} 

    public function create(RoleRequest $request): JsonResponse
    {
        try {
            $role = $this->roleService->createRole($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully',
                'data' => $role
            ], 201);
        } catch (Exception $e) {
            Log::error('Error creating role: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create role'
            ], 500);
        }
    }

    public function readAll(): JsonResponse
    {
        $roles = $this->roleService->getAllRoles();
        return response()->json([
            'status' => 'success',
            'data' => $roles
        ], 200);
    }

    public function read($role_id): JsonResponse
    {
        try {
            $role = $this->roleService->getRoleById($role_id);
            return response()->json([
                'success' => true,
                'data' => $role
            ], 200);
        } catch (Exception $e) {
            Log::error('Error reading role: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load role data'
            ], 500);
        }
    }
    
    public function update(RoleRequest $request, $role_id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $role = $this->roleService->updateRole($role_id, $validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully',
                'data' => $role
            ], 200);
        } catch (Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update role'
            ], 500);
        }
    }

    public function delete($role_id): JsonResponse
    {
        try {
            $this->roleService->deleteRole($role_id);
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete role'
            ], 500);
        }
    }

}
