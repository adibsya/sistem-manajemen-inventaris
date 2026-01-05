<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-brand-blue leading-tight">
                🔧 Riwayat Perbaikan
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('maintenance-logs.export.pdf', request()->query()) }}" 
                   class="inline-flex items-center px-4 py-2.5 bg-brand-blue hover:bg-brand-blue/90 text-white font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export PDF
                </a>
                <a href="{{ route('maintenance-logs.create') }}" 
                   class="inline-flex items-center px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Riwayat
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Statistik & Filter --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm mb-6">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                        {{-- Total Cost Card --}}
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-5 text-white min-w-[250px]">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <span class="text-2xl">💰</span>
                                </div>
                                <div>
                                    <p class="text-sm text-green-100">Total Biaya Perbaikan</p>
                                    <p class="text-2xl font-bold">Rp {{ number_format($totalCost, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Filter --}}
                        <form action="{{ route('maintenance-logs.index') }}" method="GET" class="flex flex-wrap gap-3">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Cari asset..."
                                       class="pl-10 border-gray-300 rounded-lg shadow-sm text-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                            
                            <select name="month" class="border-gray-300 rounded-lg shadow-sm text-sm focus:border-green-500 focus:ring-green-500">
                                <option value="">Semua Bulan</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                            
                            <select name="year" class="border-gray-300 rounded-lg shadow-sm text-sm focus:border-green-500 focus:ring-green-500">
                                <option value="">Semua Tahun</option>
                                @for($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                            
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition font-medium">
                                Terapkan
                            </button>
                            <a href="{{ route('maintenance-logs.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition">
                                Reset
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-600">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Asset</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Teknisi</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tindakan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Biaya</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($maintenanceLogs as $log)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($log->completion_date)->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-400">📅 {{ \Carbon\Carbon::parse($log->completion_date)->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $log->asset->name }}</div>
                                        <span class="text-xs font-mono text-brand-blue bg-brand-blue/10 px-1.5 py-0.5 rounded">
                                            {{ $log->asset->code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-xs font-medium text-green-700 mr-2">
                                                🔧
                                            </div>
                                            <span class="text-sm text-gray-700">{{ $log->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                        <p class="truncate">{{ Str::limit($log->action_taken, 40) }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-bold text-green-600 bg-green-50 px-3 py-1 rounded-lg">
                                            Rp {{ number_format($log->cost, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('maintenance-logs.show', $log) }}" 
                                               class="p-2 text-gray-500 hover:text-brand-blue hover:bg-brand-blue/10 rounded-lg transition"
                                               title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('maintenance-logs.edit', $log) }}" 
                                               class="p-2 text-gray-500 hover:text-brand-yellow hover:bg-brand-yellow/10 rounded-lg transition"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('maintenance-logs.destroy', $log) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 text-gray-500 hover:text-brand-red hover:bg-brand-red/10 rounded-lg transition"
                                                        title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <span class="text-3xl">🔧</span>
                                            </div>
                                            <p class="text-gray-500 mb-2">Belum ada riwayat perbaikan.</p>
                                            <a href="{{ route('maintenance-logs.create') }}" class="text-green-600 hover:text-green-700 font-medium">
                                                + Tambah riwayat pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($maintenanceLogs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $maintenanceLogs->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
