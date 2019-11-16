<?php

namespace Msamgan\Rpm;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Msamgan\Rpm\Models\Permission;
use Msamgan\Rpm\Models\RolePermission;
use Msamgan\Rpm\Models\UserRole;

class RpmMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $role = $this->getCurrentRole();
        $permissions = $this->getRolePermissions($role->id);

        $allowed = false;
        foreach ($permissions as $permission) {
            $routeList = Permission::query()->find($permission)
                ->permissionRoutes
                ->pluck('route_name');
            $routeList = $routeList ? $routeList->toArray() : [];

            if (in_array(
                $request->route()->getName(),
                $routeList
            )) {
                $allowed = true;
                break;
            }
        }

        if ($allowed) {
            return $next($request);
        }

        abort(403, 'Sorry mate, you are not allowed...');
    }

    /**
     * @return mixed
     */
    private function getCurrentRole()
    {
        $role = UserRole::query()
            ->where('user_id', Auth::id())
            ->first();

        if (!$role) {
            abort(403, 'No role found, please assign at least one role to this user...');
        }

        return $role->role;
    }

    /**
     * @param $roleId
     * @return array
     */
    private function getRolePermissions($roleId)
    {
        $rolePermissions = RolePermission::query()
            ->where('role_id', $roleId)
            ->pluck('permission_id');

        return $rolePermissions ? $rolePermissions->toArray() : [];
    }
}
