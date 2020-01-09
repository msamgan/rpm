<?php

use Illuminate\Database\Migrations\Migration;
use Msamgan\Rpm\Models\RolePermission;

class AddDefaultRolePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        RolePermission::query()->create([
            'role_id' => 1,
            'permission_id' => 1
        ]);

        RolePermission::query()->create([
            'role_id' => 1,
            'permission_id' => 2
        ]);

        RolePermission::query()->create([
            'role_id' => 1,
            'permission_id' => 3
        ]);

        RolePermission::query()->create([
            'role_id' => 1,
            'permission_id' => 4
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
