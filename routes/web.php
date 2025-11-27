<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BookingUnitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreSalesController;
use App\Http\Controllers\SpouseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



Route::resource('/users', UserController::class)->middleware(['auth', 'verified', 'role:SuperAdmin,Admin'])->except(['show']);
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

// Pra-Sales Routes
Route::resource('presales', PreSalesController::class);
Route::post('presales/bulk-delete', [PreSalesController::class, 'bulkDelete'])->name('presales.bulk-delete');
Route::post('presales/bulk-export', [PreSalesController::class, 'bulkExport'])->name('presales.bulk-export');

// Spouse Routes
Route::get('spouses/create/{personId}', [SpouseController::class, 'create'])->name('spouses.create');
Route::post('spouses/{personId}', [SpouseController::class, 'store'])->name('spouses.store');
Route::get('spouses/edit/{personId}', [SpouseController::class, 'edit'])->name('spouses.edit');
Route::put('spouses/{personId}', [SpouseController::class, 'update'])->name('spouses.update');

// Booking Unit Routes
Route::resource('booking-units', BookingUnitController::class);
Route::get('booking-units/search/person', [BookingUnitController::class, 'searchPerson'])->name('booking-units.search.person');


// Test routes (remove in production)


require __DIR__.'/auth.php';
