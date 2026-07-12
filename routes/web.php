<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EsgController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.store');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [EsgController::class, 'dashboard'])->name('dashboard');
    Route::post('/scores/recalculate', [EsgController::class, 'scores'])->name('scores.recalculate');
    Route::get('/modules/{module}', [EsgController::class, 'index'])->name('modules.index');
    Route::post('/modules/{module}', [EsgController::class, 'store'])->name('modules.store');
    Route::get('/employee-activities', [EsgController::class, 'activities'])->name('activities.index');
    Route::post('/employee-activities', [EsgController::class, 'joinActivity'])->name('activities.join');
    Route::post('/employee-activities/{id}/approve', [EsgController::class, 'approveActivity'])->name('activities.approve');
    Route::get('/reports/{type}', [EsgController::class, 'reports'])->name('reports.download');
    Route::get('/contact', [EsgController::class, 'contact'])->name('contact.show');
    Route::post('/contact', [EsgController::class, 'storeContact'])->name('contact.store');
    Route::get('/about', [EsgController::class, 'about'])->name('about.show');
     Route::get('/mission', [EsgController::class, 'mission'])->name('mission.show');
      Route::get('/documentation', [EsgController::class, 'documentation'])->name('documentation.show');
      Route::get('/reports', [EsgController::class, 'EGreports'])->name('EGreports.show');
      Route::get('/faq', [EsgController::class, 'faq'])->name('faq.show');
       Route::get('/userquide', [EsgController::class, 'userquide'])->name('userquide.show');
       Route::get('/privacy-policy', [EsgController::class, 'privacy_policy'])->name('privacy-policy.show');
        Route::get('/terms', [EsgController::class, 'terms'])->name('terms.show');
        Route::get('/data-protection', [EsgController::class, 'data_protection'])->name('data-protection.show');
});
