<?php

Route::group(['middleware' => ['web', 'rpm']], function () {

    /**
     * namespace of the Rpm Controllers.
     */
    $controllerNamespace = 'Msamgan\Rpm\Controllers\\';

    include "role.php";
    include "permission_group.php";
    include "permission.php";
    include "assign.php";
});
