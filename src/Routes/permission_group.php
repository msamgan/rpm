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
