<?php
/**
 * Assignment related routes.
 *
 */


Route::get(
    '/assign/{roleUuid}',
    $controllerNamespace . 'AssignController@form'
)->name('rpm.assign')->middleware('rpm');

Route::post(
    '/assign/{roleUuid}',
    $controllerNamespace . 'AssignController@store'
)->name('rpm.assign.store');
