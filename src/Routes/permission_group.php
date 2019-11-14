<?php
/**
 * Permission Group Related Routes.
 */
Route::get('/permission-groups', function () {
    return view('rpm::permission.group.list');
})->name('rpm.permission-group.list');

Route::get(
    '/load/permission-groups',
    $controllerNamespace . 'PermissionGroupController@load'
)->name('rpm.permission-group.load.list');

Route::get(
    '/permission-group/{uuid}',
    $controllerNamespace . 'PermissionGroupController@show'
)->name('rpm.permission-group.show');

Route::get(
    '/permission-group/delete/{uuid}',
    $controllerNamespace . 'PermissionGroupController@destroy'
)->name('rpm.permission-group.delete');

Route::post(
    '/store/permission-group',
    $controllerNamespace . 'PermissionGroupController@store'
)->name('rpm.permission-group.store');

Route::post(
    '/update/permission-group/{uuid}',
    $controllerNamespace . 'PermissionGroupController@update'
)->name('rpm.permission-group.update');
