<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Asset') }}: {{ $asset->code }}
            </h2>
            <a href="{{ route('assets.index') }}" class="text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Info Asset --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Informasi Asset</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Asset</p>
                            <p class="font-mono font-medium">{{ $asset->code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Asset</p>
                            <p class="font-medium">{{ $asset->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Brand/Merk</p>
                            <p class="font-medium">{{ $asset->brand ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                {{ $asset->category->name }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Ruangan</p>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                {{ $asset->room->name }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kondisi</p>
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($asset->condition === 'bagus') bg-green-100 text-green-800
                                @elseif($asset->condition === 'rusak ringan') bg-yellow-100 text-yellow-800
                                @elseif($asset->condition === 'rusak sedang') bg-orange-100 text-orange-800
                                @elseif($asset->condition === 'diperbaiki') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($asset->condition) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pembelian</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($asset->purchase_date)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dibuat pada</p>
                            <p class="font-medium">{{ $asset->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Terakhir diupdate</p>
                            <p class="font-medium">{{ $asset->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('assets.edit', $asset) }}" 
                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit Asset
                        </a>
                        
                        <form action="{{ route('assets.destroy', $asset) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus asset ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Hapus Asset
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Riwayat Kerusakan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Laporan Kerusakan</h3>
                    
                    @if($asset->damageReports->count() > 0)
                        <div class="space-y-4">
                            @foreach($asset->damageReports as $report)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm text-gray-500">
                                                Dilaporkan oleh <span class="font-medium">{{ $report->user->name }}</span>
                                                pada {{ $report->created_at->format('d M Y, H:i') }}
                                            </p>
                                            <p class="mt-2">{{ $report->description }}</p>
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
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada laporan kerusakan untuk asset ini.</p>
                    @endif
                </div>
            </div>

            {{-- Riwayat Perbaikan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Perbaikan</h3>
                    
                    @if($asset->maintenanceLogs->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teknisi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tindakan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($asset->maintenanceLogs as $log)
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($log->completion_date)->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">{{ $log->user->name }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-900">{{ $log->action_taken }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                            Rp {{ number_format($log->cost, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Belum ada riwayat perbaikan untuk asset ini.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
