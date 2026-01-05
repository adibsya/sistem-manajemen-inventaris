<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-primary-900 dark:text-white leading-tight font-display">
                    Dashboard
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Overview of your inventory status</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-medium px-3 py-1 bg-white dark:bg-slate-800 rounded-full text-slate-500 border border-slate-200 dark:border-slate-700 shadow-sm">
                    {{ now()->format('d M Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 lg:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Charts & Activity Row --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                {{-- Main Chart --}}
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-3xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.05)] border border-slate-100 dark:border-slate-700 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-slate-800 dark:text-white text-lg">Inventory Statistics</h3>
                        <select class="text-xs border-none bg-slate-50 dark:bg-slate-900 rounded-lg text-slate-500 focus:ring-0 cursor-pointer">
                            <option>This Week</option>
                            <option>This Month</option>
                        </select>
                    </div>
                    <div class="h-[250px] w-full">
                        <canvas id="inventoryChart"></canvas>
                    </div>
                </div>

                {{-- Recent Activity / Quick Actions --}}
                <div class="bg-primary-600 dark:bg-slate-800 rounded-3xl shadow-xl shadow-primary-900/10 dark:shadow-none p-6 text-white flex flex-col justify-between overflow-hidden relative">
                    {{-- Decorative Circle --}}
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-primary-500/50 rounded-full blur-xl"></div>

                    <div class="relative z-10">
                        <h3 class="font-bold text-lg mb-1">Quick Actions</h3>
                        <p class="text-white/70 text-sm mb-6">Manage your inventory efficiently</p>
                        
                        <div class="space-y-3">
                            <a href="{{ route('assets.create') }}" class="flex items-center gap-3 p-3 bg-white/10 hover:bg-white/20 rounded-2xl transition border border-white/10 backdrop-blur-sm group">
                                <div class="w-8 h-8 rounded-lg bg-white text-primary-600 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <x-icon name="plus" class="w-4 h-4" />
                                </div>
                                <span class="font-medium text-sm">Add New Asset</span>
                            </a>
                            <a href="{{ route('damage-reports.create') }}" class="flex items-center gap-3 p-3 bg-white/10 hover:bg-white/20 rounded-2xl transition border border-white/10 backdrop-blur-sm group">
                                <div class="w-8 h-8 rounded-lg bg-rose-500 text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <x-icon name="report" class="w-4 h-4" />
                                </div>
                                <span class="font-medium text-sm">Report Damage</span>
                            </a>
                        </div>
                    </div>

                    <div class="relative z-10 mt-6 pt-6 border-t border-white/10">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-white/60 text-xs uppercase tracking-wider font-bold mb-1">Total Assets</p>
                                <p class="text-3xl font-bold">{{ $totalAssets }}</p>
                            </div>
                            <div class="bg-white/20 p-2 rounded-lg">
                                <x-icon name="chart" class="w-5 h-5 text-white" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="font-bold text-slate-800 dark:text-white text-xl mb-6 px-1">Overview Status</h3>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-10">
                {{-- Laporan Pending --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-2xl text-amber-500 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="clock" class="w-6 h-6" />
                        </div>
                        <span class="text-xs font-bold px-2 py-1 bg-slate-50 dark:bg-slate-700 rounded-lg text-slate-500">Pending</span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-slate-800 dark:text-white mb-1">{{ $pendingReports }}</p>
                        <p class="text-sm text-slate-500 font-medium">Laporan Menunggu</p>
                    </div>
                </div>

                {{-- Sedang Diperbaiki --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-primary-50 dark:bg-primary-900/20 rounded-2xl text-primary-500 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="maintenance" class="w-6 h-6" />
                        </div>
                        <span class="text-xs font-bold px-2 py-1 bg-slate-50 dark:bg-slate-700 rounded-lg text-slate-500">Process</span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-slate-800 dark:text-white mb-1">{{ $processReports }}</p>
                        <p class="text-sm text-slate-500 font-medium">Sedang Diperbaiki</p>
                    </div>
                </div>

                {{-- Total Biaya --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl text-emerald-500 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="currency" class="w-6 h-6" />
                        </div>
                        <span class="text-xs font-bold px-2 py-1 bg-slate-50 dark:bg-slate-700 rounded-lg text-slate-500">Cost</span>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-slate-800 dark:text-white mb-1 truncate">Rp {{ number_format($totalMaintenanceCost, 0, ',', '.') }}</p>
                        <p class="text-sm text-slate-500 font-medium">Total Biaya Perbaikan</p>
                    </div>
                </div>

                {{-- Total Assets (Mini) --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-5 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl text-indigo-500 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="boxes" class="w-6 h-6" />
                        </div>
                        <span class="text-xs font-bold px-2 py-1 bg-slate-50 dark:bg-slate-700 rounded-lg text-slate-500">Total</span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-slate-800 dark:text-white mb-1">{{ $totalAssets }}</p>
                        <p class="text-sm text-slate-500 font-medium">Total Aset Tercatat</p>
                    </div>
                </div>
            </div>

            {{-- Recent Activity Table --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 dark:text-white">Recent Maintenance</h3>
                    <a href="{{ route('maintenance-logs.index') }}" class="text-sm text-primary-600 font-medium hover:text-primary-700">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                        <thead class="bg-slate-50 dark:bg-slate-700/50 text-xs uppercase font-semibold text-slate-500">
                            <tr>
                                <th class="px-6 py-4">Asset Name</th>
                                <th class="px-6 py-4">Technician</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Cost</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @forelse($latestMaintenanceLogs as $log)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                        {{ $log->asset->name }}
                                        <div class="text-xs text-slate-400 font-normal">{{ $log->asset->code }}</div>
                                    </td>
                                    <td class="px-6 py-4">{{ $log->technician }}</td>
                                    <td class="px-6 py-4">{{ $log->completion_date ? \Carbon\Carbon::parse($log->completion_date)->format('d M Y') : '-' }}</td>
                                    <td class="px-6 py-4 font-medium">Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Completed</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                        No recent maintenance logs found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('inventoryChart').getContext('2d');
                
                // Mock Data for Chart
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
                const data = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Assets Added',
                            backgroundColor: '#4a70a9', // brand primary
                            borderRadius: 6,
                            data: [12, 19, 3, 5, 2, 3],
                            barThickness: 20,
                        },
                        {
                            label: 'Maintenance',
                            backgroundColor: '#e2e8f0', // slate-200
                            borderRadius: 6,
                            data: [2, 3, 20, 5, 1, 4],
                            barThickness: 20,
                        }
                    ]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: {
                                        family: "'Inter', sans-serif",
                                        size: 11
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    borderDash: [5, 5],
                                    color: '#f0f0f0'
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        }
                    }
                };

                new Chart(ctx, config);
            });
        </script>
    @endpush
</x-app-layout>
