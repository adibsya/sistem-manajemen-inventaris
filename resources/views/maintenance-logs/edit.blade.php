<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('maintenance-logs.index') }}" class="text-brand-blue hover:text-brand-blue/80 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-xl text-brand-blue leading-tight">
                    Edit Riwayat Perbaikan
                </h2>
                <p class="text-sm text-gray-500">Update informasi riwayat perbaikan</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="border-b border-gray-100 bg-green-50 px-6 py-4">
                    <h3 class="font-semibold text-green-700 flex items-center">
                        <span class="w-2 h-5 bg-green-500 rounded-full mr-2"></span>
                        🔧 Update Riwayat
                    </h3>
                </div>
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('maintenance-logs.update', $maintenanceLog) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Pilih Asset --}}
                            <div class="md:col-span-2">
                                <label for="asset_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Asset yang Diperbaiki <span class="text-brand-red">*</span>
                                </label>
                                <select name="asset_id" 
                                        id="asset_id"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 transition"
                                        required>
                                    <option value="">-- Pilih Asset --</option>
                                    @foreach($assets as $asset)
                                        <option value="{{ $asset->id }}" {{ old('asset_id', $maintenanceLog->asset_id) == $asset->id ? 'selected' : '' }}>
                                            [{{ $asset->code }}] {{ $asset->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('asset_id')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tindakan yang Dilakukan --}}
                            <div class="md:col-span-2">
                                <label for="action_taken" class="block text-sm font-semibold text-gray-700 mb-2">
                                    🔧 Tindakan yang Dilakukan <span class="text-brand-red">*</span>
                                </label>
                                <textarea name="action_taken" 
                                          id="action_taken"
                                          rows="4"
                                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 transition"
                                          required>{{ old('action_taken', $maintenanceLog->action_taken) }}</textarea>
                                @error('action_taken')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Biaya --}}
                            <div>
                                <label for="cost" class="block text-sm font-semibold text-gray-700 mb-2">
                                    💰 Biaya Perbaikan <span class="text-brand-red">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-medium">Rp</span>
                                    <input type="number" 
                                           name="cost" 
                                           id="cost"
                                           value="{{ old('cost', $maintenanceLog->cost) }}"
                                           min="0"
                                           class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 transition"
                                           required>
                                </div>
                                @error('cost')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div>
                                <label for="completion_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                    📅 Tanggal Selesai <span class="text-brand-red">*</span>
                                </label>
                                <input type="date" 
                                       name="completion_date" 
                                       id="completion_date"
                                       value="{{ old('completion_date', $maintenanceLog->completion_date) }}"
                                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 transition"
                                       required>
                                @error('completion_date')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-sm transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Riwayat
                            </button>
                            <a href="{{ route('maintenance-logs.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
