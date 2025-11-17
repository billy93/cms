<?php

namespace App\Http\Middlewares;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class PermissionMiddleware
{
    public function handle($request, Closure $next)
    {
        $routeName = Route::currentRouteName();

        $permission = Permission::where('route', $routeName)->first();
        if (!$permission) {
            return $next($request);
        }

        $user = Auth::user();
        if (!$user || !$user->role) {
            abort(403);
        }

        $hasAccess = $user->role->permissions()
            ->where('permissions.id', $permission->id)
            ->exists();

        if (!$hasAccess) {
            // Kalau request AJAX / fetch / axios
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 403);
            }

            // Kalau request biasa
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
