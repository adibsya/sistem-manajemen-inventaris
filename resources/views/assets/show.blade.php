<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('assets.index') }}" class="text-brand-blue hover:text-brand-blue/80 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-xl text-brand-blue leading-tight">
                    Detail Asset
                </h2>
                <p class="text-sm text-gray-500">{{ $asset->code }} - {{ $asset->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Info Asset --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm mb-6">
                <div class="border-b border-gray-100 bg-gray-50 px-6 py-4 flex justify-between items-center">
                    <h3 class="font-semibold text-brand-blue flex items-center">
                        <span class="w-2 h-5 bg-brand-yellow rounded-full mr-2"></span>
                        Informasi Asset
                    </h3>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                        @if($asset->condition === 'bagus') bg-green-100 text-green-700
                        @elseif($asset->condition === 'rusak ringan') bg-brand-yellow/20 text-yellow-700
                        @elseif($asset->condition === 'rusak sedang') bg-orange-100 text-orange-700
                        @elseif($asset->condition === 'diperbaiki') bg-blue-100 text-blue-700
                        @else bg-brand-red/10 text-brand-red
                        @endif">
                        @if($asset->condition === 'bagus') ✓
                        @elseif($asset->condition === 'diperbaiki') 🔧
                        @else ⚠
                        @endif
                        {{ ucfirst($asset->condition) }}
                    </span>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Kode Asset</p>
                            <p class="font-mono font-bold text-brand-blue text-lg">{{ $asset->code }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Nama Asset</p>
                            <p class="font-semibold text-gray-900">{{ $asset->name }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Brand/Merk</p>
                            <p class="font-medium text-gray-700">{{ $asset->brand ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Tanggal Pembelian</p>
                            <p class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($asset->purchase_date)->format('d M Y') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Kategori</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-brand-blue/10 text-brand-blue">
                                {{ $asset->category->name }}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Ruangan</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                📍 {{ $asset->room->name }}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Dibuat pada</p>
                            <p class="font-medium text-gray-700">{{ $asset->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Terakhir diupdate</p>
                            <p class="font-medium text-gray-700">{{ $asset->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-6 pt-6 border-t border-gray-100 flex gap-3">
                        <a href="{{ route('assets.edit', $asset) }}" 
                           class="inline-flex items-center px-5 py-2.5 bg-brand-yellow hover:bg-brand-yellow/90 text-white font-medium rounded-lg transition shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Asset
                        </a>
                        
                        <form action="{{ route('assets.destroy', $asset) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus asset ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-5 py-2.5 bg-brand-red hover:bg-brand-red/90 text-white font-medium rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus Asset
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Riwayat Kerusakan --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                    <div class="border-b border-gray-100 bg-brand-red/5 px-6 py-4">
                        <h3 class="font-semibold text-brand-red flex items-center">
                            <span class="w-2 h-5 bg-brand-red rounded-full mr-2"></span>
                            ⚠️ Riwayat Laporan Kerusakan
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($asset->damageReports->count() > 0)
                            <div class="space-y-4 max-h-80 overflow-y-auto">
                                @foreach($asset->damageReports as $report)
                                    <div class="border border-gray-100 rounded-xl p-4 hover:bg-gray-50 transition">
                                        <div class="flex justify-between items-start mb-2">
                                            <p class="text-xs text-gray-500">
                                                <span class="font-medium text-gray-700">{{ $report->user->name }}</span>
                                                • {{ $report->created_at->format('d M Y, H:i') }}
                                            </p>
                                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                                @if($report->status === 'pending') bg-brand-yellow/20 text-yellow-700
                                                @elseif($report->status === 'process') bg-blue-100 text-blue-700
                                                @elseif($report->status === 'fixed') bg-green-100 text-green-700
                                                @else bg-brand-red/10 text-brand-red
                                                @endif">
                                                {{ ucfirst($report->status) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-700">{{ $report->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <span class="text-xl">✓</span>
                                </div>
                                <p class="text-gray-500 text-sm">Belum ada laporan kerusakan</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Riwayat Perbaikan --}}
                <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                    <div class="border-b border-gray-100 bg-green-50 px-6 py-4">
                        <h3 class="font-semibold text-green-700 flex items-center">
                            <span class="w-2 h-5 bg-green-500 rounded-full mr-2"></span>
                            🔧 Riwayat Perbaikan
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($asset->maintenanceLogs->count() > 0)
                            <div class="space-y-4 max-h-80 overflow-y-auto">
                                @foreach($asset->maintenanceLogs as $log)
                                    <div class="border border-gray-100 rounded-xl p-4 hover:bg-gray-50 transition">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $log->action_taken }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    Oleh <span class="font-medium">{{ $log->user->name }}</span>
                                                </p>
                                            </div>
                                            <span class="text-sm font-bold text-green-600">
                                                Rp {{ number_format($log->cost, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-400">
                                            📅 {{ \Carbon\Carbon::parse($log->completion_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <span class="text-xl">🔧</span>
                                </div>
                                <p class="text-gray-500 text-sm">Belum ada riwayat perbaikan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
