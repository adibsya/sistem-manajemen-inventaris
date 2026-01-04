<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('users.index') }}" class="text-brand-blue hover:text-brand-blue/80 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-xl text-brand-blue leading-tight">
                    Edit User
                </h2>
                <p class="text-sm text-gray-500">{{ $user->name }} - {{ $user->email }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="border-b border-gray-100 bg-gray-50 px-6 py-4 flex justify-between items-center">
                    <h3 class="font-semibold text-brand-blue flex items-center">
                        <span class="w-2 h-5 bg-brand-yellow rounded-full mr-2"></span>
                        ✏️ Edit Informasi User
                    </h3>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                        @if($user->role === 'admin') bg-purple-100 text-purple-700
                        @elseif($user->role === 'teknisi') bg-brand-blue/10 text-brand-blue
                        @else bg-green-100 text-green-700
                        @endif">
                        @if($user->role === 'admin') 👑
                        @elseif($user->role === 'teknisi') 🔧
                        @else 👤
                        @endif
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama --}}
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-brand-red">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           name="name" 
                                           id="name"
                                           value="{{ old('name', $user->name) }}"
                                           class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                           required>
                                </div>
                                @error('name')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email <span class="text-brand-red">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                    <input type="email" 
                                           name="email" 
                                           id="email"
                                           value="{{ old('email', $user->email) }}"
                                           class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                           required>
                                </div>
                                @error('email')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password (Opsional) --}}
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Password Baru <span class="text-gray-400 font-normal">(opsional)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input type="password" 
                                           name="password" 
                                           id="password"
                                           class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                           placeholder="Kosongkan jika tidak diubah">
                                </div>
                                @error('password')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Konfirmasi Password Baru
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <input type="password" 
                                           name="password_confirmation" 
                                           id="password_confirmation"
                                           class="w-full pl-10 border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                           placeholder="Ulangi password baru">
                                </div>
                            </div>

                            {{-- Role --}}
                            <div class="md:col-span-2">
                                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Role <span class="text-brand-red">*</span>
                                </label>
                                <select name="role" 
                                        id="role"
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-brand-blue focus:ring-brand-blue transition"
                                        required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                            @if($role === 'admin') 👑
                                            @elseif($role === 'teknisi') 🔧
                                            @else 👤
                                            @endif
                                            {{ ucfirst($role) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="mt-3 flex flex-wrap gap-2 text-xs">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded">👑 Admin: Akses penuh</span>
                                    <span class="px-2 py-1 bg-brand-blue/10 text-brand-blue rounded">🔧 Teknisi: Kelola perbaikan</span>
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded">👤 Staff: Lihat & lapor</span>
                                </div>
                                @error('role')
                                    <p class="text-brand-red text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-brand-blue hover:bg-brand-blue/90 text-white font-semibold rounded-lg shadow-sm transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update User
                            </button>
                            <a href="{{ route('users.index') }}" 
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
