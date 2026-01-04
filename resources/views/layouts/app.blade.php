<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <div class="min-h-screen bg-brand-cream flex">
            
            {{-- Sidebar --}}
            @include('layouts.sidebar')
            
            {{-- Main Content --}}
            <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
                {{-- Top Bar --}}
                <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
                    <div class="flex items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
                        {{-- Hamburger Button (Mobile) --}}
                        <button @click="sidebarOpen = true" 
                                class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-brand-blue transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        
                        {{-- Page Heading --}}
                        @isset($header)
                            <div class="flex-1 lg:flex-none">
                                {{ $header }}
                            </div>
                        @endisset
                        
                        {{-- User Dropdown (Desktop) --}}
                        <div class="hidden lg:flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                                        <span class="w-8 h-8 bg-brand-blue text-white font-bold rounded-full flex items-center justify-center text-sm">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="px-4 py-2 border-b border-gray-100">
                                        <p class="text-xs text-gray-500">Logged in as</p>
                                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->email }}</p>
                                        <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full 
                                            {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-700' : 
                                               (Auth::user()->role === 'teknisi' ? 'bg-brand-blue/10 text-brand-blue' : 'bg-green-100 text-green-700') }}">
                                            {{ ucfirst(Auth::user()->role) }}
                                        </span>
                                    </div>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        ⚙️ {{ __('Profile') }}
                                    </x-dropdown-link>
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
                    </div>
                </header>

                {{-- Page Content --}}
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
