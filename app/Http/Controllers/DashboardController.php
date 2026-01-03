<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Room;
use App\Models\DamageReport;
use App\Models\MaintenanceLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Statistik Asset
        $totalAssets = Asset::count();
        $assetsByCondition = Asset::selectRaw('`condition`, COUNT(*) as count')
            ->groupBy('condition')
            ->pluck('count', 'condition')
            ->toArray();

        // Statistik Kategori dan Ruangan
        $totalCategories = Category::count();
        $totalRooms = Room::count();

        // Statistik Laporan Kerusakan
        $totalDamageReports = DamageReport::count();
        $pendingReports = DamageReport::where('status', 'pending')->count();
        $processReports = DamageReport::where('status', 'process')->count();

        // Statistik Perbaikan
        $totalMaintenanceLogs = MaintenanceLog::count();
        $totalMaintenanceCost = MaintenanceLog::sum('cost');
        $monthlyMaintenanceCost = MaintenanceLog::whereMonth('completion_date', now()->month)
            ->whereYear('completion_date', now()->year)
            ->sum('cost');

        // Data Terbaru
        $latestDamageReports = DamageReport::with(['asset', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $latestMaintenanceLogs = MaintenanceLog::with(['asset', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Asset dengan kondisi rusak
        $damagedAssets = Asset::with(['category', 'room'])
            ->whereIn('condition', ['rusak ringan', 'rusak sedang', 'rusak berat'])
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalAssets',
            'assetsByCondition',
            'totalCategories',
            'totalRooms',
            'totalDamageReports',
            'pendingReports',
            'processReports',
            'totalMaintenanceLogs',
            'totalMaintenanceCost',
            'monthlyMaintenanceCost',
            'latestDamageReports',
            'latestMaintenanceLogs',
            'damagedAssets'
        ));
    }
}

