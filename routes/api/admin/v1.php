<?php

use App\Http\Controllers\API\Admin\V1\Auth\LoginController;
use App\Http\Controllers\API\Admin\V1\Auth\MeController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');
Route::delete('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::middleware('auth:api-admin')->group(function () {
    Route::get('auth/me', MeController::class)->name('auth.me');
});
