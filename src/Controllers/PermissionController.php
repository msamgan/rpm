<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Msamgan\Rpm\Models\Permission;

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
     * PermissionController constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
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
