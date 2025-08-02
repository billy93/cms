<?php
 
namespace App\Http\Services;

use App\Models\Role;
use App\Http\Exceptions\CustomApiException;

class RoleService
{
    public function createRole(array $data)
    {
        $role = Role::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        if (isset($data['permission_ids'])) {
            $role->permissions()->sync($data['permission_ids']);
        }

        return $role->load('permissions')->permissions->makeHidden('pivot');
    }

    public function getAllRoles()
    {
        return Role::with('permissions')->get()->map(function ($role) {
            $role->permissions->makeHidden('pivot');
            return $role;
        });
    }

    public function getRoleById($id)
    {
        $role = Role::with('permissions')->find($id);

        if (!$role) {
            throw new CustomApiException("Role with ID {$id} not found", 404);
        }

        return $role->permissions->makeHidden('pivot');
    }

    public function updateRole($id, array $data)
    {
        $role = Role::find($id);

        if (!$role) {
            throw new CustomApiException("Role with ID {$id} not found", 404);
        }

        $role->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        if (isset($data['permission_ids'])) {
            $role->permissions()->sync($data['permission_ids']);
        }

        return $role->load('permissions')->permissions->makeHidden('pivot');
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);

        if (!$role) {
            throw new CustomApiException("Role with ID {$id} not found", 404);
        }

        $role->delete();
    }
}
