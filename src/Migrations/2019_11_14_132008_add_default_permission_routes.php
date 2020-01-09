<?php

use Illuminate\Database\Migrations\Migration;
use Msamgan\Rpm\Models\PermissionRoute;

class AddDefaultPermissionRoutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PermissionRoute::query()->create([
            'permission_id' => 1,
            'route_name' => 'rpm.role.list'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 1,
            'route_name' => 'rpm.role.load.list'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 1,
            'route_name' => 'rpm.role.show'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 1,
            'route_name' => 'rpm.role.delete'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 1,
            'route_name' => 'rpm.role.store'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 1,
            'route_name' => 'rpm.role.update'
        ]);


        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.list'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.load.list'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.show'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.delete'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.store'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.update'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.menu.store'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 2,
            'route_name' => 'rpm.permission.menu.show'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 3,
            'route_name' => 'rpm.permission-group.list'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 3,
            'route_name' => 'rpm.permission-group.load.list'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 3,
            'route_name' => 'rpm.permission-group.show'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 3,
            'route_name' => 'rpm.permission-group.delete'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 3,
            'route_name' => 'rpm.permission-group.store'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 3,
            'route_name' => 'rpm.permission-group.update'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 4,
            'route_name' => 'rpm.assign'
        ]);

        PermissionRoute::query()->create([
            'permission_id' => 4,
            'route_name' => 'rpm.assign.store'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
