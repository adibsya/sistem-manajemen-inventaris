<nav x-data="{ open: false }" class="bg-brand-blue shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <span class="text-white font-bold text-xl">📦 E-SIMS</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out
                              {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        🏠 Dashboard
                    </a>
                    
                    <a href="{{ route('assets.index') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out
                              {{ request()->routeIs('assets.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        📋 Assets
                    </a>
                    
                    <a href="{{ route('categories.index') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out
                              {{ request()->routeIs('categories.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        🏷️ Kategori
                    </a>
                    
                    <a href="{{ route('rooms.index') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out
                              {{ request()->routeIs('rooms.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        🚪 Ruangan
                    </a>
                    
                    <a href="{{ route('damage-reports.index') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out
                              {{ request()->routeIs('damage-reports.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        ⚠️ Laporan
                    </a>
                    
                    <a href="{{ route('maintenance-logs.index') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out
                              {{ request()->routeIs('maintenance-logs.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        🔧 Perbaikan
                    </a>
                    
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('users.index') }}" 
                           class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out
                                  {{ request()->routeIs('users.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                            👥 Users
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-white/80 hover:text-white rounded-md hover:bg-white/10 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 bg-brand-yellow text-brand-blue font-bold rounded-full flex items-center justify-center text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span>{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs text-gray-500">Logged in as</p>
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->email }}</p>
                            <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full 
                                {{ Auth::user()->role === 'admin' ? 'bg-brand-red text-white' : 
                                   (Auth::user()->role === 'teknisi' ? 'bg-brand-blue text-white' : 'bg-gray-200 text-gray-700') }}">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            ⚙️ {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                🚪 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white/70 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-brand-blue/95">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                🏠 Dashboard
            </a>
            
            <a href="{{ route('assets.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('assets.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                📋 Assets
            </a>
            
            <a href="{{ route('categories.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('categories.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                🏷️ Kategori
            </a>
            
            <a href="{{ route('rooms.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('rooms.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                🚪 Ruangan
            </a>
            
            <a href="{{ route('damage-reports.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('damage-reports.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                ⚠️ Laporan Kerusakan
            </a>
            
            <a href="{{ route('maintenance-logs.index') }}" 
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('maintenance-logs.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                🔧 Riwayat Perbaikan
            </a>
            
            @if(Auth::user()->isAdmin())
                <a href="{{ route('users.index') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('users.*') ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    👥 Kelola Users
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-white/20">
            <div class="flex items-center px-4">
                <div class="w-10 h-10 bg-brand-yellow text-brand-blue font-bold rounded-full flex items-center justify-center">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="ms-3">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white/60">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('profile.edit') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium text-white/70 hover:text-white hover:bg-white/10">
                    ⚙️ Profile
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-white/70 hover:text-white hover:bg-white/10">
                        🚪 Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>


