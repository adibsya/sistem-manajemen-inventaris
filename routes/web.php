<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DamageReportController;
use App\Http\Controllers\MaintenanceLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =============================================
    // ROUTES - Sistem Manajemen Inventaris
    // =============================================
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // =============================================
    // ADMIN & TEKNISI - Kelola Master Data
    // =============================================
    Route::middleware('role:admin,teknisi')->group(function () {
        // Categories - Kelola kategori barang
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
        
        // Rooms - Kelola data ruangan
        Route::resource('rooms', RoomController::class)->except(['index', 'show']);
        
        // Assets - Kelola data barang (create, edit, delete)
        Route::resource('assets', AssetController::class)->except(['index', 'show']);
    });

    // =============================================
    // SEMUA USER YANG LOGIN - Lihat Data
    // =============================================
    // Semua user bisa melihat daftar dan detail
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    
    Route::get('rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    
    Route::get('assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('assets/{asset}', [AssetController::class, 'show'])->name('assets.show');

    // =============================================
    // SEMUA USER - Laporan Kerusakan (Create, View)
    // =============================================
    Route::get('damage-reports', [DamageReportController::class, 'index'])->name('damage-reports.index');
    Route::get('damage-reports/create', [DamageReportController::class, 'create'])->name('damage-reports.create');
    Route::post('damage-reports', [DamageReportController::class, 'store'])->name('damage-reports.store');
    Route::get('damage-reports/{damage_report}', [DamageReportController::class, 'show'])->name('damage-reports.show');

    // =============================================
    // ADMIN & TEKNISI - Update/Hapus Laporan & Perbaikan
    // =============================================
    Route::middleware('role:admin,teknisi')->group(function () {
        // Edit dan hapus laporan kerusakan
        Route::get('damage-reports/{damage_report}/edit', [DamageReportController::class, 'edit'])->name('damage-reports.edit');
        Route::put('damage-reports/{damage_report}', [DamageReportController::class, 'update'])->name('damage-reports.update');
        Route::delete('damage-reports/{damage_report}', [DamageReportController::class, 'destroy'])->name('damage-reports.destroy');
        
        // Maintenance Logs - Full access
        Route::resource('maintenance-logs', MaintenanceLogController::class);
    });
});

require __DIR__.'/auth.php';

