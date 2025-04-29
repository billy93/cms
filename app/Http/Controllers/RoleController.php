<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\RoleRequest;
use App\Http\Services\RoleService;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function create(RoleRequest $request): JsonResponse
    {
        $role = $this->roleService->createRole($request->validated());
        return response()->json([
            'status' => 'success',
            'data' => $role
        ], 201);
    }

    public function getAll(): JsonResponse
    {
        $roles = $this->roleService->getAllRoles();
        return response()->json([
            'status' => 'success',
            'data' => $roles
        ], 200);
    }

    public function getById($role_id): JsonResponse
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
