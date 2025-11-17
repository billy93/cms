<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
  public function boot()
  {
    View::composer('*', function ($view) {
      $user = auth()->user();

      if ($user && $user->role) {
        $userMenus = $user->role->menus()
          ->where('is_visible', true)
          ->with(['permission'])
          ->orderBy('order_index')
          ->get();
      } else {
        $userMenus = collect();
      }

      $permittedRoutes = $userMenus
        ->pluck('permission.route')
        ->filter()
        ->toArray();

      $view->with(compact('userMenus', 'permittedRoutes'));
    });
  }
}
