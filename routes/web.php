<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Properties routes
Route::resource('properties', PropertyController::class);
Route::get('/landlord/dashboard', [PropertyController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('landlord.dashboard');

// Admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // Property management
    Route::get('/properties', [App\Http\Controllers\AdminController::class, 'properties'])
        ->name('admin.properties');
    Route::get('/properties/{property}', [App\Http\Controllers\AdminController::class, 'showProperty'])
        ->name('admin.properties.show');
    Route::patch('/properties/{property}/status', [App\Http\Controllers\AdminController::class, 'updatePropertyStatus'])
        ->name('admin.properties.update-status');
    Route::delete('/properties/{property}', [App\Http\Controllers\AdminController::class, 'deleteProperty'])
        ->name('admin.properties.destroy');
    
    // User management
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])
        ->name('admin.users');
    Route::get('/users/{user}', [App\Http\Controllers\AdminController::class, 'showUser'])
        ->name('admin.users.show');
    Route::patch('/users/{user}/role', [App\Http\Controllers\AdminController::class, 'updateUserRole'])
        ->name('admin.users.update-role');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])
        ->name('admin.users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
