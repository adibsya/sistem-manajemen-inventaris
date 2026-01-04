<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('damage-reports.index') }}" class="text-brand-blue hover:text-brand-blue/80 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-xl text-brand-blue leading-tight">
                    Detail Laporan Kerusakan
                </h2>
                <p class="text-sm text-gray-500">Dilaporkan {{ $damageReport->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Info Laporan --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm mb-6">
                <div class="border-b border-gray-100 bg-brand-red/5 px-6 py-4 flex justify-between items-center">
                    <h3 class="font-semibold text-brand-red flex items-center">
                        <span class="w-2 h-5 bg-brand-red rounded-full mr-2"></span>
                        ⚠️ Informasi Laporan
                    </h3>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                        @if($damageReport->status === 'pending') bg-brand-yellow/20 text-yellow-700
                        @elseif($damageReport->status === 'process') bg-blue-100 text-blue-700
                        @elseif($damageReport->status === 'fixed') bg-green-100 text-green-700
                        @else bg-brand-red/10 text-brand-red
                        @endif">
                        @if($damageReport->status === 'pending') ⏳
                        @elseif($damageReport->status === 'process') 🔧
                        @elseif($damageReport->status === 'fixed') ✓
                        @else ✕
                        @endif
                        {{ ucfirst($damageReport->status) }}
                    </span>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Tanggal Laporan</p>
                            <p class="font-semibold text-gray-900">{{ $damageReport->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $damageReport->created_at->format('H:i') }} WIB</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Dilaporkan oleh</p>
                            <div class="flex items-center mt-1">
                                <div class="w-8 h-8 bg-brand-blue/20 rounded-full flex items-center justify-center text-xs font-medium text-brand-blue mr-2">
                                    {{ substr($damageReport->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-gray-900">{{ $damageReport->user->name }}</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 md:col-span-2">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Asset yang Dilaporkan</p>
                            <a href="{{ route('assets.show', $damageReport->asset) }}" class="group">
                                <p class="font-semibold text-gray-900 group-hover:text-brand-blue transition">{{ $damageReport->asset->name }}</p>
                                <span class="text-xs font-mono text-brand-blue bg-brand-blue/10 px-1.5 py-0.5 rounded">
                                    {{ $damageReport->asset->code }}
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Deskripsi Kerusakan</p>
                        <div class="bg-brand-red/5 border border-brand-red/10 p-4 rounded-xl">
                            <p class="text-gray-700 leading-relaxed">{{ $damageReport->description }}</p>
                        </div>
                    </div>

                    @if($damageReport->photo_evidence)
                        <div class="mb-6">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">📷 Foto Bukti Kerusakan</p>
                            <a href="{{ asset('storage/' . $damageReport->photo_evidence) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/' . $damageReport->photo_evidence) }}" 
                                     alt="Foto bukti kerusakan" 
                                     class="max-w-md max-h-64 rounded-xl border shadow-sm hover:opacity-90 hover:shadow-md transition cursor-pointer">
                            </a>
                            <p class="text-xs text-gray-400 mt-2">Klik untuk memperbesar</p>
                        </div>
                    @endif

                    <div class="pt-6 border-t border-gray-100 flex gap-3">
                        <a href="{{ route('damage-reports.edit', $damageReport) }}" 
                           class="inline-flex items-center px-5 py-2.5 bg-brand-yellow hover:bg-brand-yellow/90 text-white font-medium rounded-lg transition shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit / Update Status
                        </a>
                        <form action="{{ route('damage-reports.destroy', $damageReport) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-5 py-2.5 bg-brand-red hover:bg-brand-red/90 text-white font-medium rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus Laporan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Info Asset --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
                    <h3 class="font-semibold text-brand-blue flex items-center">
                        <span class="w-2 h-5 bg-brand-yellow rounded-full mr-2"></span>
                        📦 Informasi Asset
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Kode Asset</p>
                            <p class="font-mono font-bold text-brand-blue text-lg">{{ $damageReport->asset->code }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Nama Asset</p>
                            <p class="font-semibold text-gray-900">{{ $damageReport->asset->name }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Kategori</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-brand-blue/10 text-brand-blue">
                                {{ $damageReport->asset->category->name }}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Ruangan</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                📍 {{ $damageReport->asset->room->name }}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Kondisi Saat Ini</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                @if($damageReport->asset->condition === 'bagus') bg-green-100 text-green-700
                                @elseif($damageReport->asset->condition === 'diperbaiki') bg-blue-100 text-blue-700
                                @elseif($damageReport->asset->condition === 'rusak ringan') bg-brand-yellow/20 text-yellow-700
                                @else bg-brand-red/10 text-brand-red
                                @endif">
                                {{ ucfirst($damageReport->asset->condition) }}
                            </span>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 flex items-center">
                            <a href="{{ route('assets.show', $damageReport->asset) }}" 
                               class="text-brand-blue hover:text-brand-blue/80 font-medium text-sm flex items-center transition">
                                Lihat detail asset
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
