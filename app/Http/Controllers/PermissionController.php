<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Permission;
use App\Http\Requests\PermissionRequest;
use App\Http\Services\PermissionService;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
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
            $permissions = Permission::query();
            $result = DataTables::eloquent($permissions)
            ->addColumn("created_at", function($permission) {
                return Carbon::parse($permission->created_at)->format('d-M-Y');
            }) 
            ->addColumn('actions', function($permission) {
                return '
                    <div class="dropdown table-action">
                        <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a 
                                id="c_permission_edit" 
                                class="dropdown-item" 
                                href="#" 
                                data-id="'.$permission->id.'" 
                                data-url="'.route('permissions.read', ['permission_id' => $permission->id]).'"
                                data-bs-toggle="modal" 
                                data-bs-target="#edit_permission">
                                <i class="ti ti-edit text-blue"></i> Edit
                            </a>
                            <a 
                                id="c_permission_delete" 
                                class="dropdown-item" 
                                href="javascript:void(0);" 
                                data-id="'.$permission->id.'" 
                                data-url="'.route('permissions.delete', ['permission_id' => $permission->id]).'"
                                data-bs-toggle="modal" 
                                data-bs-target="#delete_permission_modal">
                                <i class="ti ti-trash text-danger"></i> Delete
                            </a>
                        </div>
                    </div>
                ';
                }
            )
            ->rawColumns(['actions'])
            ->make(true);
            \Log::info('Response (permissions.index): ' . json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return $result; 
        }

        return view('permission');
    }
        
    public function create(PermissionRequest $request): JsonResponse
    {
        $permission = $this->permissionService->createPermission($request->validated());            
        return response()->json([
            'status' => 'success',
            'data' => $permission
        ], 201);
    }

    public function readAll(): JsonResponse
    {
        $permissions = $this->permissionService->getAllPermissions();
        return response()->json([
            'status' => 'success',
            'data' => $permissions
        ], 200);
    }

    public function read($permission_id): JsonResponse
    {
        $permission = $this->permissionService->getPermissionById($permission_id);
        return response()->json([
            'status' => 'success',
            'data' => $permission
        ], 200);
    }

    public function update(PermissionRequest $request, $permission_id): JsonResponse
    {
        $validatedData = $request->validated();
        $permission = $this->permissionService->updatePermission($permission_id, $validatedData);
        return response()->json([
            'status' => 'success',
            'data' => $permission
        ], 200);
    }

    public function delete($permission_id): JsonResponse
    {
        $this->permissionService->deletePermission($permission_id);
        return response()->json([
            'status' => 'success',
            'message' => "Permission with ID {$permission_id} deleted successfully"
        ], 200);
    }
}
