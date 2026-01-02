<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - Sistem Manajemen Inventaris
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Total Asset --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Asset</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $totalAssets }}</p>
                            </div>
                        </div>
                        <a href="{{ route('assets.index') }}" class="text-blue-600 text-sm mt-2 inline-block hover:underline">Lihat semua →</a>
                    </div>
                </div>

                {{-- Laporan Pending --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Laporan Pending</p>
                                <p class="text-2xl font-bold text-yellow-600">{{ $pendingReports }}</p>
                            </div>
                        </div>
                        <a href="{{ route('damage-reports.index', ['status' => 'pending']) }}" class="text-yellow-600 text-sm mt-2 inline-block hover:underline">Lihat laporan →</a>
                    </div>
                </div>

                {{-- Sedang Diperbaiki --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Sedang Diperbaiki</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $processReports }}</p>
                            </div>
                        </div>
                        <a href="{{ route('damage-reports.index', ['status' => 'process']) }}" class="text-blue-600 text-sm mt-2 inline-block hover:underline">Lihat proses →</a>
                    </div>
                </div>

                {{-- Total Biaya Perbaikan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Biaya Perbaikan</p>
                                <p class="text-xl font-bold text-green-600">Rp {{ number_format($totalMaintenanceCost, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Bulan ini: Rp {{ number_format($monthlyMaintenanceCost, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Statistik Kondisi Asset --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Kondisi Asset</h3>
                        <div class="space-y-3">
                            @php
                                $conditionColors = [
                                    'bagus' => 'bg-green-500',
                                    'rusak ringan' => 'bg-yellow-500',
                                    'rusak sedang' => 'bg-orange-500',
                                    'rusak berat' => 'bg-red-500',
                                    'hilang' => 'bg-gray-500',
                                    'diperbaiki' => 'bg-blue-500',
                                ];
                            @endphp
                            @foreach($conditionColors as $condition => $color)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full {{ $color }} mr-2"></div>
                                        <span class="text-sm text-gray-600">{{ ucfirst($condition) }}</span>
                                    </div>
                                    <span class="font-medium">{{ $assetsByCondition[$condition] ?? 0 }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Ringkasan</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-2 border-b">
                                <span class="text-gray-600">Total Kategori</span>
                                <span class="font-medium">{{ $totalCategories }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b">
                                <span class="text-gray-600">Total Ruangan</span>
                                <span class="font-medium">{{ $totalRooms }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b">
                                <span class="text-gray-600">Total Laporan</span>
                                <span class="font-medium">{{ $totalDamageReports }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Perbaikan</span>
                                <span class="font-medium">{{ $totalMaintenanceLogs }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Menu Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('assets.create') }}" class="p-3 bg-blue-50 rounded-lg text-center hover:bg-blue-100 transition">
                                <span class="text-blue-600 text-sm font-medium">+ Asset Baru</span>
                            </a>
                            <a href="{{ route('damage-reports.create') }}" class="p-3 bg-red-50 rounded-lg text-center hover:bg-red-100 transition">
                                <span class="text-red-600 text-sm font-medium">+ Laporan</span>
                            </a>
                            <a href="{{ route('maintenance-logs.create') }}" class="p-3 bg-green-50 rounded-lg text-center hover:bg-green-100 transition">
                                <span class="text-green-600 text-sm font-medium">+ Perbaikan</span>
                            </a>
                            <a href="{{ route('categories.index') }}" class="p-3 bg-purple-50 rounded-lg text-center hover:bg-purple-100 transition">
                                <span class="text-purple-600 text-sm font-medium">Kategori</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Data Terbaru --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Laporan Kerusakan Terbaru --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-gray-800">Laporan Kerusakan Terbaru</h3>
                            <a href="{{ route('damage-reports.index') }}" class="text-blue-600 text-sm hover:underline">Lihat semua</a>
                        </div>
                        @if($latestDamageReports->count() > 0)
                            <div class="space-y-3">
                                @foreach($latestDamageReports as $report)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-sm">{{ $report->asset->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $report->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($report->status === 'process') bg-blue-100 text-blue-800
                                            @elseif($report->status === 'fixed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">Belum ada laporan kerusakan.</p>
                        @endif
                    </div>
                </div>

                {{-- Riwayat Perbaikan Terbaru --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-gray-800">Perbaikan Terbaru</h3>
                            <a href="{{ route('maintenance-logs.index') }}" class="text-blue-600 text-sm hover:underline">Lihat semua</a>
                        </div>
                        @if($latestMaintenanceLogs->count() > 0)
                            <div class="space-y-3">
                                @foreach($latestMaintenanceLogs as $log)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-sm">{{ $log->asset->name }}</p>
                                            <p class="text-xs text-gray-500">{{ Str::limit($log->action_taken, 30) }}</p>
                                        </div>
                                        <span class="text-green-600 font-medium text-sm">
                                            Rp {{ number_format($log->cost, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">Belum ada riwayat perbaikan.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Asset Rusak --}}
            @if($damagedAssets->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-gray-800">⚠️ Asset Perlu Perhatian</h3>
                            <a href="{{ route('assets.index', ['condition' => 'rusak ringan']) }}" class="text-blue-600 text-sm hover:underline">Lihat semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ruangan</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($damagedAssets as $asset)
                                        <tr>
                                            <td class="px-4 py-2 text-sm font-mono">{{ $asset->code }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $asset->name }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $asset->room->name }}</td>
                                            <td class="px-4 py-2">
                                                <span class="px-2 py-1 rounded-full text-xs 
                                                    @if($asset->condition === 'rusak ringan') bg-yellow-100 text-yellow-800
                                                    @elseif($asset->condition === 'rusak sedang') bg-orange-100 text-orange-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($asset->condition) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2">
                                                <a href="{{ route('damage-reports.create', ['asset_id' => $asset->id]) }}" class="text-red-600 text-sm hover:underline">Buat Laporan</a>
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
