<?php

namespace App\Http\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleService
{
    public function createRole(array $data)
    {
        return DB::transaction(function () use ($data) {
            $permissionIds = $data['permission_ids'] ?? null;
            $menuIds = $data['menu_ids'] ?? null;
            $data['slug'] = Role::generateSlug($data['name'], 'roles');

            unset($data['permission_ids']);
            unset($data['menu_ids']);

            $role = Role::create($data);

            if (!is_null($permissionIds)) {
                $this->syncPermissions($role, $permissionIds);
            }

            if (!is_null($menuIds)) {
                $this->syncMenus($role, $menuIds);
            }
            
            return $role;
        });
    }

    public function getAllRoles()
    {
        return Role::all();
    }

    public function getRoleById($id)
    {
        $role = Role::with('permissions', 'menus')->find($id);
        if (!$role) {
            throw new Exception("Role with ID {$id} not found");
        }
        return $role;
    }

    public function updateRole($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $role = Role::find($id);

            if (!$role) {
                throw new Exception("Role with ID {$id} not found");
            }

            $permissionIds = $data['permission_ids'] ?? null;
            $menuIds = $data['menu_ids'] ?? null;
            unset($data['permission_ids']);
            unset($data['menu_ids']);

            $role->update($data);

            if (!is_null($permissionIds)) {
                $this->syncPermissions($role, $permissionIds);
            }

            if (!is_null($menuIds)) {
                $this->syncMenus($role, $menuIds);
            }

            return $role;
        });
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        if (!$role) {
            throw new Exception("Role with ID {$id} not found");
        }

        $role->permissions()->detach();
        $role->delete();
    }

    private function syncPermissions(Role $role, array $permissionIds): void
    {
        // Hapus semua relasi lama
        $role->permissions()->detach();

        // Jika tidak ada permission baru, stop di sini
        if (empty($permissionIds)) {
            return;
        }

        // Ambil ID berdasarkan id atau slug (biar fleksibel)
        $ids = Permission::whereIn('id', $permissionIds)
            ->pluck('id')
            ->unique()
            ->toArray();

        // Tambahkan ulang seluruh permission baru
        $role->permissions()->attach($ids);
    }

    private function syncMenus(Role $role, array $menuIds): void
    {
        $role->menus()->detach();

        if (empty($menuIds)) {
            return;
        }

        $ids = Menu::whereIn('id', $menuIds)
            ->pluck('id')
            ->unique()
            ->toArray();

        $role->menus()->attach($ids);
    }
}
