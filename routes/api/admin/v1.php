<?php

use App\Http\Controllers\API\Admin\V1\Auth\LoginController;
use App\Http\Controllers\API\Admin\V1\Auth\MeController;
use App\Http\Controllers\API\Admin\V1\Auth\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');
Route::delete('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::middleware('auth:api-admin')->group(function () {
    Route::prefix('auth')->as('auth.')->group(function () {
        Route::get('me', MeController::class)->name('me');
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});