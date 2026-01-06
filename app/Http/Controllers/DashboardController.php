<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Room;
use App\Models\DamageReport;
use App\Models\MaintenanceLog;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Cache dashboard statistics for 10 minutes
        $statistics = Cache::remember('dashboard_statistics', 600, function () {
            return [
                'totalAssets' => Asset::count(),
                'assetsByCondition' => Asset::selectRaw('`condition`, COUNT(*) as count')
                    ->groupBy('condition')
                    ->pluck('count', 'condition')
                    ->toArray(),
                'totalCategories' => Category::count(),
                'totalRooms' => Room::count(),
                'totalDamageReports' => DamageReport::count(),
                'pendingReports' => DamageReport::where('status', 'pending')->count(),
                'processReports' => DamageReport::where('status', 'process')->count(),
                'totalMaintenanceLogs' => MaintenanceLog::count(),
                'totalMaintenanceCost' => MaintenanceLog::sum('cost'),
                'monthlyMaintenanceCost' => MaintenanceLog::whereMonth('completion_date', now()->month)
                    ->whereYear('completion_date', now()->year)
                    ->sum('cost'),
            ];
        });

        // Recent data - cache for 2 minutes since it changes more frequently
        $latestDamageReports = Cache::remember('dashboard_latest_damage_reports', 120, function () {
            return DamageReport::with(['asset', 'user'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        });

        $latestMaintenanceLogs = Cache::remember('dashboard_latest_maintenance_logs', 120, function () {
            return MaintenanceLog::with(['asset', 'user'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        });

        $damagedAssets = Cache::remember('dashboard_damaged_assets', 300, function () {
            return Asset::with(['category', 'room'])
                ->whereIn('condition', ['rusak ringan', 'rusak sedang', 'rusak berat'])
                ->take(5)
                ->get();
        });

        return view('dashboard', array_merge($statistics, [
            'latestDamageReports' => $latestDamageReports,
            'latestMaintenanceLogs' => $latestMaintenanceLogs,
            'damagedAssets' => $damagedAssets,
        ]));
    }

    /**
     * Clear dashboard cache
     * Call this method when data changes
     */
    public static function clearCache(): void
    {
        Cache::forget('dashboard_statistics');
        Cache::forget('dashboard_latest_damage_reports');
        Cache::forget('dashboard_latest_maintenance_logs');
        Cache::forget('dashboard_damaged_assets');
    }
}

