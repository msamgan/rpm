<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Msamgan\Rpm\Models\PermissionGroup;

/**
 * Class PermissionGroupController
 * @package Msamgan\Rpm\Controllers
 */
class PermissionGroupController extends Controller
{
    /**
     * @var PermissionGroup
     */
    protected $permissionGroup;

    /**
     * PermissionGroupController constructor.
     * @param PermissionGroup $permissionGroup
     */
    public function __construct(PermissionGroup $permissionGroup)
    {
        $this->permissionGroup = $permissionGroup;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function load(Request $request)
    {
        return $this->permissionGroup
            ->getList($request->all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->permissionGroup
            ->store($request->except('_token'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        return $this->permissionGroup
            ->updatePermissionGroup(
                $this->permissionGroup->getByUuid($request->uuid),
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
            'data' => $this->permissionGroup
                ->getByUuid($request->uuid)
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $permissionGroup = $this->permissionGroup
            ->getByUuid($request->uuid);

        try {

            if ($permissionGroup->delete()) {
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
