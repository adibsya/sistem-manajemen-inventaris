<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Asset') }}: {{ $asset->code }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('assets.update', $asset) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kode Asset --}}
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kode Asset <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="code" 
                                       id="code"
                                       value="{{ old('code', $asset->code) }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('code')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nama Asset --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Asset <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ old('name', $asset->name) }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kategori --}}
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category_id" 
                                        id="category_id"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Ruangan --}}
                            <div>
                                <label for="room_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ruangan <span class="text-red-500">*</span>
                                </label>
                                <select name="room_id" 
                                        id="room_id"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('room_id', $asset->room_id) == $room->id ? 'selected' : '' }}>
                                            {{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Brand --}}
                            <div>
                                <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">
                                    Brand/Merk
                                </label>
                                <input type="text" 
                                       name="brand" 
                                       id="brand"
                                       value="{{ old('brand', $asset->brand) }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('brand')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Pembelian --}}
                            <div>
                                <label for="purchase_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Pembelian <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       name="purchase_date" 
                                       id="purchase_date"
                                       value="{{ old('purchase_date', $asset->purchase_date) }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                                @error('purchase_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kondisi --}}
                            <div class="md:col-span-2">
                                <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kondisi <span class="text-red-500">*</span>
                                </label>
                                <select name="condition" 
                                        id="condition"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    @foreach($conditions as $cond)
                                        <option value="{{ $cond }}" {{ old('condition', $asset->condition) == $cond ? 'selected' : '' }}>
                                            {{ ucfirst($cond) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('condition')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Asset
                            </button>
                            
                            <a href="{{ route('assets.index') }}" 
                               class="text-gray-600 hover:text-gray-900">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
