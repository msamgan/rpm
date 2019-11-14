<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Msamgan\Rpm\Models\Permission;
use Msamgan\Rpm\Models\Role;
use Msamgan\Rpm\Models\RolePermission;

class AssignController extends Controller
{
    /**
     * @var Role
     */
    protected $role;

    /**
     * @var Permission
     */
    protected $permission;

    /**
     * AssignController constructor.
     * @param Role $role
     */
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function form(Request $request)
    {
        $role = $this->role->getByUuid($request->roleUuid);

        $rolePermissions = RolePermission::query()
            ->where('role_id', $role->id)
            ->pluck('permission_id');

        $rolePermissions = $rolePermissions ?
            $rolePermissions->toArray() :
            [];

        return view('rpm::role.assign')->with([
            'role' => $role,
            'permissions' => $this->permission->getAll()
                ->groupBy('permission_group_id'),
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $role = $this->role->getByUuid($request->roleUuid);

        RolePermission::query()
            ->where('role_id', $role->id)
            ->delete();

        $permissions = $request->get('permissions');

        if (!$permissions) {
            return response()->json([
                'status' => true,
                'message' => 'Old permissions removed, nothing updated'
            ]);
        }

        foreach ($permissions as $permission) {
            RolePermission::query()->create([
                'role_id' => $role->id,
                'permission_id' => $permission
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Permissions updated'
        ]);
    }
}
