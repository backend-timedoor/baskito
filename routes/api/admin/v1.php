<?php

use App\Http\Controllers\API\Admin\V1\Admin\AdminController;
use App\Http\Controllers\API\Admin\V1\Admin\AdminRoleController;
use App\Http\Controllers\API\Admin\V1\Auth\ChangePasswordController;
use App\Http\Controllers\API\Admin\V1\Auth\CheckPermissionController;
use App\Http\Controllers\API\Admin\V1\Auth\LoginController;
use App\Http\Controllers\API\Admin\V1\Auth\MeController;
use App\Http\Controllers\API\Admin\V1\Auth\ProfileController;
use App\Http\Controllers\API\Admin\V1\Auth\UserPermissionController;
use App\Http\Controllers\API\APIDocController;
use Illuminate\Support\Facades\Route;

APIDocController::registerRoute('docs/api/admin/api-v1.yaml', true);

Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');
Route::delete('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::middleware('auth:api-admin')->group(function () {
    Route::prefix('auth')->as('auth.')->group(function () {
        Route::get('me', MeController::class)->name('me');
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('password', ChangePasswordController::class)->name('password.update');
        Route::get('permission', [UserPermissionController::class, 'index'])->name('permission.index');
        Route::post('permission/check', CheckPermissionController::class)->name('permission.check');
    });

    Route::get('admin/role', [AdminRoleController::class, 'index'])->name('admin.role.index');
    Route::apiResource('admin', AdminController::class);
});
