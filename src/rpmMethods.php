<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Msamgan\Rpm\Models\PermissionGroup;
use Msamgan\Rpm\Models\RoleMenu;

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

if (!function_exists('fetchMenus()')) {
    /**
     * @return Builder[]|Collection|\Illuminate\Support\Collection|object
     */
    function fetchMenus()
    {
        $currentRole = auth()
            ->user()
            ->currentRole();

        if (!$currentRole) {
            return (object)[];
        }

        return RoleMenu::query()
            ->where('role_id', $currentRole->id)
            ->get()->map(function ($item) {
                return (object)[
                    'name' => $item->menu->name,
                    'route' => $item->menu->route,
                    'icon' => $item->menu->icon
                ];
            });
    }
}
