{{-- Sidebar Overlay (Mobile) --}}
<div x-show="sidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden"
     style="display: none;">
</div>

{{-- Sidebar --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-50 w-72 bg-primary-600 dark:bg-slate-900 flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 rounded-r-3xl shadow-2xl lg:shadow-none lg:rounded-none">
    
    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between h-20 px-8 flex-shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                <x-icon name="cube" class="w-6 h-6 text-primary-600" />
            </div>
            <span class="text-white font-bold text-xl tracking-tight">E-SIMS</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
            <x-icon name="x-mark" class="w-6 h-6" />
        </button>
    </div>
    
    {{-- Sidebar Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto scrollbar-thin">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-full font-medium transition-all group
                  {{ request()->routeIs('dashboard') ? 'bg-white text-primary-700 shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <x-icon name="dashboard" class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-primary-600' : 'text-white/70 group-hover:text-white' }}" />
            <span>Dashboard</span>
        </a>
        
        {{-- Section: Data Master --}}
        <div class="pt-6 pb-3 px-4">
            <p class="text-xs font-bold text-white/40 uppercase tracking-widest">Data Master</p>
        </div>
        
        <a href="{{ route('assets.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-full font-medium transition-all group
                  {{ request()->routeIs('assets.*') ? 'bg-white text-primary-700 shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <x-icon name="assets" class="w-5 h-5 {{ request()->routeIs('assets.*') ? 'text-primary-600' : 'text-white/70 group-hover:text-white' }}" />
            <span>Assets</span>
        </a>
        
        <a href="{{ route('categories.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-full font-medium transition-all group
                  {{ request()->routeIs('categories.*') ? 'bg-white text-primary-700 shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <x-icon name="category" class="w-5 h-5 {{ request()->routeIs('categories.*') ? 'text-primary-600' : 'text-white/70 group-hover:text-white' }}" />
            <span>Kategori</span>
        </a>
        
        <a href="{{ route('rooms.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-full font-medium transition-all group
                  {{ request()->routeIs('rooms.*') ? 'bg-white text-primary-700 shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <x-icon name="room" class="w-5 h-5 {{ request()->routeIs('rooms.*') ? 'text-primary-600' : 'text-white/70 group-hover:text-white' }}" />
            <span>Ruangan</span>
        </a>
        
        {{-- Section: Laporan --}}
        <div class="pt-6 pb-3 px-4">
            <p class="text-xs font-bold text-white/40 uppercase tracking-widest">Laporan</p>
        </div>
        
        <a href="{{ route('damage-reports.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-full font-medium transition-all group
                  {{ request()->routeIs('damage-reports.*') ? 'bg-white text-primary-700 shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <x-icon name="report" class="w-5 h-5 {{ request()->routeIs('damage-reports.*') ? 'text-primary-600' : 'text-white/70 group-hover:text-white' }}" />
            <span>Laporan Kerusakan</span>
        </a>
        
        <a href="{{ route('maintenance-logs.index') }}" 
           class="flex items-center gap-3.5 px-4 py-3 rounded-full font-medium transition-all group
                  {{ request()->routeIs('maintenance-logs.*') ? 'bg-white text-primary-700 shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
            <x-icon name="maintenance" class="w-5 h-5 {{ request()->routeIs('maintenance-logs.*') ? 'text-primary-600' : 'text-white/70 group-hover:text-white' }}" />
            <span>Riwayat Perbaikan</span>
        </a>
        
        {{-- Section: Admin --}}
        @if(Auth::user()->isAdmin())
            <div class="pt-6 pb-3 px-4">
                <p class="text-xs font-bold text-white/40 uppercase tracking-widest">Admin</p>
            </div>
            
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-full font-medium transition-all group
                      {{ request()->routeIs('users.*') ? 'bg-white text-primary-700 shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <x-icon name="users" class="w-5 h-5 {{ request()->routeIs('users.*') ? 'text-primary-600' : 'text-white/70 group-hover:text-white' }}" />
                <span>Kelola Users</span>
            </a>
        @endif
    </nav>
    
    {{-- Sidebar Footer / User Info --}}
    <div class="px-6 py-6 border-t border-white/10 flex-shrink-0">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-white/10 backdrop-blur-sm font-bold rounded-xl flex items-center justify-center text-sm text-white flex-shrink-0 border border-white/10">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-white/60 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 text-center px-3 py-2 text-xs font-semibold text-white bg-white/10 hover:bg-white/20 rounded-lg transition flex items-center justify-center gap-2">
                <x-icon name="cog" class="w-3.5 h-3.5" />
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full px-3 py-2 text-xs font-semibold text-white bg-white/10 hover:bg-rose-500/80 hover:text-white rounded-lg transition flex items-center justify-center gap-2">
                    <x-icon name="logout" class="w-3.5 h-3.5" />
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>
