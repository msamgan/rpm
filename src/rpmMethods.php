<?php

use Msamgan\Rpm\Models\PermissionGroup;

if (!function_exists('fetchPermissionGroupById')) {
    /**
     * @param $id
     * @return mixed
     */
    function fetchPermissionGroupById($id)
    {
        return app(PermissionGroup::class)->find($id);
    }
}
