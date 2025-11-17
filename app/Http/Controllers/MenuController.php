<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MenuRequest;
use App\Http\Services\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $menus = Menu::with(['permission', 'roles']);

            if($request->role_id) {
                $menus->whereHas('roles', function($q) use ($request) {
                    $q->where('roles.id', $request->role_id);
                });
            }

            return DataTables::eloquent($menus)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                            ->orWhereHas('permission', fn($p) =>
                                $p->whereRaw('LOWER(route) LIKE ?', ["%{$search}%"])
                            );
                        });
                    }
                })
                ->addColumn('route', fn($m) => $m->permission?->route ?: "-" )
                ->addColumn('method', fn($m) => $m->permission?->method ?: "-" )
                ->addColumn('path', fn($m) => $m->permission?->path ?: "-" )
                ->addColumn('actions', function ($m) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="'.route('menus.read', ['menu_id' => $m->id]).'">
                                    <i class="ti ti-eye text-info"></i> View
                                </a>
                                <a class="dropdown-item c_menu_edit_btn" href="#" data-url="'.route('menus.read', ['menu_id' => $m->id]).'">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a class="dropdown-item c_menu_delete_btn" href="javascript:void(0);" data-url="'.route('menus.delete', ['menu_id' => $m->id]).'">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('menus');
    }

    public function create(MenuRequest $request): JsonResponse
    {
        try {
            $menu = $this->menuService->createMenu($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Menu created successfully',
                'data' => $menu
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create menu'
            ], 500);
        }
    }

    public function readAll(Request $request): JsonResponse
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $menus = $this->menuService->getAllMenus();
                return response()->json([
                    'success' => true,
                    'data' => $menus
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to fetch menus'
                ], 500);
            }
        }
        abort(404);
    }

    public function read(Request $request, $menu_id)
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $menu = $this->menuService->getMenuById($menu_id);
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => true,
                        'data' => $menu
                    ]);
                }
                return view('menus.detail', compact('menu'));
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to load menu'
                ], 500);
            }
        }
        
        $menu = $this->menuService->getMenuById($menu_id);
        return view('menus.detail', compact('menu'));
    }

    public function update(MenuRequest $request, $menu_id): JsonResponse
    {
        try {
            $menu = $this->menuService->updateMenu($menu_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Menu updated successfully',
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to update menu'
            ], 500);
        }
    }

    public function delete($menu_id): JsonResponse
    {
        try {
            $this->menuService->deleteMenu($menu_id);
            return response()->json([
                'success' => true,
                'message' => 'Menu deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to delete menu'
            ], 500);
        }
    }
}
