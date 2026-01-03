<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('assets.index') }}" class="text-brand-blue hover:text-brand-blue/80">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-xl text-brand-blue leading-tight">
                    Edit Asset
                </h2>
                <p class="text-sm text-gray-500">{{ $asset->code }} - {{ $asset->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="border-b border-gray-100 bg-gray-50 px-6 py-4">
                    <h3 class="font-semibold text-brand-blue flex items-center">
                        <span class="w-2 h-5 bg-brand-yellow rounded-full mr-2"></span>
                        Edit Informasi Asset
                    </h3>
                </div>
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('assets.update', $asset) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kode Asset --}}
                            <div>
                                <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kode Asset <span class="text-brand-red">*</span>
                                </label>
                                <input type="text" 
                                       name="code" 
                                       id="code"
                                       value="{{ old('code', $asset->code) }}"
                                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                       required>
                                @error('code')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nama Asset --}}
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Asset <span class="text-brand-red">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ old('name', $asset->name) }}"
                                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                       required>
                                @error('name')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kategori --}}
                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kategori <span class="text-brand-red">*</span>
                                </label>
                                <select name="category_id" 
                                        id="category_id"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                        required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Ruangan --}}
                            <div>
                                <label for="room_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Ruangan <span class="text-brand-red">*</span>
                                </label>
                                <select name="room_id" 
                                        id="room_id"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                        required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('room_id', $asset->room_id) == $room->id ? 'selected' : '' }}>
                                            {{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Brand --}}
                            <div>
                                <label for="brand" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Brand/Merk
                                </label>
                                <input type="text" 
                                       name="brand" 
                                       id="brand"
                                       value="{{ old('brand', $asset->brand) }}"
                                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition">
                                @error('brand')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Pembelian --}}
                            <div>
                                <label for="purchase_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Pembelian <span class="text-brand-red">*</span>
                                </label>
                                <input type="date" 
                                       name="purchase_date" 
                                       id="purchase_date"
                                       value="{{ old('purchase_date', $asset->purchase_date) }}"
                                       class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                       required>
                                @error('purchase_date')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kondisi --}}
                            <div class="md:col-span-2">
                                <label for="condition" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kondisi <span class="text-brand-red">*</span>
                                </label>
                                <select name="condition" 
                                        id="condition"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                        required>
                                    @foreach($conditions as $cond)
                                        <option value="{{ $cond }}" {{ old('condition', $asset->condition) == $cond ? 'selected' : '' }}>
                                            {{ ucfirst($cond) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('condition')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-brand-blue hover:bg-brand-blue/90 text-white font-semibold rounded-lg shadow-sm transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Asset
                            </button>
                            
                            <a href="{{ route('assets.index') }}" 
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

