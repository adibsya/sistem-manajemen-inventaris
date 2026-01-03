<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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
    
    // Assets - Kelola data barang inventaris
    Route::resource('assets', AssetController::class);
    
    // Categories - Kelola kategori barang (Komputer, Meja, dll)
    Route::resource('categories', CategoryController::class);
    
    // Rooms - Kelola data ruangan
    Route::resource('rooms', RoomController::class);
    
    // Damage Reports - Laporan kerusakan barang
    Route::resource('damage-reports', DamageReportController::class);
    
    // Maintenance Logs - Riwayat perbaikan barang
    Route::resource('maintenance-logs', MaintenanceLogController::class);
});

require __DIR__.'/auth.php';
