<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Laporan Kerusakan') }}
            </h2>
            <a href="{{ route('damage-reports.index') }}" class="text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Info Laporan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-lg font-semibold">Informasi Laporan</h3>
                        <span class="px-3 py-1 rounded-full text-sm 
                            @if($damageReport->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($damageReport->status === 'process') bg-blue-100 text-blue-800
                            @elseif($damageReport->status === 'fixed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($damageReport->status) }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Laporan</p>
                            <p class="font-medium">{{ $damageReport->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dilaporkan oleh</p>
                            <p class="font-medium">{{ $damageReport->user->name }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-2">Deskripsi Kerusakan</p>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p>{{ $damageReport->description }}</p>
                        </div>
                    </div>

                    @if($damageReport->photo_evidence)
                        <div class="mb-6">
                            <p class="text-sm text-gray-500 mb-2">Foto Bukti Kerusakan</p>
                            <a href="{{ asset('storage/' . $damageReport->photo_evidence) }}" target="_blank">
                                <img src="{{ asset('storage/' . $damageReport->photo_evidence) }}" 
                                     alt="Foto bukti kerusakan" 
                                     class="max-w-md max-h-64 rounded-lg border shadow-sm hover:opacity-90 transition cursor-pointer">
                            </a>
                            <p class="text-xs text-gray-400 mt-1">Klik untuk memperbesar</p>
                        </div>
                    @endif

                    <div class="flex gap-4">
                        <a href="{{ route('damage-reports.edit', $damageReport) }}" 
                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit / Update Status
                        </a>
                        <form action="{{ route('damage-reports.destroy', $damageReport) }}" method="POST" onsubmit="return confirm('Yakin?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Info Asset --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Informasi Asset</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Asset</p>
                            <p class="font-mono font-medium">{{ $damageReport->asset->code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Asset</p>
                            <p class="font-medium">{{ $damageReport->asset->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                {{ $damageReport->asset->category->name }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ruangan</p>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                {{ $damageReport->asset->room->name }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kondisi Saat Ini</p>
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($damageReport->asset->condition === 'bagus') bg-green-100 text-green-800
                                @elseif($damageReport->asset->condition === 'diperbaiki') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($damageReport->asset->condition) }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('assets.show', $damageReport->asset) }}" class="text-blue-600 hover:underline text-sm">
                            Lihat detail asset &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
