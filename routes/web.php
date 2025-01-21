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
use App\Http\Controllers\QuestionnaireController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;

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
Route::middleware(['auth', 'verified'])->group(function () {
    // User Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Alumni Register Routes
    Route::prefix('alumni')->group(function () {
        Route::get('/register', [AlumniRegisterController::class, 'showRegistrationForm'])->name('alumni.register');
        Route::post('/register', [AlumniRegisterController::class, 'register'])->name('alumni.store');
    });

    // Password Reset Routes - Fix the duplicate and conflicting route
    Route::put('/profile/password', [App\Http\Controllers\Auth\UserPasswordController::class, 'update'])
        ->name('password.update');

    // User Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profileUser'])->name('profileUser.edit');
        Route::patch('/', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [UserProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [UserProfileController::class, 'store'])->name('user.profile.store');
    });

    // Questionnaire Routes
    Route::prefix('questionnaire')->group(function () {
        Route::get('/', [QuestionnaireController::class, 'index'])->name('questionnaire.index');
        Route::post('/tracer-kerja', [QuestionnaireController::class, 'storeTracerKerja'])->name('questionnaire.store.kerja');
        Route::post('/tracer-kuliah', [QuestionnaireController::class, 'storeTracerKuliah'])->name('questionnaire.store.kuliah');
        Route::post('/testimoni', [QuestionnaireController::class, 'storeTestimoni'])->name('questionnaire.store.testimoni');
    });
});

// Admin Routes
Route::middleware(['auth', 'verified', 'user-access:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/home', [AdminController::class, 'dashboardAdmin'])->name('admin.home');

    // Password Reset Routes
    Route::put('admin/password', [App\Http\Controllers\Auth\AdminPasswordController::class, 'update'])
        ->name('admin.password.update');
    
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

    // Alumni Management Routes
    Route::prefix('admin/alumni')->name('admin.alumni.')->group(function () {
        Route::get('/', [AdminController::class, 'alumniIndex'])->name('index');
        Route::get('/{alumni}', [AdminController::class, 'alumniShow'])->name('show');
    });

    Route::get('/api/tracer/bentuk-lembaga-stats', function() {
        return App\Models\TracerKerja::getBentukLembagaStats();
    })->name('api.tracer.bentuk-lembaga-stats');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])
        ->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    // Register Routes
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});