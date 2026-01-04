<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('damage-reports.index') }}" class="text-brand-blue hover:text-brand-blue/80 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-xl text-brand-blue leading-tight">
                    Edit Laporan Kerusakan
                </h2>
                <p class="text-sm text-gray-500">Update informasi atau status laporan</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="border-b border-gray-100 bg-brand-red/5 px-6 py-4">
                    <h3 class="font-semibold text-brand-red flex items-center">
                        <span class="w-2 h-5 bg-brand-red rounded-full mr-2"></span>
                        ⚠️ Update Laporan
                    </h3>
                </div>
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('damage-reports.update', $damageReport) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Pilih Asset --}}
                        <div class="mb-6">
                            <label for="asset_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Asset yang Rusak <span class="text-brand-red">*</span>
                            </label>
                            <select name="asset_id" 
                                    id="asset_id"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-red focus:ring-brand-red transition"
                                    required>
                                <option value="">-- Pilih Asset --</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}" {{ old('asset_id', $damageReport->asset_id) == $asset->id ? 'selected' : '' }}>
                                        [{{ $asset->code }}] {{ $asset->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('asset_id')
                                <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi Kerusakan --}}
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Kerusakan <span class="text-brand-red">*</span>
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      rows="5"
                                      class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-red focus:ring-brand-red transition"
                                      required>{{ old('description', $damageReport->description) }}</textarea>
                            @error('description')
                                <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Foto Bukti --}}
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                📷 Foto Bukti Kerusakan
                            </label>
                            
                            {{-- Foto existing --}}
                            @if($damageReport->photo_evidence)
                                <div class="mb-4 p-4 bg-gray-50 rounded-xl border border-gray-100" id="current-photo">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $damageReport->photo_evidence) }}" 
                                         alt="Foto bukti" 
                                         class="max-w-xs max-h-48 rounded-lg border shadow-sm">
                                    <div class="mt-3">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="remove_photo" value="1" 
                                                   class="w-4 h-4 rounded border-gray-300 text-brand-red focus:ring-brand-red"
                                                   onchange="togglePhotoSection(this)">
                                            <span class="ml-2 text-sm text-brand-red font-medium">Hapus foto ini</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Upload foto baru --}}
                            <div id="new-photo-section" class="border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-brand-red/50 transition">
                                <input type="file" 
                                       name="photo_evidence" 
                                       id="photo_evidence"
                                       accept="image/jpeg,image/png,image/jpg,image/gif"
                                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-brand-red/10 file:text-brand-red file:font-medium hover:file:bg-brand-red/20 file:transition"
                                       onchange="previewImage(this)">
                                <p class="text-xs text-gray-500 mt-2">
                                    @if($damageReport->photo_evidence)
                                        Upload foto baru untuk mengganti foto lama. 
                                    @endif
                                    Format: JPEG, PNG, JPG, GIF. Maks: 2MB
                                </p>
                            </div>
                            
                            @error('photo_evidence')
                                <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                            {{-- Preview foto baru --}}
                            <div id="image-preview" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2 font-medium">Preview foto baru:</p>
                                <img id="preview" src="" alt="Preview" class="max-w-xs max-h-48 rounded-lg border shadow-sm">
                            </div>
                        </div>

                        {{-- Status (untuk admin/teknisi) --}}
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status <span class="text-brand-red">*</span>
                            </label>
                            <select name="status" 
                                    id="status"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-red focus:ring-brand-red transition"
                                    required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $damageReport->status) == $status ? 'selected' : '' }}>
                                        @if($status === 'pending') ⏳
                                        @elseif($status === 'process') 🔧
                                        @elseif($status === 'fixed') ✓
                                        @else ✕
                                        @endif
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 flex flex-wrap gap-2 text-xs">
                                <span class="px-2 py-1 bg-brand-yellow/20 text-yellow-700 rounded">Pending: Menunggu</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded">Process: Sedang diperbaiki</span>
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded">Fixed: Selesai</span>
                                <span class="px-2 py-1 bg-brand-red/10 text-brand-red rounded">Rejected: Ditolak</span>
                            </div>
                            @error('status')
                                <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-brand-red hover:bg-brand-red/90 text-white font-semibold rounded-lg shadow-sm transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Laporan
                            </button>
                            <a href="{{ route('damage-reports.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                                Batal
                            </a>
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
