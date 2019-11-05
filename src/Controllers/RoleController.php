<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Msamgan\Rpm\Models\Role;

/**
 * Class RoleController
 * @package Msamgan\Rpm\Controllers
 */
class RoleController extends Controller
{
    /**
     * @var Role
     */
    protected $role;

    /**
     * RoleController constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function load(Request $request)
    {
        return $this->role
            ->getList($request->all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return $this->role
            ->store($request->except('_token'));
    }

    public function update(Request $request)
    {
        if ($this->role
            ->updateRole(
                $this->role->getByUuid($request->uuid),
                $request->except('_token')
            )) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $this->role
                ->getByUuid($request->uuid)
        ]);
    }
}
