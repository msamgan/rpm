<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Msamgan\Rpm\Models\Permission;
use Msamgan\Rpm\Models\Role;

class AssignController extends Controller
{
    /**
     * @var Role
     */
    protected $role;

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
     */
    public function form(Request $request)
    {
        $role = $this->role->getByUuid($request->roleUuid);
        $permissions = $this->permission->getAll()->groupBy('permission_group_id');
    }
}
