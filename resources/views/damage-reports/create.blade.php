<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan Kerusakan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('damage-reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
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
                                    <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
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
                                      placeholder="Jelaskan detail kerusakan yang terjadi..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Upload Foto Bukti --}}
                        <div class="mb-4">
                            <label for="photo_evidence" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Bukti Kerusakan (opsional)
                            </label>
                            <input type="file" 
                                   name="photo_evidence" 
                                   id="photo_evidence"
                                   accept="image/jpeg,image/png,image/jpg,image/gif"
                                   class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:border-blue-500 focus:ring-blue-500"
                                   onchange="previewImage(this)">
                            <p class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maks: 2MB</p>
                            @error('photo_evidence')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                            {{-- Preview gambar --}}
                            <div id="image-preview" class="mt-3 hidden">
                                <p class="text-sm text-gray-600 mb-2">Preview:</p>
                                <img id="preview" src="" alt="Preview" class="max-w-xs max-h-48 rounded-lg border">
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Kirim Laporan
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
    </script>
</x-app-layout>

