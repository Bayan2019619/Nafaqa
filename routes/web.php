<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileRoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('profile-roles', ProfileRoleController::class);
    Route::resource('users', UserController::class);
    Route::patch('/profile-roles/{profileRole}/toggle-status', [ProfileRoleController::class, 'toggleStatus'])->name('profile-roles.toggle-status');

});

require __DIR__.'/auth.php';
