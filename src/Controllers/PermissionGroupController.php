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
}
