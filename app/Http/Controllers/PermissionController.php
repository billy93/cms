<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PermissionRequest;
use App\Http\Services\PermissionService;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $permissions = Permission::with(['roles']);

            if($request->role_id) {
                $permissions->whereHas('roles', function($q) use ($request) {
                    $q->where('roles.id', $request->role_id);
                });
            }

            return DataTables::eloquent($permissions)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->whereRaw('LOWER(route) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(path) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(method) LIKE ?', ["%{$search}%"]);
                    }
                })
                ->addColumn('actions', function ($p) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('permissions.read', ['permission_id' => $p->id]).'">
                                    <i class="ti ti-eye text-info"></i> View
                                </a>
                                <a  
                                    class="dropdown-item c_permission_edit_btn" 
                                    href="#" 
                                    data-url="'.route('permissions.read', ['permission_id' => $p->id]).'">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_permission_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-url="'.route('permissions.delete', ['permission_id' => $p->id]).'">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('permissions');
    }

    public function create(PermissionRequest $request): JsonResponse
    {
        try {
            $permission = $this->permissionService->createPermission($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Permission created successfully',
                'data' => $permission
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create permission'
            ], 500);
        }
    }

    public function readAll(Request $request): JsonResponse
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $permissions = $this->permissionService->getAllPermissions();
                return response()->json([
                    'success' => true,
                    'data' => $permissions
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to fetch permissions'
                ], 500);
            }
        }
        abort(404);
    }

    public function read(Request $request, $permission_id)
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $permission = $this->permissionService->getPermissionById($permission_id);
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'data' => $permission
                    ], 200);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to load permission'
                ], 500);
            }
        }

        $permission = $this->permissionService->getPermissionById($permission_id);
        return view('permissions.detail', compact('permission'));
    }

    public function update(PermissionRequest $request, $permission_id): JsonResponse
    {
        try {
            $permission = $this->permissionService->updatePermission($permission_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully',
                'data' => $permission
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to update permission'
            ], 500);
        }
    }

    public function delete($permission_id): JsonResponse
    {
        try {
            $this->permissionService->deletePermission($permission_id);
            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to delete permission'
            ], 500);
        }
    }
}
