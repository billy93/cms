<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Services\RoleService;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $roles = Role::query();

            return DataTables::eloquent($roles)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"]);
                    }
                })
                ->addColumn('actions', function ($r) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="'.route('roles.read', ['role_id' => $r->id]).'">
                                    <i class="ti ti-eye text-info"></i> View
                                </a>
                                <a class="dropdown-item c_role_edit_btn" href="#" 
                                    data-url="'.route('roles.read', ['role_id' => $r->id]).'">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a class="dropdown-item c_role_delete_btn" href="javascript:void(0);" 
                                    data-url="'.route('roles.delete', ['role_id' => $r->id]).'">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('roles');
    }

    public function create(RoleRequest $request): JsonResponse
    {
        try {
            \Log::info($request->validated());
            $role = $this->roleService->createRole($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully',
                'data' => $role
            ], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function readAll(Request $request): JsonResponse
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                return response()->json([
                    'success' => true,
                    'data' => $this->roleService->getAllRoles()
                ], 200);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }
        abort(404);
    }

    public function read(Request $request, $role_id)
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                return response()->json([
                    'success' => true,
                    'data' => $this->roleService->getRoleById($role_id)
                ], 200);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }

        $role = $this->roleService->getRoleById($role_id);
        return view('roles.detail', compact('role'));
    }

    public function update(RoleRequest $request, $role_id): JsonResponse
    {
        try {
            $role = $this->roleService->updateRole($role_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully',
                'data' => $role
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
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
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
