<?php
/**
 * Permission Group Related Routes.
 */
Route::get('/permission-groups', function () {
    return view('rpm::permission.group');
})->name('rpm.permission-group.list');
