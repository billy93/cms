<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;
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

    public function create(PermissionRequest $request): JsonResponse
    {
        $permission = $this->permissionService->createPermission($request->validated());            
        return response()->json([
            'status' => 'success',
            'data' => $permission
        ], 201);
    }

    public function getAll(): JsonResponse
    {
        $permissions = $this->permissionService->getAllPermissions();
        return response()->json([
            'status' => 'success',
            'data' => $permissions
        ], 200);
    }

    public function getById($permission_id): JsonResponse
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
    
    /**
     * Menampilkan semua izin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            $permissions = Permission::all(); 
            $result = DataTables::of($permissions)
            ->addColumn('checkbox', function($row) {
                return '<input type="checkbox" name="id[]" value="'.$row->id.'">';
            })
            ->addColumn('module', function($row) {
                return $row->name ?? '-';
            })
            ->addColumn('sub_module', function($row) {
                return $row->sub_module ?? '-';
            })
            ->addColumn('create_checkbox', function($row) {
                return '<input type="checkbox" '.($row->can_create ? 'checked' : '').'>';
            })
            ->addColumn('edit_checkbox', function($row) {
                return '<input type="checkbox" '.($row->can_edit ? 'checked' : '').'>';
            })
            ->addColumn('view_checkbox', function($row) {
                return '<input type="checkbox" '.($row->can_view ? 'checked' : '').'>';
            })
            ->addColumn('delete_checkbox', function($row) {
                return '<input type="checkbox" '.($row->can_delete ? 'checked' : '').'>';
            })
            ->addColumn('allow_checkbox', function($row) {
                return '<input type="checkbox" '.($row->is_allowed ? 'checked' : '').'>';
            })
            ->rawColumns(['checkbox', 'create_checkbox', 'edit_checkbox', 'view_checkbox', 'delete_checkbox', 'allow_checkbox'])
            ->make(true);
            \Log::info('DataTables Response: ' . json_encode($result->getData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return $result; 
        }

        return view('permission');
    }
}
