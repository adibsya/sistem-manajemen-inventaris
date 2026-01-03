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
                    
                    <form action="{{ route('damage-reports.update', $damageReport) }}" method="POST" enctype="multipart/form-data">
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

                        {{-- Foto Bukti --}}
                        <div class="mb-4">
                            <label for="photo_evidence" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Bukti Kerusakan
                            </label>
                            
                            {{-- Foto existing --}}
                            @if($damageReport->photo_evidence)
                                <div class="mb-3 p-3 bg-gray-50 rounded-lg" id="current-photo">
                                    <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $damageReport->photo_evidence) }}" 
                                         alt="Foto bukti" 
                                         class="max-w-xs max-h-48 rounded-lg border">
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="remove_photo" value="1" 
                                                   class="rounded border-gray-300 text-red-600 focus:ring-red-500"
                                                   onchange="togglePhotoSection(this)">
                                            <span class="ml-2 text-sm text-red-600">Hapus foto ini</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Upload foto baru --}}
                            <div id="new-photo-section">
                                <input type="file" 
                                       name="photo_evidence" 
                                       id="photo_evidence"
                                       accept="image/jpeg,image/png,image/jpg,image/gif"
                                       class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:border-blue-500 focus:ring-blue-500"
                                       onchange="previewImage(this)">
                                <p class="text-sm text-gray-500 mt-1">
                                    @if($damageReport->photo_evidence)
                                        Upload foto baru untuk mengganti foto lama. 
                                    @endif
                                    Format: JPEG, PNG, JPG, GIF. Maks: 2MB
                                </p>
                            </div>
                            
                            @error('photo_evidence')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                            {{-- Preview foto baru --}}
                            <div id="image-preview" class="mt-3 hidden">
                                <p class="text-sm text-gray-600 mb-2">Preview foto baru:</p>
                                <img id="preview" src="" alt="Preview" class="max-w-xs max-h-48 rounded-lg border">
                            </div>
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

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        }

        function togglePhotoSection(checkbox) {
            const currentPhoto = document.getElementById('current-photo');
            if (checkbox.checked) {
                currentPhoto.classList.add('opacity-50');
            } else {
                currentPhoto.classList.remove('opacity-50');
            }
        }
    </script>
</x-app-layout>

