<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
     * @return Factory|View
     */
    public function form(Request $request)
    {
        return view('rpm::role.assign')->with([
            'role' => $this->role->getByUuid($request->roleUuid),
            'permissions' => $this->permission->getAll()
                ->groupBy('permission_group_id')
        ]);
    }
}
