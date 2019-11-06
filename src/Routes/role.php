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

Route::get(
    '/role/delete/{uuid}',
    $controllerNamespace . 'RoleController@destroy'
)->name('rpm.role.delete');

Route::post(
    '/store/role',
    $controllerNamespace . 'RoleController@store'
)->name('rpm.role.store');

Route::post(
    '/update/role/{uuid}',
    $controllerNamespace . 'RoleController@update'
)->name('rpm.role.update');
