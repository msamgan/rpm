<?php

Route::get('/roles', function () {
    return view('rpm::roles');
})->name('rpm.role.list');
