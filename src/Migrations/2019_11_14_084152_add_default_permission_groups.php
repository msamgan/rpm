<?php

use Illuminate\Database\Migrations\Migration;
use Msamgan\Rpm\Models\PermissionGroup;

class AddDefaultPermissionGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PermissionGroup::query()->create([
            'name' => 'Roles',
            'Description' => 'Holding Permissions regarding all the Roles related work'
        ]);

        PermissionGroup::query()->create([
            'name' => 'Permissions',
            'Description' => 'Holding Permissions regarding all the Permissions related work'
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
