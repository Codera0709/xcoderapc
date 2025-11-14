<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/components-demo', [DashboardController::class, 'componentsDemo'])->middleware(['auth', 'verified'])->name('components.demo');

Route::get('/forms-demo', [DashboardController::class, 'formsDemo'])->middleware(['auth', 'verified'])->name('forms.demo');

Route::get('/data-demo', [DashboardController::class, 'dataDemo'])->middleware(['auth', 'verified'])->name('data.demo');

Route::get('/interactive-demo', [DashboardController::class, 'interactiveDemo'])->middleware(['auth', 'verified'])->name('interactive.demo');

Route::get('/feedback-demo', [DashboardController::class, 'feedbackDemo'])->middleware(['auth', 'verified'])->name('feedback.demo');

Route::resource('/users', UserController::class)->middleware(['auth', 'verified'])->except(['show']);
Route::get('/settings', [SettingController::class, 'index'])->middleware(['auth', 'verified'])->name('settings.index');
Route::post('/settings/profile', [SettingController::class, 'updateProfile'])->middleware(['auth', 'verified'])->name('settings.profile.update');
Route::post('/settings/account', [SettingController::class, 'updateAccount'])->middleware(['auth', 'verified'])->name('settings.account.update');
Route::post('/settings/security', [SettingController::class, 'updateSecurity'])->middleware(['auth', 'verified'])->name('settings.security.update');
Route::post('/settings/notifications', [SettingController::class, 'updateNotifications'])->middleware(['auth', 'verified'])->name('settings.notifications.update');
Route::post('/settings/appearance', [SettingController::class, 'updateAppearance'])->middleware(['auth', 'verified'])->name('settings.appearance.update');
Route::get('/reports', [ReportController::class, 'index'])->middleware(['auth', 'verified'])->name('reports.index');
Route::get('/analytics', [AnalyticsController::class, 'index'])->middleware(['auth', 'verified'])->name('analytics.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
