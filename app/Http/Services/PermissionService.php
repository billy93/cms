<?php

namespace App\Http\Services;

use App\Models\Permission;
use App\Http\Exceptions\CustomApiException;

class PermissionService
{
    public function createPermission(array $data)
    {
        $permission = Permission::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
        
        if (isset($data['role_ids'])) {
            $permission->roles()->sync($data['role_ids']);
        }

        return $permission->load('roles')->roles->makeHidden('pivot');
    }

    public function getAllPermissions()
    {
        return Permission::with('roles')->get()->map(function ($permission) {
            $permission->roles->makeHidden('pivot');
            return $permission;
        });
    }

    public function getPermissionById($id)
    {
        $permission = Permission::with('roles')->find($id);

        if (!$permission) {
            throw new CustomApiException("Permission with ID {$id} not found", 404);
        }

        return $permission->roles->makeHidden('pivot');
    }

    public function updatePermission($id, array $data)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            throw new CustomApiException("Permission with ID {$id} not found", 404);
        }

        $permission->update([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
        
        if (isset($data['role_ids'])) {
            $permission->roles()->sync($data['role_ids']);
        }

        return $permission->load('roles')->roles->makeHidden('pivot');
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        
        if (!$permission) {
            throw new CustomApiException("Permission with ID {$id} not found", 404);
        }

        $permission->delete();
    
    }
}
