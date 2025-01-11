<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserRegistryController;
use Illuminate\Support\Facades\Route;

// Default route redirects to login
Route::get('/', function () {
    return view('auth.login');
});

// User Routes
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profileUser'])->name('profileUser.edit');
        Route::patch('/', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [UserProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [UserProfileController::class, 'store'])->name('user.profile.store');
    });
});

// Admin Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'dashboardAdmin'])->name('admin.home');
    Route::prefix('admin/profile')->group(function () {
        Route::get('/', [AdminController::class, 'profileAdmin'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [ProfileController::class, 'store'])->name('admin.profile.store');
    });
    Route::get('/api/user-activity', [UserRegistryController::class, 'getRegistryData']);
});

require __DIR__.'/auth.php';

Auth::routes();