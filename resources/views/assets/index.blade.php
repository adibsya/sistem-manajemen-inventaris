<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-xl text-brand-blue leading-tight">
                    📦 Daftar Asset
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola semua inventaris asset</p>
            </div>
            <div class="flex gap-3">
                @if(Auth::user()->isAdmin() || Auth::user()->isTeknisi())
                    <a href="{{ route('assets.export.pdf', request()->query()) }}" 
                       class="inline-flex items-center px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export PDF
                    </a>
                    <a href="{{ route('assets.create') }}" 
                       class="inline-flex items-center px-4 py-2.5 bg-brand-blue hover:bg-brand-blue/90 text-white font-medium rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Asset
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Flash Message Sukses --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filter dan Pencarian --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm mb-6">
                <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
                    <h3 class="font-semibold text-gray-700 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter & Pencarian
                    </h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('assets.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        {{-- Search --}}
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama/kode..."
                                   class="w-full pl-10 border-gray-300 rounded-lg shadow-sm text-sm focus:border-brand-blue focus:ring-brand-blue">
                        </div>
                        
                        {{-- Filter Kategori --}}
                        <div>
                            <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:border-brand-blue focus:ring-brand-blue">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Filter Ruangan --}}
                        <div>
                            <select name="room_id" class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:border-brand-blue focus:ring-brand-blue">
                                <option value="">Semua Ruangan</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Filter Kondisi --}}
                        <div>
                            <select name="condition" class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:border-brand-blue focus:ring-brand-blue">
                                <option value="">Semua Kondisi</option>
                                @foreach($conditions as $cond)
                                    <option value="{{ $cond }}" {{ request('condition') == $cond ? 'selected' : '' }}>
                                        {{ ucfirst($cond) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Tombol Filter --}}
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 bg-brand-blue text-white px-4 py-2 rounded-lg text-sm hover:bg-brand-blue/90 transition font-medium">
                                Terapkan
                            </button>
                            <a href="{{ route('assets.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel Asset --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-brand-blue">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Asset</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Ruangan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kondisi</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($assets as $asset)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-mono font-semibold text-brand-blue bg-brand-blue/10 px-2 py-1 rounded">
                                            {{ $asset->code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $asset->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $asset->brand ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-brand-blue/10 text-brand-blue">
                                            {{ $asset->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            📍 {{ $asset->room->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('assets.show', $asset) }}" 
                                               class="p-2 text-gray-500 hover:text-brand-blue hover:bg-brand-blue/10 rounded-lg transition"
                                               title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('assets.edit', $asset) }}" 
                                               class="p-2 text-gray-500 hover:text-brand-yellow hover:bg-brand-yellow/10 rounded-lg transition"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus asset ini?')">
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
                                                <span class="text-3xl">📦</span>
                                            </div>
                                            <p class="text-gray-500 mb-2">Belum ada asset.</p>
                                            <a href="{{ route('assets.create') }}" class="text-brand-blue hover:text-brand-blue/80 font-medium">
                                                + Tambah asset pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($assets->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $assets->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
