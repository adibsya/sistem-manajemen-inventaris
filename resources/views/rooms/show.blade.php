<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Ruangan') }}: {{ $room->name }}
            </h2>
            <a href="{{ route('rooms.index') }}" 
               class="text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Info Ruangan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Informasi Ruangan</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Ruangan</p>
                            <p class="font-medium">{{ $room->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Asset</p>
                            <p class="font-medium">{{ $room->assets->count() }} barang</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dibuat pada</p>
                            <p class="font-medium">{{ $room->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Terakhir diupdate</p>
                            <p class="font-medium">{{ $room->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('rooms.edit', $room) }}" 
                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit Ruangan
                        </a>
                        
                        <form action="{{ route('rooms.destroy', $room) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Hapus Ruangan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Daftar Asset dalam Ruangan ini --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Asset di Ruangan Ini</h3>
                    
                    @if($room->assets->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Brand</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($room->assets as $asset)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-mono text-gray-900">{{ $asset->code }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $asset->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                {{ $asset->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $asset->brand ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Belum ada asset di ruangan ini.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
