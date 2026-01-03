<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Kerusakan') }}
            </h2>
            <div class="flex gap-2">
                @if(Auth::user()->isAdmin() || Auth::user()->isTeknisi())
                    <a href="{{ route('damage-reports.export.pdf', request()->query()) }}" 
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        📄 Export PDF
                    </a>
                @endif
                <a href="{{ route('damage-reports.create') }}" 
                   class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    + Buat Laporan
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

            {{-- Filter --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('damage-reports.index') }}" method="GET" class="flex gap-4">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari nama/kode asset..."
                               class="flex-1 border-gray-300 rounded-md shadow-sm text-sm">
                        
                        <select name="status" class="border-gray-300 rounded-md shadow-sm text-sm">
                            <option value="">Semua Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">Filter</button>
                        <a href="{{ route('damage-reports.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm">Reset</a>
                    </form>
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
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelapor</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($damageReports as $report)
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ $report->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        <div class="font-medium">{{ $report->asset->name }}</div>
                                        <div class="text-xs text-gray-500 font-mono">{{ $report->asset->code }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ $report->user->name }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 max-w-xs truncate">
                                        {{ Str::limit($report->description, 50) }}
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($report->status === 'process') bg-blue-100 text-blue-800
                                            @elseif($report->status === 'fixed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium">
                                        <a href="{{ route('damage-reports.show', $report) }}" class="text-blue-600 hover:text-blue-900 mr-2">Lihat</a>
                                        <a href="{{ route('damage-reports.edit', $report) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                        <form action="{{ route('damage-reports.destroy', $report) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada laporan kerusakan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $damageReports->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
