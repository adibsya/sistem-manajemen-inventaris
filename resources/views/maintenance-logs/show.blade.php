<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Riwayat Perbaikan') }}
            </h2>
            <a href="{{ route('maintenance-logs.index') }}" class="text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Info Perbaikan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Informasi Perbaikan</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Selesai</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($maintenanceLog->completion_date)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Teknisi</p>
                            <p class="font-medium">{{ $maintenanceLog->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Biaya Perbaikan</p>
                            <p class="text-xl font-bold text-green-600">Rp {{ number_format($maintenanceLog->cost, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dibuat pada</p>
                            <p class="font-medium">{{ $maintenanceLog->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-2">Tindakan yang Dilakukan</p>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p>{{ $maintenanceLog->action_taken }}</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('maintenance-logs.edit', $maintenanceLog) }}" 
                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                        <form action="{{ route('maintenance-logs.destroy', $maintenanceLog) }}" method="POST" onsubmit="return confirm('Yakin?')">
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
                            <p class="font-mono font-medium">{{ $maintenanceLog->asset->code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Asset</p>
                            <p class="font-medium">{{ $maintenanceLog->asset->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                {{ $maintenanceLog->asset->category->name }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ruangan</p>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                {{ $maintenanceLog->asset->room->name }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kondisi Saat Ini</p>
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($maintenanceLog->asset->condition === 'bagus') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($maintenanceLog->asset->condition) }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('assets.show', $maintenanceLog->asset) }}" class="text-blue-600 hover:underline text-sm">
                            Lihat detail asset &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
