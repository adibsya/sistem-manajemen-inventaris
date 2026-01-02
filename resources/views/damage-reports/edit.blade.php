<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Laporan Kerusakan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('damage-reports.update', $damageReport) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- Pilih Asset --}}
                        <div class="mb-4">
                            <label for="asset_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Asset yang Rusak <span class="text-red-500">*</span>
                            </label>
                            <select name="asset_id" 
                                    id="asset_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">-- Pilih Asset --</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}" {{ old('asset_id', $damageReport->asset_id) == $asset->id ? 'selected' : '' }}>
                                        [{{ $asset->code }}] {{ $asset->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('asset_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi Kerusakan --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi Kerusakan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      rows="5"
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      required>{{ old('description', $damageReport->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- URL Foto (opsional) --}}
                        <div class="mb-4">
                            <label for="photo_evidence" class="block text-sm font-medium text-gray-700 mb-2">
                                URL Foto Bukti (opsional)
                            </label>
                            <input type="text" 
                                   name="photo_evidence" 
                                   id="photo_evidence"
                                   value="{{ old('photo_evidence', $damageReport->photo_evidence) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('photo_evidence')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status (untuk admin/teknisi) --}}
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" 
                                    id="status"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $damageReport->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 mt-1">
                                <strong>Pending:</strong> Menunggu ditangani |
                                <strong>Process:</strong> Sedang diperbaiki |
                                <strong>Fixed:</strong> Sudah diperbaiki |
                                <strong>Rejected:</strong> Ditolak
                            </p>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Laporan
                            </button>
                            <a href="{{ route('damage-reports.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
