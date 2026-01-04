<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-brand-blue leading-tight">
                Dashboard
            </h2>
            <p class="text-sm text-gray-500 mt-1">Sistem Manajemen Inventaris Sekolah</p>
        </div>
    </x-slot>

    <div class="py-4 lg:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">
                {{-- Total Asset --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm border-l-4 border-brand-blue hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-brand-blue/10 text-brand-blue">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Total Asset</p>
                                <p class="text-3xl font-bold text-brand-blue">{{ $totalAssets }}</p>
                            </div>
                        </div>
                        <a href="{{ route('assets.index') }}" class="text-brand-blue text-sm mt-3 inline-flex items-center font-medium hover:underline">
                            Lihat semua
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                {{-- Laporan Pending --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm border-l-4 border-brand-yellow hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-brand-yellow/20 text-brand-yellow">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Laporan Pending</p>
                                <p class="text-3xl font-bold text-yellow-600">{{ $pendingReports }}</p>
                            </div>
                        </div>
                        <a href="{{ route('damage-reports.index', ['status' => 'pending']) }}" class="text-yellow-600 text-sm mt-3 inline-flex items-center font-medium hover:underline">
                            Lihat laporan
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                {{-- Sedang Diperbaiki --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm border-l-4 border-brand-red hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-brand-red/10 text-brand-red">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Sedang Diperbaiki</p>
                                <p class="text-3xl font-bold text-brand-red">{{ $processReports }}</p>
                            </div>
                        </div>
                        <a href="{{ route('damage-reports.index', ['status' => 'process']) }}" class="text-brand-red text-sm mt-3 inline-flex items-center font-medium hover:underline">
                            Lihat proses
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                {{-- Total Biaya Perbaikan --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm border-l-4 border-green-500 hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-green-100 text-green-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">Total Biaya</p>
                                <p class="text-xl font-bold text-green-600">Rp {{ number_format($totalMaintenanceCost, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-3">Bulan ini: <span class="font-medium">Rp {{ number_format($monthlyMaintenanceCost, 0, ',', '.') }}</span></p>
                    </div>
                </div>
            </div>

            {{-- Statistik Kondisi Asset --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                    <div class="p-6">
                        <h3 class="font-bold text-brand-blue mb-4 flex items-center">
                            <span class="w-2 h-6 bg-brand-yellow rounded-full mr-2"></span>
                            Kondisi Asset
                        </h3>
                        <div class="space-y-3">
                            @php
                                $conditionColors = [
                                    'bagus' => 'bg-green-500',
                                    'rusak ringan' => 'bg-brand-yellow',
                                    'rusak sedang' => 'bg-orange-500',
                                    'rusak berat' => 'bg-brand-red',
                                    'hilang' => 'bg-gray-500',
                                    'diperbaiki' => 'bg-brand-blue',
                                ];
                            @endphp
                            @foreach($conditionColors as $condition => $color)
                                <div class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-50 transition">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full {{ $color }} mr-3"></div>
                                        <span class="text-sm text-gray-700">{{ ucfirst($condition) }}</span>
                                    </div>
                                    <span class="font-bold text-gray-800">{{ $assetsByCondition[$condition] ?? 0 }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                    <div class="p-6">
                        <h3 class="font-bold text-brand-blue mb-4 flex items-center">
                            <span class="w-2 h-6 bg-brand-blue rounded-full mr-2"></span>
                            Ringkasan
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Total Kategori</span>
                                <span class="font-bold text-brand-blue">{{ $totalCategories }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Total Ruangan</span>
                                <span class="font-bold text-brand-blue">{{ $totalRooms }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Total Laporan</span>
                                <span class="font-bold text-brand-red">{{ $totalDamageReports }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Total Perbaikan</span>
                                <span class="font-bold text-green-600">{{ $totalMaintenanceLogs }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                    <div class="p-6">
                        <h3 class="font-bold text-brand-blue mb-4 flex items-center">
                            <span class="w-2 h-6 bg-brand-red rounded-full mr-2"></span>
                            Menu Cepat
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('assets.create') }}" class="p-4 bg-brand-blue/5 rounded-xl text-center hover:bg-brand-blue/10 transition border border-brand-blue/20 group">
                                <span class="text-2xl block mb-1">📦</span>
                                <span class="text-brand-blue text-sm font-medium group-hover:underline">Asset Baru</span>
                            </a>
                            <a href="{{ route('damage-reports.create') }}" class="p-4 bg-brand-red/5 rounded-xl text-center hover:bg-brand-red/10 transition border border-brand-red/20 group">
                                <span class="text-2xl block mb-1">⚠️</span>
                                <span class="text-brand-red text-sm font-medium group-hover:underline">Laporan</span>
                            </a>
                            <a href="{{ route('maintenance-logs.create') }}" class="p-4 bg-green-50 rounded-xl text-center hover:bg-green-100 transition border border-green-200 group">
                                <span class="text-2xl block mb-1">🔧</span>
                                <span class="text-green-600 text-sm font-medium group-hover:underline">Perbaikan</span>
                            </a>
                            <a href="{{ route('categories.index') }}" class="p-4 bg-brand-yellow/10 rounded-xl text-center hover:bg-brand-yellow/20 transition border border-brand-yellow/30 group">
                                <span class="text-2xl block mb-1">🏷️</span>
                                <span class="text-yellow-700 text-sm font-medium group-hover:underline">Kategori</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Data Terbaru --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Laporan Kerusakan Terbaru --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-brand-blue flex items-center">
                                <span class="w-2 h-5 bg-brand-red rounded-full mr-2"></span>
                                Laporan Kerusakan Terbaru
                            </h3>
                            <a href="{{ route('damage-reports.index') }}" class="text-brand-blue text-sm hover:underline font-medium">Lihat semua</a>
                        </div>
                        @if($latestDamageReports->count() > 0)
                            <div class="space-y-3">
                                @foreach($latestDamageReports as $report)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                        <div>
                                            <p class="font-medium text-sm text-gray-800">{{ $report->asset->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $report->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($report->status === 'pending') bg-brand-yellow/20 text-yellow-700
                                            @elseif($report->status === 'process') bg-brand-blue/20 text-brand-blue
                                            @elseif($report->status === 'fixed') bg-green-100 text-green-700
                                            @else bg-brand-red/20 text-brand-red
                                            @endif">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm py-4 text-center">Belum ada laporan kerusakan.</p>
                        @endif
                    </div>
                </div>

                {{-- Riwayat Perbaikan Terbaru --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-brand-blue flex items-center">
                                <span class="w-2 h-5 bg-green-500 rounded-full mr-2"></span>
                                Perbaikan Terbaru
                            </h3>
                            <a href="{{ route('maintenance-logs.index') }}" class="text-brand-blue text-sm hover:underline font-medium">Lihat semua</a>
                        </div>
                        @if($latestMaintenanceLogs->count() > 0)
                            <div class="space-y-3">
                                @foreach($latestMaintenanceLogs as $log)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                        <div>
                                            <p class="font-medium text-sm text-gray-800">{{ $log->asset->name }}</p>
                                            <p class="text-xs text-gray-500">{{ Str::limit($log->action_taken, 30) }}</p>
                                        </div>
                                        <span class="text-green-600 font-bold text-sm">
                                            Rp {{ number_format($log->cost, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm py-4 text-center">Belum ada riwayat perbaikan.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Asset Rusak --}}
            @if($damagedAssets->count() > 0)
                <div class="bg-white overflow-hidden rounded-xl shadow-sm mt-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-brand-red flex items-center">
                                <span class="w-2 h-5 bg-brand-yellow rounded-full mr-2"></span>
                                ⚠️ Asset Perlu Perhatian
                            </h3>
                            <a href="{{ route('assets.index', ['condition' => 'rusak ringan']) }}" class="text-brand-blue text-sm hover:underline font-medium">Lihat semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-brand-blue text-white">
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase rounded-tl-lg">Kode</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Nama</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Ruangan</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase">Kondisi</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase rounded-tr-lg">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($damagedAssets as $asset)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-3 text-sm font-mono text-gray-700">{{ $asset->code }}</td>
                                            <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $asset->name }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $asset->room->name }}</td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                                    @if($asset->condition === 'rusak ringan') bg-brand-yellow/20 text-yellow-700
                                                    @elseif($asset->condition === 'rusak sedang') bg-orange-100 text-orange-700
                                                    @else bg-brand-red/20 text-brand-red
                                                    @endif">
                                                    {{ ucfirst($asset->condition) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <a href="{{ route('damage-reports.create', ['asset_id' => $asset->id]) }}" 
                                                   class="inline-flex items-center px-3 py-1.5 bg-brand-red text-white text-xs font-medium rounded-lg hover:bg-red-700 transition">
                                                    + Buat Laporan
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

