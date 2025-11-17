<?php

namespace App\Http\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class MenuService
{
    public function createMenu(array $data)
    {
        return DB::transaction(function () use ($data) {
            $menu = Menu::create($data);
            return $menu->fresh();
        });
    }

    public function getAllMenus()
    {
        return Menu::with('permission', 'parent')->orderBy('order_index')->get();
    }

    public function getMenuById($id)
    {
        $menu = Menu::with('permission', 'parent')->find($id);
        if (!$menu) throw new Exception("Menu with ID {$id} not found");
        return $menu;
    }

    public function updateMenu($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $menu = Menu::find($id);
            if (!$menu) throw new Exception("Menu with ID {$id} not found");

            $menu->update($data);
            return $menu->fresh();
        });
    }

    public function deleteMenu($id)
    {
        $menu = Menu::find($id);
        if (!$menu) throw new Exception("Menu with ID {$id} not found");

        // optional: handle children if needed
        $menu->delete();
    }

    public static function canAccess(string $permissionRoute): bool
    {
        $user = Auth::user();
        if (!$user || !$user->role) {
            \Log::info("MenuService: user atau role tidak ditemukan untuk permission '{$permissionRoute}'");
            return false;
        }

        // ambil semua permission yang terkait dengan menu-role
        $permissions = $user->role->menus
            ->load('permission') // eager load permission
            ->pluck('permission') // ambil model permission
            ->filter()            // pastikan tidak null
            ->map(fn($perm) => $perm->route); // ambil nama permission

        $hasAccess = $permissions->contains($permissionRoute);
        return $hasAccess;
    }
}
