<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    protected MenuService $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $menus = Menu::with('parent')->select(['id', 'label', 'path', 'icon', 'parent_id', 'sort', 'is_active', 'created_at']);
            
            $result = DataTables::eloquent($menus)
            ->addColumn('parent_name', function($menu) {
                return $menu->parent ? $menu->parent->label : '-';
            })
            ->editColumn('is_active', function($menu) {
                $statusClass = $menu->is_active ? 'badge-success' : 'badge-danger';
                $statusText = $menu->is_active ? 'Active' : 'Inactive';
                return '<span class="badge '.$statusClass.'">'.$statusText.'</span>';
            })
            ->editColumn('created_at', function($menu) {
                return Carbon::parse($menu->created_at)->format('d-M-Y');
            })
            ->addColumn('actions', function($menu) {
                return '
                    <div class="dropdown table-action">
                        <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a 
                                id="c_menu_edit" 
                                class="dropdown-item" 
                                href="#" 
                                data-id="'.$menu->id.'" 
                                data-url="'.route('menus.show', ['menu' => $menu->id]).'"  
                                data-bs-toggle="offcanvas" 
                                data-bs-target="#offcanvas_edit_menu">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a 
                                    id="c_menu_delete" 
                                    class="dropdown-item" 
                                    href="javascript:void(0);" 
                                    data-id="'.$menu->id.'" 
                                    data-url="'.route('menus.destroy', ['menu' => $menu->id]).'"  
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete_menu_modal">
                                        <i class="ti ti-trash text-danger"></i> Delete
                                    </a>
                            </div>
                    </div>
                ';
                }
            )
            ->rawColumns(['is_active', 'actions'])
            ->make(true);
            
            \Log::info('Response (menus.index): ' . json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return $result; 
        }

        $parentMenus = $this->menuService->getParentMenus();
        return view('manage-menus', compact('parentMenus'));
    }

    public function create(MenuRequest $request): JsonResponse
    {
        try {
            $menu = $this->menuService->createMenu($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Menu created successfully.',
                'data' => $menu->load('parent')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Menu $menu): JsonResponse
    {
        try {
            $menu = $this->menuService->getMenuById($menu->id);

            return response()->json([
                'success' => true,
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Menu not found.'
            ], 404);
        }
    }

    public function update(MenuRequest $request, Menu $menu): JsonResponse
    {
        try {
            $updatedMenu = $this->menuService->updateMenu($menu, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Menu updated successfully.',
                'data' => $updatedMenu->load('parent')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Menu $menu): JsonResponse
    {
        try {
            $this->menuService->deleteMenu($menu);

            return response()->json([
                'success' => true,
                'message' => 'Menu deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete menu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Menu $menu): JsonResponse
    {
        try {
            $updatedMenu = $this->menuService->toggleMenuStatus($menu);

            return response()->json([
                'success' => true,
                'message' => 'Menu status updated successfully.',
                'data' => $updatedMenu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update menu status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reorder(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'menu_order' => 'required|array',
                'menu_order.*' => 'exists:menus,id'
            ]);

            $this->menuService->reorderMenus($request->menu_order);

            return response()->json([
                'success' => true,
                'message' => 'Menu order updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder menus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getParentMenus(): JsonResponse
    {
        try {
            $parentMenus = $this->menuService->getParentMenus();

            return response()->json([
                'success' => true,
                'data' => $parentMenus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch parent menus.'
            ], 500);
        }
    }
}