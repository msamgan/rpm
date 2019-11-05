<?php
/**
 * Role Related Routes.
 */


Route::get('/roles', function () {
    return view('rpm::roles');
})->name('rpm.role.list');

Route::get(
    '/load/roles',
    $controllerNamespace . 'RoleController@load'
)->name('rpm.role.load.list');

Route::get(
    '/role/{uuid}',
    $controllerNamespace . 'RoleController@show'
)->name('rpm.role.show');

Route::post(
    '/store/role',
    $controllerNamespace . 'RoleController@store'
)->name('rpm.role.store');

Route::post(
    '/update/role/{uuid}',
    $controllerNamespace . 'RoleController@update'
)->name('rpm.role.update');
