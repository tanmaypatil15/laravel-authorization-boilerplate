<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/users/{user}/update-password', [UserController::class, 'updatePassword'])->name('users.update-password');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('/roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermissions'])->name('roles.assignPermissions');
    Route::get('/roles/{role}/users', [RoleController::class, 'users'])->name('roles.users');
    Route::post('/roles/{role}/users', [RoleController::class, 'assignUsers'])->name('roles.assignUsers');

    Route::get('/permissions/{permission}/roles', [PermissionController::class, 'roles'])->name('permissions.roles');
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRoles'])->name('permissions.assignRoles');
    Route::get('/permissions/{permission}/users', [PermissionController::class, 'users'])->name('permissions.users');
    Route::post('/permissions/{permission}/users', [PermissionController::class, 'assignUsers'])->name('permissions.assignUsers');

});



require __DIR__.'/auth.php';
