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
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ForumMonitoringController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\SchoolProfileController;
use App\Http\Controllers\ContactController;

// Default route should not require authentication
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Authentication Routes (without email verification)
Auth::routes();

// Email Verification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// User Routes (remove verified middleware)
Route::middleware(['auth'])->group(function () {
    // User Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Alumni Register Routes
    Route::prefix('alumni')->group(function () {
        Route::get('/register', [AlumniRegisterController::class, 'showRegistrationForm'])->name('alumni.register');
        Route::post('/register', [AlumniRegisterController::class, 'register'])->name('alumni.store');
    });

    // Forum Routes
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::post('/forum/{forum}/comment', [ForumController::class, 'storeComment'])->name('forum.comment');
    Route::put('/forum/comment/{comment}', [ForumController::class, 'updateComment'])->name('forum.comment.update');
    Route::delete('/forum/comment/{comment}', [ForumController::class, 'destroyComment'])->name('forum.comment.destroy');

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
    Route::middleware(['auth', 'approved.alumni'])->prefix('questionnaire')->group(function () {
        Route::get('/', [QuestionnaireController::class, 'index'])->name('questionnaire.index');
        Route::post('/tracer-kerja', [QuestionnaireController::class, 'storeTracerKerja'])->name('questionnaire.store.kerja');
        Route::post('/tracer-kuliah', [QuestionnaireController::class, 'storeTracerKuliah'])->name('questionnaire.store.kuliah');
        Route::post('/testimoni', [QuestionnaireController::class, 'storeTestimoni'])->name('questionnaire.store.testimoni');
    });

    // Message Routes
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/unread/count', [MessageController::class, 'getUnreadCount'])->name('messages.unread.count');

    // Add this new route for viewing other user's profile
    Route::get('/users/{user}/profile', [UserController::class, 'showProfile'])->name('users.profile');

    // Add this new route
    Route::get('/school-profile', [SchoolProfileController::class, 'index'])->name('school.profile');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
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
        Route::patch('/', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
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

    Route::get('/api/tracer/bentuk-lembaga-stats', function () {
        return App\Models\TracerKerja::getBentukLembagaStats();
    })->name('api.tracer.bentuk-lembaga-stats');

    // Forum Monitoring Routes
    Route::get('/admin/forum-monitoring', [AdminController::class, 'forumMonitoring'])
        ->name('admin.forum.monitoring');
    Route::post('/admin/forum/warn/{user}', [AdminController::class, 'warnUser'])
        ->name('admin.forum.warn');
    Route::post('/admin/forum/ban/{user}', [AdminController::class, 'banUser'])
        ->name('admin.forum.ban');
    Route::post('/admin/forum/{user}/unban', [AdminController::class, 'unbanUser'])->name('admin.forum.unban');
    Route::post('/admin/forum/clear-activities', [ForumMonitoringController::class, 'clearActivities'])
        ->name('admin.forum.clear-activities');

    // Admin Messages
    Route::controller(MessageController::class)->group(function () {
        Route::get('/admin/messages', 'adminIndex')->name('admin.messages.index');
        Route::get('/admin/messages/{user}', 'adminShow')->name('admin.messages.show');
        Route::post('/admin/messages/{user}', 'adminStore')->name('admin.messages.store');
    });

    // Alumni Approval Routes
    Route::get('/alumni-approvals', [AdminController::class, 'alumniApprovals'])->name('alumni.approvals');
    Route::post('/alumni-approve/{user}', [AdminController::class, 'approveAlumni'])->name('alumni.approve');
    Route::post('/alumni-reject/{user}', [AdminController::class, 'rejectAlumni'])->name('alumni.reject');

    // Add inside admin routes group
    Route::prefix('admin')->group(function () {
        Route::get('/school', [SchoolController::class, 'index'])->name('admin.school.index');
        Route::post('/school', [SchoolController::class, 'store'])->name('admin.school.store');
        Route::put('/school/{school}', [SchoolController::class, 'update'])->name('admin.school.update');
    });
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

