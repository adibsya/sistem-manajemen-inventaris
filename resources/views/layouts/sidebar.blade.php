{{-- Sidebar Overlay (Mobile) --}}
<div x-show="sidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-black/50 z-40 lg:hidden"
     style="display: none;">
</div>

{{-- Sidebar --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed top-0 left-0 z-50 w-64 h-screen bg-brand-blue transition-transform duration-300 ease-in-out lg:translate-x-0">
    
    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between h-16 px-4 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <span class="text-2xl">📦</span>
            <span class="text-white font-bold text-xl">E-SIMS</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-white/70 hover:text-white hover:bg-white/10 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    
    {{-- Sidebar Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                  {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
            <span class="text-lg">🏠</span>
            <span class="font-medium">Dashboard</span>
        </a>
        
        {{-- Section: Data Master --}}
        <div class="pt-4">
            <p class="px-3 text-xs font-semibold text-white/40 uppercase tracking-wider">Data Master</p>
        </div>
        
        <a href="{{ route('assets.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                  {{ request()->routeIs('assets.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
            <span class="text-lg">📋</span>
            <span class="font-medium">Assets</span>
        </a>
        
        <a href="{{ route('categories.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                  {{ request()->routeIs('categories.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
            <span class="text-lg">🏷️</span>
            <span class="font-medium">Kategori</span>
        </a>
        
        <a href="{{ route('rooms.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                  {{ request()->routeIs('rooms.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
            <span class="text-lg">🚪</span>
            <span class="font-medium">Ruangan</span>
        </a>
        
        {{-- Section: Laporan --}}
        <div class="pt-4">
            <p class="px-3 text-xs font-semibold text-white/40 uppercase tracking-wider">Laporan</p>
        </div>
        
        <a href="{{ route('damage-reports.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                  {{ request()->routeIs('damage-reports.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
            <span class="text-lg">⚠️</span>
            <span class="font-medium">Laporan Kerusakan</span>
        </a>
        
        <a href="{{ route('maintenance-logs.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                  {{ request()->routeIs('maintenance-logs.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
            <span class="text-lg">🔧</span>
            <span class="font-medium">Riwayat Perbaikan</span>
        </a>
        
        {{-- Section: Admin --}}
        @if(Auth::user()->isAdmin())
            <div class="pt-4">
                <p class="px-3 text-xs font-semibold text-white/40 uppercase tracking-wider">Admin</p>
            </div>
            
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition
                      {{ request()->routeIs('users.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                <span class="text-lg">👥</span>
                <span class="font-medium">Kelola Users</span>
            </a>
        @endif
    </nav>
    
    {{-- Sidebar Footer / User Info --}}
    <div class="border-t border-white/10 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-brand-yellow text-brand-blue font-bold rounded-full flex items-center justify-center">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-white/60 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="mt-3 flex gap-2">
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 text-center px-3 py-1.5 text-xs font-medium text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-lg transition">
                ⚙️ Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full px-3 py-1.5 text-xs font-medium text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-lg transition">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
</aside>
