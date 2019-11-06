<?php
/**
 * Permission Related Routes.
 */
Route::get('/permissions', function () {
    return view('rpm::permission.permission.list');
})->name('rpm.permission.list');
