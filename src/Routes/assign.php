<?php
/**
 * Assignment related routes.
 *
 */


Route::get(
    '/assign/{roleUuid}',
    $controllerNamespace . 'AssignController@form'
)->name('rpm.assign');
