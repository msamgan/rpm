<?php

/**
 * namespace of the Rpm Controllers.
 */
$controllerNamespace = 'Msamgan\Rpm\Controllers\\';

Route::get('/roles', function () {
    return view('rpm::roles');
})->name('rpm.role.list');

Route::get(
    '/load/roles',
    $controllerNamespace . 'RoleController@load'
)->name('rpm.role.load.list');

Route::post(
    '/store/role',
    $controllerNamespace . 'RoleController@store'
)->name('rpm.role.store');
