<?php

use App\Http\Controllers\API\Admin\V1\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::delete('/logout', [LoginController::class, 'logout'])->name('logout');
