<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('component')->as('component.')->group(function () {
    Route::get('/input', function () {
        return inertia('admin.component.input.index');
    })->name('input');

    Route::get('select2', function () {
        return inertia('admin.component.select2.index');
    })->name('select2');

    Route::get('modal', function () {
        return inertia('admin.component.modal.index');
    })->name('modal');

    Route::get('pagination', function () {
        $users = User::paginate(1);

        $collections = UserResource::collection($users);

        return inertia('admin.component.pagination.index', compact('users', 'collections'));
    })->name('pagination');

    Route::get('sweet-alert', function() {
        return inertia('admin.component.sweet-alert.index');
    })->name('sweet-alert');

    Route::get('card', function () {
        return inertia('admin.component.card.index');
    })->name('card');
});
