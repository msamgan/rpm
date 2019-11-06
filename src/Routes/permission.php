<?php
/**
 * Permission Related Routes.
 */
Route::get('/permissions', function () {
    return view('rpm::permission.permission.list');
})->name('rpm.permission.list');

Route::get(
    '/load/permissions',
    $controllerNamespace . 'PermissionController@load'
)->name('rpm.permission.load.list');

Route::get(
    '/permission/{uuid}',
    $controllerNamespace . 'PermissionController@show'
)->name('rpm.permission.show');

Route::get(
    '/permission/delete/{uuid}',
    $controllerNamespace . 'PermissionController@destroy'
)->name('rpm.permission.delete');

Route::post(
    '/store/permission',
    $controllerNamespace . 'PermissionController@store'
)->name('rpm.permission.store');

Route::post(
    '/update/permission/{uuid}',
    $controllerNamespace . 'PermissionController@update'
)->name('rpm.permission.update');

