<?php

use Illuminate\Database\Migrations\Migration;
use Msamgan\Rpm\Models\Permission;

class AddDefaultPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::query()->create([
            'permission_group_id' => 1,
            'name' => 'Manage Roles',
            'Description' => 'Add, edit and delete roles in the system',
            'route_name' => 'rpm.role.list'
        ]);

        Permission::query()->create([
            'permission_group_id' => 2,
            'name' => 'Manage Permissions',
            'Description' => 'Add, edit and delete permissions in the system',
            'route_name' => 'rpm.permission.list'
        ]);

        Permission::query()->create([
            'permission_group_id' => 2,
            'name' => 'Manage Permission Groups',
            'Description' => 'Add, edit and delete permission Groups in the system',
            'route_name' => 'rpm.permission-group.list'
        ]);

        Permission::query()->create([
            'permission_group_id' => 2,
            'name' => 'Assign Permissions',
            'Description' => 'Assign permissions to other roles.',
            'route_name' => 'rpm.assign'
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
