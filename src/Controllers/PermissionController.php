<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Msamgan\Rpm\Models\Permission;
use Msamgan\Rpm\Models\PermissionGroup;

/**
 * Class PermissionController
 * @package Msamgan\Rpm\Controllers
 */
class PermissionController extends Controller
{
    /**
     * @var Permission
     */
    protected $permission;

    /**
     * @var PermissionGroup
     */
    protected $permissionGroup;

    /**
     * PermissionController constructor.
     * @param Permission $permission
     * @param PermissionGroup $permissionGroup
     */
    public function __construct(Permission $permission, PermissionGroup $permissionGroup)
    {
        $this->permission = $permission;
        $this->permissionGroup = $permissionGroup;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('rpm::permission.permission.list')->with([
            'permissionGroups' => $this->permissionGroup->getAll()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function load(Request $request): JsonResponse
    {
        return $this->permission
            ->getList($request->all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->permission
            ->store($request->except('_token'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        return $this->permission
            ->updatePermission(
                $this->permission->getByUuid($request->uuid),
                $request->except('_token')
            );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $this->permission
                ->getByUuid($request->uuid)
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $permission = $this->permission
            ->getByUuid($request->uuid);

        try {

            if ($permission->delete()) {
                return response()->json([
                    'status' => true
                ]);
            }

            return response()->json([
                'status' => false
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'errorCode' => $e->getCode()
            ]);
        }
    }
}
