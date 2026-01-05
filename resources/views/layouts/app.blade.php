<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); document.documentElement.classList.toggle('dark', darkMode)" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-SIMS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen bg-cream-200 dark:bg-slate-900 flex">
            
            {{-- Sidebar --}}
            @include('layouts.sidebar')
            
            {{-- Main Content --}}
            <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
                {{-- Top Bar --}}
                <header class="bg-white dark:bg-slate-800 shadow-sm border-b border-slate-200 dark:border-slate-700 sticky top-0 z-30">
                    <div class="flex items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
                        {{-- Hamburger Button (Mobile) --}}
                        <button @click="sidebarOpen = true" 
                                class="lg:hidden p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-primary-600 dark:hover:text-primary-400 transition">
                            <x-icon name="menu" class="w-6 h-6" />
                        </button>
                        
                        {{-- Page Heading --}}
                        @isset($header)
                            <div class="flex-1">
                                {{ $header }}
                            </div>
                        @endisset
                        
                        {{-- Right Side Actions --}}
                        <div class="flex items-center gap-3">
                            {{-- Date (Hidden on smaller screens) --}}
                            <div class="hidden xl:flex items-center">
                                <span class="text-sm text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 px-3 py-1.5 rounded-lg whitespace-nowrap flex items-center gap-2">
                                    <x-icon name="calendar" class="w-4 h-4" />
                                    {{ now()->format('D, d M Y') }}
                                </span>
                            </div>

                            {{-- Theme Toggle --}}
                            <button @click="darkMode = !darkMode"
                                    class="p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-700 dark:hover:text-slate-200 transition-all duration-200"
                                    title="Toggle Dark Mode">
                                <x-icon x-show="!darkMode" name="moon" class="w-5 h-5" />
                                <x-icon x-show="darkMode" name="sun" class="w-5 h-5" />
                            </button>
                            
                            {{-- User Dropdown (Desktop) --}}
                            <div class="hidden lg:flex items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                                            <span class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-700 text-white font-bold rounded-full flex items-center justify-center text-sm">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </span>
                                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                            <x-icon name="chevron-down" class="w-4 h-4 text-slate-400" />
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700">
                                            <p class="text-xs text-slate-500 dark:text-slate-400">Logged in as</p>
                                            <p class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ Auth::user()->email }}</p>
                                            <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full 
                                                {{ Auth::user()->role === 'admin' ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300' : 
                                                   (Auth::user()->role === 'teknisi' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300') }}">
                                                {{ ucfirst(Auth::user()->role) }}
                                            </span>
                                        </div>
                                        <x-dropdown-link :href="route('profile.edit')">
                                            <x-icon name="cog" class="w-4 h-4 mr-2" />
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                <x-icon name="logout" class="w-4 h-4 mr-2" />
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </header>

                {{-- Page Content --}}
                <main class="flex-1">
                    {{-- Toast Notifications --}}
                    @if (session('warning'))
                        <div x-data="{ show: true }" 
                             x-show="show" 
                             x-init="setTimeout(() => show = false, 5000)"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform translate-y-2"
                             class="fixed top-20 right-4 z-50 max-w-sm">
                            <div class="bg-amber-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
                                <x-icon name="exclamation-triangle" class="w-5 h-5 flex-shrink-0" />
                                <p class="font-medium text-sm">{{ session('warning') }}</p>
                                <button @click="show = false" class="ml-auto p-1 hover:bg-white/20 rounded transition">
                                    <x-icon name="x-mark" class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div x-data="{ show: true }" 
                             x-show="show" 
                             x-init="setTimeout(() => show = false, 4000)"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform translate-y-2"
                             class="fixed top-20 right-4 z-50 max-w-sm">
                            <div class="bg-emerald-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
                                <x-icon name="check-circle" class="w-5 h-5 flex-shrink-0" />
                                <p class="font-medium text-sm">{{ session('success') }}</p>
                                <button @click="show = false" class="ml-auto p-1 hover:bg-white/20 rounded transition">
                                    <x-icon name="x-mark" class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div x-data="{ show: true }" 
                             x-show="show" 
                             x-init="setTimeout(() => show = false, 6000)"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform translate-y-2"
                             class="fixed top-20 right-4 z-50 max-w-sm">
                            <div class="bg-rose-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
                                <x-icon name="x-circle" class="w-5 h-5 flex-shrink-0" />
                                <p class="font-medium text-sm">{{ session('error') }}</p>
                                <button @click="show = false" class="ml-auto p-1 hover:bg-white/20 rounded transition">
                                    <x-icon name="x-mark" class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
