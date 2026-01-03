<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Asset') }}
            </h2>
            <div class="flex gap-2">
                @if(Auth::user()->isAdmin() || Auth::user()->isTeknisi())
                    <a href="{{ route('assets.export.pdf', request()->query()) }}" 
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        📄 Export PDF
                    </a>
                    <a href="{{ route('assets.create') }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Asset
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Flash Message Sukses --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filter dan Pencarian --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('assets.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        {{-- Search --}}
                        <div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama/kode..."
                                   class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                        </div>
                        
                        {{-- Filter Kategori --}}
                        <div>
                            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
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
                            <select name="room_id" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
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
                            <select name="condition" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
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
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700">
                                Filter
                            </button>
                            <a href="{{ route('assets.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel Asset --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ruangan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($assets as $asset)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                        {{ $asset->code }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div>{{ $asset->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $asset->brand ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                            {{ $asset->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                            {{ $asset->room->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            @if($asset->condition === 'bagus') bg-green-100 text-green-800
                                            @elseif($asset->condition === 'rusak ringan') bg-yellow-100 text-yellow-800
                                            @elseif($asset->condition === 'rusak sedang') bg-orange-100 text-orange-800
                                            @elseif($asset->condition === 'diperbaiki') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($asset->condition) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('assets.show', $asset) }}" class="text-blue-600 hover:text-blue-900 mr-2">Lihat</a>
                                        <a href="{{ route('assets.edit', $asset) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                        <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus asset ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada asset. 
                                        <a href="{{ route('assets.create') }}" class="text-blue-600">Tambah asset pertama</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $assets->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
