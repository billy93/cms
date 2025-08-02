<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Services\RoleService;

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
				$roles = Role::query();
				$result = DataTables::eloquent($roles)
				->addColumn("created_at", function($role) {
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
        $role = $this->roleService->createRole($request->validated());
        return response()->json([
            'status' => 'success',
            'data' => $role
        ], 201);
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
        $role = $this->roleService->getRoleById($role_id);
        return response()->json([
            'status' => 'success',
            'data' => $role
        ], 200);
    }
    
    public function update(RoleRequest $request, $role_id): JsonResponse
    {
        $validatedData = $request->validated();
        $role = $this->roleService->updateRole($role_id, $validatedData);
        return response()->json([
            'status' => 'success',
            'data' => $role
        ], 200);
    }

    public function delete($role_id): JsonResponse
    {
        $this->roleService->deleteRole($role_id);
        return response()->json([
            'status' => 'success', 
            'message' => "Role with ID {$role_id} deleted successfully"
        ], 200);
    }

}
