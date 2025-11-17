<?php

namespace App\Http\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Exception;

class PermissionService
{
    public function createPermission(array $data)
    {
        return DB::transaction(function () use ($data) {
            $permission = Permission::create($data);
            return $permission->fresh();
        });
    }

    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function getPermissionById($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            throw new Exception("Permission with ID {$id} not found");
        }
        return $permission;
    }

    public function updatePermission($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $permission = Permission::find($id);
            if (!$permission) {
                throw new Exception("Permission with ID {$id} not found");
            }

            $permission->update($data);
            return $permission->fresh();
        });
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            throw new Exception("Permission with ID {$id} not found");
        }

        $permission->delete();
    }
}
