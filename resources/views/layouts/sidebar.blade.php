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
       class="fixed inset-y-0 left-0 z-50 w-56 bg-brand-blue flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0">
    
    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between h-16 px-4 border-b border-white/20 flex-shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <span class="text-2xl">📦</span>
            <span class="text-white font-bold text-xl tracking-tight">E-SIMS</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-white hover:bg-white/20 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    
    {{-- Sidebar Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-hide">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('dashboard') ? 'bg-brand-yellow text-brand-blue' : 'text-white hover:bg-white/15' }}">
            <span class="text-lg">🏠</span>
            <span>Dashboard</span>
        </a>
        
        {{-- Section: Data Master --}}
        <div class="pt-5 pb-2">
            <p class="px-3 text-xs font-bold text-white/50 uppercase tracking-wider">Data Master</p>
        </div>
        
        <a href="{{ route('assets.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('assets.*') ? 'bg-brand-yellow text-brand-blue' : 'text-white hover:bg-white/15' }}">
            <span class="text-lg">📋</span>
            <span>Assets</span>
        </a>
        
        <a href="{{ route('categories.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('categories.*') ? 'bg-brand-yellow text-brand-blue' : 'text-white hover:bg-white/15' }}">
            <span class="text-lg">🏷️</span>
            <span>Kategori</span>
        </a>
        
        <a href="{{ route('rooms.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('rooms.*') ? 'bg-brand-yellow text-brand-blue' : 'text-white hover:bg-white/15' }}">
            <span class="text-lg">🚪</span>
            <span>Ruangan</span>
        </a>
        
        {{-- Section: Laporan --}}
        <div class="pt-5 pb-2">
            <p class="px-3 text-xs font-bold text-white/50 uppercase tracking-wider">Laporan</p>
        </div>
        
        <a href="{{ route('damage-reports.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('damage-reports.*') ? 'bg-brand-yellow text-brand-blue' : 'text-white hover:bg-white/15' }}">
            <span class="text-lg">⚠️</span>
            <span>Laporan Kerusakan</span>
        </a>
        
        <a href="{{ route('maintenance-logs.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('maintenance-logs.*') ? 'bg-brand-yellow text-brand-blue' : 'text-white hover:bg-white/15' }}">
            <span class="text-lg">🔧</span>
            <span>Riwayat Perbaikan</span>
        </a>
        
        {{-- Section: Admin --}}
        @if(Auth::user()->isAdmin())
            <div class="pt-5 pb-2">
                <p class="px-3 text-xs font-bold text-white/50 uppercase tracking-wider">Admin</p>
            </div>
            
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                      {{ request()->routeIs('users.*') ? 'bg-brand-yellow text-brand-blue' : 'text-white hover:bg-white/15' }}">
                <span class="text-lg">👥</span>
                <span>Kelola Users</span>
            </a>
        @endif
    </nav>
    
    {{-- Sidebar Footer / User Info --}}
    <div class="border-t border-white/20 p-4 flex-shrink-0 bg-brand-blue">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-brand-yellow text-brand-blue font-bold rounded-full flex items-center justify-center text-sm flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-white/70 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 text-center px-3 py-2 text-xs font-semibold text-white bg-white/15 hover:bg-white/25 rounded-lg transition">
                ⚙️ Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full px-3 py-2 text-xs font-semibold text-white bg-white/15 hover:bg-brand-red rounded-lg transition">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
</aside>
