<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserRegistryController;
use App\Http\Controllers\Admin\BidangKeahlianController;
use App\Http\Controllers\Admin\ProgramKeahlianController;
use App\Http\Controllers\Admin\KonsentrasiKeahlianController;
use App\Http\Controllers\Admin\TahunLulusController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Default route redirects to login
Route::get('/', function () {
    return view('auth.login');
});

// User Routes
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // User Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profileUser'])->name('profileUser.edit');
        Route::patch('/', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [UserProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [UserProfileController::class, 'store'])->name('user.profile.store');
    });
});

// Admin Routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/home', [AdminController::class, 'dashboardAdmin'])->name('admin.home');
    
    // Admin Profile Routes
    Route::prefix('admin/profile')->group(function () {
        Route::get('/', [AdminController::class, 'profileAdmin'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('rofile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [ProfileController::class, 'store'])->name('admin.profile.store');
    });
    
    // Bidang Keahlian Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('bidang-keahlian', BidangKeahlianController::class);
        Route::resource('program-keahlian', ProgramKeahlianController::class);
        Route::resource('konsentrasi-keahlian', KonsentrasiKeahlianController::class);
        Route::resource('tahun-lulus', TahunLulusController::class);
    });
    
    // User Registry API Route
    Route::get('/api/user-activity', [UserRegistryController::class, 'getRegistryData']);
});

// Authentication Routes
require __DIR__.'/auth.php';
Auth::routes();