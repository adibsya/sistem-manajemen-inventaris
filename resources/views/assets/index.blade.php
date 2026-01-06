<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 dark:text-white leading-tight flex items-center gap-2">
            <x-icon name="assets" class="w-6 h-6 text-primary-600 dark:text-primary-400" />
            Daftar Asset
        </h2>
    </x-slot>

    <div class="py-4 sm:py-6 lg:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            
            {{-- Flash Message Sukses --}}
            @if (session('success'))
                <div class="bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 px-4 py-3 rounded-xl mb-4 sm:mb-6 flex items-center text-sm">
                    <x-icon name="check-circle" class="w-5 h-5 mr-2 text-emerald-500 flex-shrink-0" />
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filter dan Pencarian --}}
            <div class="bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 mb-4 sm:mb-6">
                <div class="border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-700/50 px-4 sm:px-6 py-3 sm:py-4">
                    <h3 class="font-semibold text-slate-700 dark:text-slate-200 flex items-center text-sm sm:text-base">
                        <x-icon name="filter" class="w-4 h-4 mr-2 text-slate-500 dark:text-slate-400" />
                        Filter & Pencarian
                    </h3>
                </div>
                <div class="p-4 sm:p-6">
                    <form action="{{ route('assets.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4">
                        {{-- Search --}}
                        <div class="relative sm:col-span-2 lg:col-span-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-icon name="search" class="w-4 h-4 text-slate-400" />
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama/kode..."
                                   class="w-full pl-10 border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg shadow-sm text-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>
                        
                        {{-- Filter Kategori --}}
                        <div>
                            <select name="category_id" class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg shadow-sm text-sm focus:border-primary-500 focus:ring-primary-500">
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
                            <select name="room_id" class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg shadow-sm text-sm focus:border-primary-500 focus:ring-primary-500">
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
                            <select name="condition" class="w-full border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg shadow-sm text-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="">Semua Kondisi</option>
                                @foreach($conditions as $cond)
                                    <option value="{{ $cond }}" {{ request('condition') == $cond ? 'selected' : '' }}>
                                        {{ ucfirst($cond) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Tombol Filter --}}
                        <div class="flex gap-2 sm:col-span-2 lg:col-span-1">
                            <button type="submit" class="flex-1 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium">
                                Terapkan
                            </button>
                            <a href="{{ route('assets.index') }}" class="bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-4 py-2 rounded-lg text-sm hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Mobile/Tablet Card View --}}
            <div class="lg:hidden space-y-3">
                @forelse ($assets as $asset)
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-mono font-semibold text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/30 px-2 py-0.5 rounded">
                                        {{ $asset->code }}
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium gap-1
                                        @if($asset->condition === 'bagus') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300
                                        @elseif($asset->condition === 'rusak ringan') bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300
                                        @elseif($asset->condition === 'rusak sedang') bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300
                                        @elseif($asset->condition === 'diperbaiki') bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300
                                        @else bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300
                                        @endif">
                                        {{ ucfirst($asset->condition) }}
                                    </span>
                                </div>
                                <h3 class="font-medium text-slate-900 dark:text-white truncate">{{ $asset->name }}</h3>
                                @if($asset->brand)
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $asset->brand }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 flex-shrink-0">
                                <a href="{{ route('assets.show', $asset) }}" 
                                   class="p-2 text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/30 rounded-lg transition">
                                    <x-icon name="eye" class="w-4 h-4" />
                                </a>
                                <a href="{{ route('assets.edit', $asset) }}" 
                                   class="p-2 text-slate-500 dark:text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/30 rounded-lg transition">
                                    <x-icon name="edit" class="w-4 h-4" />
                                </a>
                                <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus asset ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg transition">
                                        <x-icon name="trash" class="w-4 h-4" />
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-slate-100 dark:border-slate-700">
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300">
                                <x-icon name="category" class="w-3 h-3 mr-1" />
                                {{ $asset->category->name }}
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300">
                                <x-icon name="location" class="w-3 h-3 mr-1" />
                                {{ $asset->room->name }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-8 text-center">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-icon name="assets" class="w-8 h-8 text-slate-400 dark:text-slate-500" />
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 mb-2">Belum ada asset.</p>
                        <a href="{{ route('assets.create') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 font-medium">
                            + Tambah asset pertama
                        </a>
                    </div>
                @endforelse
                
                {{-- Mobile Pagination --}}
                @if($assets->hasPages())
                    <div class="mt-4">
                        {{ $assets->withQueryString()->links() }}
                    </div>
                @endif
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden lg:block bg-white dark:bg-slate-800 overflow-hidden rounded-xl shadow-sm border border-slate-200 dark:border-slate-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead class="bg-slate-800 dark:bg-slate-900">
                            <tr>
                                <th class="px-4 xl:px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Kode</th>
                                <th class="px-4 xl:px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Asset</th>
                                <th class="px-4 xl:px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Kategori</th>
                                <th class="px-4 xl:px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Ruangan</th>
                                <th class="px-4 xl:px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Kondisi</th>
                                <th class="px-4 xl:px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">
                            @forelse ($assets as $asset)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                    <td class="px-4 xl:px-6 py-3 whitespace-nowrap">
                                        <span class="text-xs font-mono font-semibold text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/30 px-2 py-1 rounded">
                                            {{ $asset->code }}
                                        </span>
                                    </td>
                                    <td class="px-4 xl:px-6 py-3">
                                        <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $asset->name }}</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $asset->brand ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 xl:px-6 py-3 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300">
                                            {{ $asset->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 xl:px-6 py-3 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 gap-1">
                                            <x-icon name="location" class="w-3 h-3" />
                                            {{ $asset->room->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 xl:px-6 py-3 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium gap-1
                                            @if($asset->condition === 'bagus') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300
                                            @elseif($asset->condition === 'rusak ringan') bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300
                                            @elseif($asset->condition === 'rusak sedang') bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300
                                            @elseif($asset->condition === 'diperbaiki') bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300
                                            @else bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300
                                            @endif">
                                            @if($asset->condition === 'bagus')
                                                <x-icon name="check-circle" class="w-3 h-3" />
                                            @elseif($asset->condition === 'diperbaiki')
                                                <x-icon name="maintenance" class="w-3 h-3" />
                                            @else
                                                <x-icon name="exclamation-triangle" class="w-3 h-3" />
                                            @endif
                                            {{ ucfirst($asset->condition) }}
                                        </span>
                                    </td>
                                    <td class="px-4 xl:px-6 py-3 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('assets.show', $asset) }}" 
                                               class="p-1.5 text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/30 rounded-lg transition"
                                               title="Lihat Detail">
                                                <x-icon name="eye" class="w-4 h-4" />
                                            </a>
                                            <a href="{{ route('assets.edit', $asset) }}" 
                                               class="p-1.5 text-slate-500 dark:text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/30 rounded-lg transition"
                                               title="Edit">
                                                <x-icon name="edit" class="w-4 h-4" />
                                            </a>
                                            <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus asset ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition"
                                                        title="Hapus">
                                                    <x-icon name="trash" class="w-4 h-4" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                                                <x-icon name="assets" class="w-8 h-8 text-slate-400 dark:text-slate-500" />
                                            </div>
                                            <p class="text-slate-500 dark:text-slate-400 mb-2">Belum ada asset.</p>
                                            <a href="{{ route('assets.create') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 font-medium">
                                                + Tambah asset pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Desktop Pagination --}}
                @if($assets->hasPages())
                    <div class="px-4 xl:px-6 py-4 border-t border-slate-100 dark:border-slate-700">
                        {{ $assets->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if(Auth::user()->isAdmin() || Auth::user()->isTeknisi())
        {{-- Action Buttons - Mobile View (Bottom) --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 sm:hidden">
            <div class="flex gap-2">
                <a href="{{ route('assets.export.pdf', request()->query()) }}" 
                   class="flex-1 inline-flex items-center justify-center px-3 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition shadow-lg text-sm">
                    <x-icon name="download" class="w-5 h-5 mr-2" />
                    Export PDF
                </a>
                <a href="{{ route('assets.create') }}" 
                   class="flex-1 inline-flex items-center justify-center px-3 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition shadow-lg text-sm">
                    <x-icon name="plus" class="w-5 h-5 mr-2" />
                    Tambah Asset
                </a>
            </div>
        </div>
    @endif
</x-app-layout>
