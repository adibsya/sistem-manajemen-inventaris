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
       class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0">
    
    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between h-16 px-5 border-b border-slate-700/50 flex-shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                <x-icon name="cube" class="w-5 h-5 text-white" />
            </div>
            <span class="text-white font-bold text-lg tracking-tight">E-SIMS</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition">
            <x-icon name="x-mark" class="w-5 h-5" />
        </button>
    </div>
    
    {{-- Sidebar Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('dashboard') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <x-icon name="dashboard" class="w-5 h-5" />
            <span>Dashboard</span>
        </a>
        
        {{-- Section: Data Master --}}
        <div class="pt-6 pb-2">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Data Master</p>
        </div>
        
        <a href="{{ route('assets.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('assets.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <x-icon name="assets" class="w-5 h-5" />
            <span>Assets</span>
        </a>
        
        <a href="{{ route('categories.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('categories.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <x-icon name="category" class="w-5 h-5" />
            <span>Kategori</span>
        </a>
        
        <a href="{{ route('rooms.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('rooms.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <x-icon name="room" class="w-5 h-5" />
            <span>Ruangan</span>
        </a>
        
        {{-- Section: Laporan --}}
        <div class="pt-6 pb-2">
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Laporan</p>
        </div>
        
        <a href="{{ route('damage-reports.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('damage-reports.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <x-icon name="report" class="w-5 h-5" />
            <span>Laporan Kerusakan</span>
        </a>
        
        <a href="{{ route('maintenance-logs.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                  {{ request()->routeIs('maintenance-logs.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <x-icon name="maintenance" class="w-5 h-5" />
            <span>Riwayat Perbaikan</span>
        </a>
        
        {{-- Section: Admin --}}
        @if(Auth::user()->isAdmin())
            <div class="pt-6 pb-2">
                <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Admin</p>
            </div>
            
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition
                      {{ request()->routeIs('users.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <x-icon name="users" class="w-5 h-5" />
                <span>Kelola Users</span>
            </a>
        @endif
    </nav>
    
    {{-- Sidebar Footer / User Info --}}
    <div class="border-t border-slate-700/50 p-4 flex-shrink-0">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 font-bold rounded-full flex items-center justify-center text-sm text-white flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 text-center px-3 py-2 text-xs font-semibold text-slate-300 bg-slate-800 hover:bg-slate-700 rounded-lg transition flex items-center justify-center gap-1.5">
                <x-icon name="cog" class="w-3.5 h-3.5" />
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" 
                        class="w-full px-3 py-2 text-xs font-semibold text-slate-300 bg-slate-800 hover:bg-rose-600 hover:text-white rounded-lg transition flex items-center justify-center gap-1.5">
                    <x-icon name="logout" class="w-3.5 h-3.5" />
                    Logout
                </button>
            </form>
        </div>
    </div>
</aside>
