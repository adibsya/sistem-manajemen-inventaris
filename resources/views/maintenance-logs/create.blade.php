<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Riwayat Perbaikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('maintenance-logs.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Pilih Asset --}}
                            <div class="md:col-span-2">
                                <label for="asset_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Asset yang Diperbaiki <span class="text-red-500">*</span>
                                </label>
                                <select name="asset_id" 
                                        id="asset_id"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">-- Pilih Asset --</option>
                                    @foreach($assets as $asset)
                                        <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                            [{{ $asset->code }}] {{ $asset->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('asset_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tindakan yang Dilakukan --}}
                            <div class="md:col-span-2">
                                <label for="action_taken" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tindakan yang Dilakukan <span class="text-red-500">*</span>
                                </label>
                                <textarea name="action_taken" 
                                          id="action_taken"
                                          rows="4"
                                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          placeholder="Contoh: Ganti keyboard, Instal ulang OS, Perbaikan layar..."
                                          required>{{ old('action_taken') }}</textarea>
                                @error('action_taken')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Biaya --}}
                            <div>
                                <label for="cost" class="block text-sm font-medium text-gray-700 mb-2">
                                    Biaya Perbaikan (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="cost" 
                                       id="cost"
                                       value="{{ old('cost', 0) }}"
                                       min="0"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('cost')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div>
                                <label for="completion_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Selesai <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       name="completion_date" 
                                       id="completion_date"
                                       value="{{ old('completion_date', date('Y-m-d')) }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('completion_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Riwayat
                            </button>
                            <a href="{{ route('maintenance-logs.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
