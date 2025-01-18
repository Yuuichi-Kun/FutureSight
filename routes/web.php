<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AlumniRegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserRegistryController;
use App\Http\Controllers\Admin\BidangKeahlianController;
use App\Http\Controllers\Admin\ProgramKeahlianController;
use App\Http\Controllers\Admin\KonsentrasiKeahlianController;
use App\Http\Controllers\Admin\TahunLulusController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Default route should not require authentication
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Authentication Routes with Email Verification
Auth::routes(['verify' => true]);

// Email Verification Routes
Route::group(['middleware' => ['auth']], function() {
    Route::get('/email/verify', function () { 
        return view('auth.verify');
    })->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['signed'])->name('verification.verify');
});

// User Routes
Route::middleware(['auth', 'verified', 'user-access:user'])->group(function () {
    // User Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Password Reset Routes
    Route::post('password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])
    ->name('password.update');
    
    // Alumni Register Routes
    Route::prefix('register')->group(function () {
        Route::get('/', [AlumniRegisterController::class, 'showRegistrationForm'])->name('alumni.register');
        Route::post('/', [AlumniRegisterController::class, 'register']);
    });
    
    // User Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profileUser'])->name('profileUser.edit');
        Route::patch('/', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [UserProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [UserProfileController::class, 'store'])->name('user.profile.store');
    });
});

// Admin Routes
Route::middleware(['auth', 'verified', 'user-access:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/home', [AdminController::class, 'dashboardAdmin'])->name('admin.home');

    // Password Reset Routes
    Route::post('password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])
    ->name('password.update');
    
    // Admin Profile Routes
    Route::prefix('admin/profile')->group(function () {
        Route::get('/', [AdminController::class, 'profileAdmin'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
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