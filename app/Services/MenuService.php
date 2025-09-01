<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class MenuService
{
    public function createMenu(array $data): Menu
    {
        return Menu::create([
            'label' => $data['label'],
            'path' => $data['path'],
            'icon' => $data['icon'] ?? null,
            'parent_id' => $data['parent_id'] ?? null,
            'sort' => $data['sort'] ?? 0,
            'is_active' => $data['is_active'] ?? true
        ]);
    }

    public function updateMenu(Menu $menu, array $data): Menu
    {
        $menu->update([
            'label' => $data['label'],
            'path' => $data['path'],
            'icon' => $data['icon'] ?? $menu->icon,
            'parent_id' => $data['parent_id'] ?? $menu->parent_id,
            'sort' => $data['sort'] ?? $menu->sort,
            'is_active' => $data['is_active'] ?? $menu->is_active
        ]);

        return $menu->fresh();
    }

    public function deleteMenu(Menu $menu): bool
    {
        // Check if menu has children
        if ($menu->hasChildren()) {
            throw new \Exception('Cannot delete menu that has children. Please delete or reassign children first.');
        }

        return $menu->delete();
    }

    public function getAllMenus(): LengthAwarePaginator
    {
        return Menu::with('parent')
            ->orderBy('sort')
            ->orderBy('label')
            ->paginate(10);
    }

    public function getMenuById(int $id): Menu
    {
        return Menu::with('parent', 'children')->findOrFail($id);
    }

    public function getParentMenus(): Collection
    {
        return Menu::parents()
            ->active()
            ->orderBy('sort')
            ->orderBy('label')
            ->get();
    }

    public function getMenuHierarchy(): Collection
    {
        return Menu::getHierarchy();
    }

    public function searchMenus(string $search): LengthAwarePaginator
    {
        return Menu::with('parent')
            ->where('label', 'like', "%{$search}%")
            ->orWhere('path', 'like', "%{$search}%")
            ->orderBy('sort')
            ->orderBy('label')
            ->paginate(10);
    }

    public function toggleMenuStatus(Menu $menu): Menu
    {
        $menu->update([
            'is_active' => !$menu->is_active
        ]);

        return $menu->fresh();
    }

    public function reorderMenus(array $menuOrder): bool
    {
        foreach ($menuOrder as $order => $menuId) {
            Menu::where('id', $menuId)->update(['sort' => $order + 1]);
        }

        return true;
    }

    /**
     * Get menus accessible by the current user based on their role
     *
     * @return array
     */
    public static function getAccessibleMenus()
    {
        $user = Auth::user();
        
        if (!$user) {
            return [];
        }

        // Get user's role
        $userRole = $user->role;
        
        if (!$userRole) {
            return [];
        }

        // Get menus assigned to this role
        $assignedMenus = Menu::whereHas('roles', function ($query) use ($userRole) {
            $query->where('role_id', $userRole->id);
        })
        ->where('is_active', true)
        ->orderBy('sort')
        ->get();

        // Convert to array of paths for easy checking
        $accessiblePaths = $assignedMenus->pluck('path')->toArray();
        
        return $accessiblePaths;
    }

    /**
     * Check if current user can access a specific menu path
     *
     * @param string $path
     * @return bool
     */
    public static function canAccess($path)
    {
        // Dashboard is always accessible
        if ($path === 'dashboard' || $path === '/') {
            return true;
        }

        $accessibleMenus = self::getAccessibleMenus();
        
        return in_array($path, $accessibleMenus);
    }

    /**
     * Check if current user has super admin role
     *
     * @return bool
     */
    public static function isSuperAdmin()
    {
        $user = Auth::user();
        
        if (!$user || !$user->role) {
            return false;
        }

        // Assuming super admin role has name 'Super Admin' or similar
        return strtolower($user->role->name) === 'super admin' || 
               strtolower($user->role->name) === 'admin';
    }
}