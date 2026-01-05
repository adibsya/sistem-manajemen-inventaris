<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-brand-blue leading-tight">
            👥 Kelola User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Action Button - Mobile View --}}
            <div class="mb-4 sm:hidden">
                <a href="{{ route('users.create') }}" 
                   class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-brand-blue hover:bg-brand-blue/90 text-white font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah User
                </a>
            </div>
            
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-brand-red/10 border border-brand-red/20 text-brand-red px-4 py-3 rounded-xl mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Role Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Admin</p>
                            <p class="text-2xl font-bold text-purple-600">{{ $users->where('role', 'admin')->count() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                            <span class="text-lg">👑</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-brand-blue">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Teknisi</p>
                            <p class="text-2xl font-bold text-brand-blue">{{ $users->where('role', 'teknisi')->count() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-brand-blue/10 rounded-full flex items-center justify-center">
                            <span class="text-lg">🔧</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Staff</p>
                            <p class="text-2xl font-bold text-green-600">{{ $users->where('role', 'staff')->count() }}</p>
                        </div>
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-lg">👤</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel User --}}
            <div class="bg-white overflow-hidden rounded-xl shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-brand-blue">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">User</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Role</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Bergabung</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full flex items-center justify-center text-white font-medium
                                                @if($user->role === 'admin') bg-purple-500
                                                @elseif($user->role === 'teknisi') bg-brand-blue
                                                @else bg-green-500
                                                @endif">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                                @if($user->id === auth()->id())
                                                    <span class="text-xs text-brand-blue font-medium">Anda</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <div>{{ $user->created_at->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('users.edit', $user) }}" 
                                               class="p-2 text-gray-500 hover:text-brand-yellow hover:bg-brand-yellow/10 rounded-lg transition"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="p-2 text-gray-500 hover:text-brand-red hover:bg-brand-red/10 rounded-lg transition"
                                                            title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <span class="text-3xl">👥</span>
                                            </div>
                                            <p class="text-gray-500 mb-2">Belum ada user.</p>
                                            <a href="{{ route('users.create') }}" class="text-brand-blue hover:text-brand-blue/80 font-medium">
                                                + Tambah user pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
