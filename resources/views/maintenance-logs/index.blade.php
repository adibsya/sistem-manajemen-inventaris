<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Perbaikan') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('maintenance-logs.export.pdf', request()->query()) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    📄 Export PDF
                </a>
                <a href="{{ route('maintenance-logs.create') }}" 
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Riwayat
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Statistik Total Biaya --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Biaya Perbaikan</p>
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalCost, 0, ',', '.') }}</p>
                        </div>
                        
                        {{-- Filter --}}
                        <form action="{{ route('maintenance-logs.index') }}" method="GET" class="flex gap-4">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari asset..."
                                   class="border-gray-300 rounded-md shadow-sm text-sm">
                            
                            <select name="month" class="border-gray-300 rounded-md shadow-sm text-sm">
                                <option value="">Semua Bulan</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                            
                            <select name="year" class="border-gray-300 rounded-md shadow-sm text-sm">
                                <option value="">Semua Tahun</option>
                                @for($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                            
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">Filter</button>
                            <a href="{{ route('maintenance-logs.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm">Reset</a>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asset</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teknisi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tindakan</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($maintenanceLogs as $log)
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($log->completion_date)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        <div class="font-medium">{{ $log->asset->name }}</div>
                                        <div class="text-xs text-gray-500 font-mono">{{ $log->asset->code }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ $log->user->name }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 max-w-xs truncate">
                                        {{ Str::limit($log->action_taken, 40) }}
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-green-600">
                                        Rp {{ number_format($log->cost, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium">
                                        <a href="{{ route('maintenance-logs.show', $log) }}" class="text-blue-600 hover:text-blue-900 mr-2">Lihat</a>
                                        <a href="{{ route('maintenance-logs.edit', $log) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                        <form action="{{ route('maintenance-logs.destroy', $log) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada riwayat perbaikan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $maintenanceLogs->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
