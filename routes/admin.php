<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return inertia('admin.auth.login');
})->name('login');

Route::get('login-2', function () {
    return inertia('admin.auth.login-2');
})->name('login-2');

Route::post('login', [LoginController::class, 'login']);
Route::delete('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return inertia('admin.dashboard.index');
})->name('dashboard');

Route::get('select2', function () {
    return inertia('admin.select2.index');
})->name('select2');

Route::get('modal', function () {
    return inertia('admin.modal.index');
})->name('modal');

Route::get('selector', function () {
    return inertia('admin.selector.index');
})->name('selector');
