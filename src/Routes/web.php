<?php

/**
 * namespace of the Rpm Controllers.
 */


Route::group(['middleware' => ['web']], function () {

    $controllerNamespace = 'Msamgan\Rpm\Controllers\\';

    include "role.php";
    include "permission_group.php";
    include "permission.php";
    include "assign.php";
});
