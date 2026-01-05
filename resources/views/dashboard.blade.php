<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-slate-800 dark:text-white leading-tight">
                Dashboard
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Sistem Manajemen Inventaris Sekolah</p>
        </div>
    </x-slot>

    <div class="py-4 lg:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                {{-- Total Asset --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-all duration-300 group h-full">
                    <div class="p-5 sm:p-6 h-full flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-xl bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400 group-hover:scale-105 transition-transform">
                                <x-icon name="cube" class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Total Asset</p>
                                <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $totalAssets }}</p>
                            </div>
                        </div>
                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700">
                            <a href="{{ route('assets.index') }}" class="text-primary-600 dark:text-primary-400 text-sm inline-flex items-center font-medium hover:underline">
                                Lihat semua <x-icon name="chevron-right" class="w-4 h-4 ml-1" />
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Laporan Pending --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-all duration-300 group h-full">
                    <div class="p-5 sm:p-6 h-full flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-xl bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 group-hover:scale-105 transition-transform">
                                <x-icon name="exclamation-triangle" class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Laporan Pending</p>
                                <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $pendingReports }}</p>
                            </div>
                        </div>
                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700">
                            <a href="{{ route('damage-reports.index', ['status' => 'pending']) }}" class="text-amber-600 dark:text-amber-400 text-sm inline-flex items-center font-medium hover:underline">
                                Lihat laporan <x-icon name="chevron-right" class="w-4 h-4 ml-1" />
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Sedang Diperbaiki --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-all duration-300 group h-full">
                    <div class="p-5 sm:p-6 h-full flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-xl bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 group-hover:scale-105 transition-transform">
                                <x-icon name="maintenance" class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Sedang Diperbaiki</p>
                                <p class="text-2xl font-bold text-rose-600 dark:text-rose-400">{{ $processReports }}</p>
                            </div>
                        </div>
                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700">
                            <a href="{{ route('damage-reports.index', ['status' => 'process']) }}" class="text-rose-600 dark:text-rose-400 text-sm inline-flex items-center font-medium hover:underline">
                                Lihat proses <x-icon name="chevron-right" class="w-4 h-4 ml-1" />
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Total Biaya Perbaikan --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-all duration-300 group h-full">
                    <div class="p-5 sm:p-6 h-full flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 group-hover:scale-105 transition-transform">
                                <x-icon name="currency" class="w-6 h-6" />
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Total Biaya</p>
                                <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($totalMaintenanceCost, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700">
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Bulan ini: <span class="font-semibold text-slate-700 dark:text-slate-300">Rp {{ number_format($monthlyMaintenanceCost, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Statistik Kondisi Asset --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <h3 class="font-bold text-slate-800 dark:text-white mb-4 flex items-center">
                            <span class="w-1 h-5 bg-amber-500 rounded-full mr-3"></span>
                            Kondisi Asset
                        </h3>
                        <div class="space-y-2">
                            @php
                                $conditionConfig = [
                                    'bagus' => ['bg' => 'bg-emerald-500', 'light' => 'bg-emerald-100 dark:bg-emerald-900/30', 'text' => 'text-emerald-700 dark:text-emerald-300'],
                                    'rusak ringan' => ['bg' => 'bg-amber-500', 'light' => 'bg-amber-100 dark:bg-amber-900/30', 'text' => 'text-amber-700 dark:text-amber-300'],
                                    'rusak sedang' => ['bg' => 'bg-orange-500', 'light' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-700 dark:text-orange-300'],
                                    'rusak berat' => ['bg' => 'bg-rose-500', 'light' => 'bg-rose-100 dark:bg-rose-900/30', 'text' => 'text-rose-700 dark:text-rose-300'],
                                    'hilang' => ['bg' => 'bg-slate-500', 'light' => 'bg-slate-100 dark:bg-slate-700', 'text' => 'text-slate-700 dark:text-slate-300'],
                                    'diperbaiki' => ['bg' => 'bg-primary-500', 'light' => 'bg-primary-100 dark:bg-primary-900/30', 'text' => 'text-primary-700 dark:text-primary-300'],
                                ];
                            @endphp
                            @foreach($conditionConfig as $condition => $config)
                                <div class="flex items-center justify-between py-2.5 px-3 rounded-lg {{ $config['light'] }} transition">
                                    <div class="flex items-center">
                                        <div class="w-2.5 h-2.5 rounded-full {{ $config['bg'] }} mr-3"></div>
                                        <span class="text-sm {{ $config['text'] }} font-medium">{{ ucfirst($condition) }}</span>
                                    </div>
                                    <span class="font-bold {{ $config['text'] }}">{{ $assetsByCondition[$condition] ?? 0 }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <h3 class="font-bold text-slate-800 dark:text-white mb-4 flex items-center">
                            <span class="w-1 h-5 bg-primary-500 rounded-full mr-3"></span>
                            Ringkasan
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-3 px-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                <span class="text-slate-600 dark:text-slate-300 flex items-center gap-2">
                                    <x-icon name="category" class="w-4 h-4 text-slate-400" />
                                    Total Kategori
                                </span>
                                <span class="font-bold text-primary-600 dark:text-primary-400">{{ $totalCategories }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                <span class="text-slate-600 dark:text-slate-300 flex items-center gap-2">
                                    <x-icon name="room" class="w-4 h-4 text-slate-400" />
                                    Total Ruangan
                                </span>
                                <span class="font-bold text-primary-600 dark:text-primary-400">{{ $totalRooms }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                <span class="text-slate-600 dark:text-slate-300 flex items-center gap-2">
                                    <x-icon name="report" class="w-4 h-4 text-slate-400" />
                                    Total Laporan
                                </span>
                                <span class="font-bold text-rose-600 dark:text-rose-400">{{ $totalDamageReports }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 px-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                <span class="text-slate-600 dark:text-slate-300 flex items-center gap-2">
                                    <x-icon name="maintenance" class="w-4 h-4 text-slate-400" />
                                    Total Perbaikan
                                </span>
                                <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $totalMaintenanceLogs }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <h3 class="font-bold text-slate-800 dark:text-white mb-4 flex items-center">
                            <span class="w-1 h-5 bg-rose-500 rounded-full mr-3"></span>
                            Menu Cepat
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('assets.create') }}" class="p-4 bg-primary-50 dark:bg-primary-900/20 rounded-xl text-center hover:bg-primary-100 dark:hover:bg-primary-900/40 transition border border-primary-200 dark:border-primary-800 group">
                                <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/50 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                                    <x-icon name="cube" class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                                </div>
                                <span class="text-primary-700 dark:text-primary-300 text-sm font-medium">Asset Baru</span>
                            </a>
                            <a href="{{ route('damage-reports.create') }}" class="p-4 bg-rose-50 dark:bg-rose-900/20 rounded-xl text-center hover:bg-rose-100 dark:hover:bg-rose-900/40 transition border border-rose-200 dark:border-rose-800 group">
                                <div class="w-10 h-10 bg-rose-100 dark:bg-rose-900/50 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                                    <x-icon name="report" class="w-5 h-5 text-rose-600 dark:text-rose-400" />
                                </div>
                                <span class="text-rose-700 dark:text-rose-300 text-sm font-medium">Laporan</span>
                            </a>
                            <a href="{{ route('maintenance-logs.create') }}" class="p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-center hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition border border-emerald-200 dark:border-emerald-800 group">
                                <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                                    <x-icon name="maintenance" class="w-5 h-5 text-emerald-600 dark:text-emerald-400" />
                                </div>
                                <span class="text-emerald-700 dark:text-emerald-300 text-sm font-medium">Perbaikan</span>
                            </a>
                            <a href="{{ route('categories.index') }}" class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-xl text-center hover:bg-amber-100 dark:hover:bg-amber-900/40 transition border border-amber-200 dark:border-amber-800 group">
                                <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/50 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                                    <x-icon name="category" class="w-5 h-5 text-amber-600 dark:text-amber-400" />
                                </div>
                                <span class="text-amber-700 dark:text-amber-300 text-sm font-medium">Kategori</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Data Terbaru --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Laporan Kerusakan Terbaru --}}
                <div class="bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-slate-800 dark:text-white flex items-center">
                                <span class="w-1 h-5 bg-rose-500 rounded-full mr-3"></span>
                                Laporan Kerusakan Terbaru
                            </h3>
                            <a href="{{ route('damage-reports.index') }}" class="text-primary-600 dark:text-primary-400 text-sm hover:underline font-medium">Lihat semua</a>
                        </div>
                        @if($latestDamageReports->count() > 0)
                            <div class="space-y-3">
                                @foreach($latestDamageReports as $report)
                                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                                        <div>
                                            <p class="font-medium text-sm text-slate-800 dark:text-white">{{ $report->asset->name }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $report->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($report->status === 'pending') bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300
                                            @elseif($report->status === 'process') bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300
                                            @elseif($report->status === 'fixed') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300
                                            @else bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300
                                            @endif">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <x-icon name="report" class="w-12 h-12 text-slate-300 dark:text-slate-600 mx-auto mb-3" />
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Belum ada laporan kerusakan.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Riwayat Perbaikan Terbaru --}}
                <div class="bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-slate-800 dark:text-white flex items-center">
                                <span class="w-1 h-5 bg-emerald-500 rounded-full mr-3"></span>
                                Perbaikan Terbaru
                            </h3>
                            <a href="{{ route('maintenance-logs.index') }}" class="text-primary-600 dark:text-primary-400 text-sm hover:underline font-medium">Lihat semua</a>
                        </div>
                        @if($latestMaintenanceLogs->count() > 0)
                            <div class="space-y-3">
                                @foreach($latestMaintenanceLogs as $log)
                                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                                        <div>
                                            <p class="font-medium text-sm text-slate-800 dark:text-white">{{ $log->asset->name }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ Str::limit($log->action_taken, 30) }}</p>
                                        </div>
                                        <span class="text-emerald-600 dark:text-emerald-400 font-bold text-sm">
                                            Rp {{ number_format($log->cost, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <x-icon name="maintenance" class="w-12 h-12 text-slate-300 dark:text-slate-600 mx-auto mb-3" />
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Belum ada riwayat perbaikan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Asset Rusak --}}
            @if($damagedAssets->count() > 0)
                <div class="bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 mt-6">
                    <div class="p-4 sm:p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-rose-600 dark:text-rose-400 flex items-center text-sm sm:text-base">
                                <x-icon name="exclamation-triangle" class="w-5 h-5 mr-2" />
                                Asset Perlu Perhatian
                            </h3>
                            <a href="{{ route('assets.index', ['condition' => 'rusak ringan']) }}" class="text-primary-600 dark:text-primary-400 text-sm hover:underline font-medium">Lihat semua</a>
                        </div>
                        
                        {{-- Mobile Card View --}}
                        <div class="sm:hidden space-y-3">
                            @foreach($damagedAssets as $asset)
                                <div class="bg-slate-50 dark:bg-slate-700/50 rounded-lg p-3">
                                    <div class="flex items-start justify-between gap-2 mb-2">
                                        <div class="min-w-0 flex-1">
                                            <span class="text-xs font-mono text-slate-500 dark:text-slate-400">{{ $asset->code }}</span>
                                            <p class="font-medium text-sm text-slate-800 dark:text-white truncate">{{ $asset->name }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $asset->room->name }}</p>
                                        </div>
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium flex-shrink-0
                                            @if($asset->condition === 'rusak ringan') bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300
                                            @elseif($asset->condition === 'rusak sedang') bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300
                                            @else bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300
                                            @endif">
                                            {{ ucfirst($asset->condition) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('damage-reports.create', ['asset_id' => $asset->id]) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-medium rounded-lg transition w-full justify-center">
                                        <x-icon name="plus" class="w-3.5 h-3.5 mr-1" />
                                        Buat Laporan
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{-- Desktop Table View --}}
                        <div class="hidden sm:block overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-slate-800 dark:bg-slate-900 text-white">
                                        <th class="px-3 lg:px-4 py-3 text-left text-xs font-semibold uppercase rounded-tl-lg">Kode</th>
                                        <th class="px-3 lg:px-4 py-3 text-left text-xs font-semibold uppercase">Nama</th>
                                        <th class="px-3 lg:px-4 py-3 text-left text-xs font-semibold uppercase hidden md:table-cell">Ruangan</th>
                                        <th class="px-3 lg:px-4 py-3 text-left text-xs font-semibold uppercase">Kondisi</th>
                                        <th class="px-3 lg:px-4 py-3 text-left text-xs font-semibold uppercase rounded-tr-lg">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                                    @foreach($damagedAssets as $asset)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                            <td class="px-3 lg:px-4 py-3 text-xs font-mono text-slate-700 dark:text-slate-300">{{ $asset->code }}</td>
                                            <td class="px-3 lg:px-4 py-3 text-sm font-medium text-slate-800 dark:text-white">{{ $asset->name }}</td>
                                            <td class="px-3 lg:px-4 py-3 text-sm text-slate-600 dark:text-slate-400 hidden md:table-cell">{{ $asset->room->name }}</td>
                                            <td class="px-3 lg:px-4 py-3">
                                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                                    @if($asset->condition === 'rusak ringan') bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300
                                                    @elseif($asset->condition === 'rusak sedang') bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300
                                                    @else bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300
                                                    @endif">
                                                    {{ ucfirst($asset->condition) }}
                                                </span>
                                            </td>
                                            <td class="px-3 lg:px-4 py-3">
                                                <a href="{{ route('damage-reports.create', ['asset_id' => $asset->id]) }}" 
                                                   class="inline-flex items-center px-2 lg:px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-medium rounded-lg transition">
                                                    <x-icon name="plus" class="w-3.5 h-3.5 lg:mr-1" />
                                                    <span class="hidden lg:inline">Buat Laporan</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
