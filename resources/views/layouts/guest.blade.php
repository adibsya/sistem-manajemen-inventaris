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
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex">
            <!-- Left Panel - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-brand-blue relative overflow-hidden">
                <!-- Abstract Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-20 left-20 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-32 right-10 w-96 h-96 bg-brand-yellow rounded-full blur-3xl"></div>
                    <div class="absolute top-1/2 left-1/3 w-48 h-48 bg-brand-red rounded-full blur-2xl"></div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                    <!-- Logo -->
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                <span class="text-3xl">📦</span>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold">E-SIMS</h1>
                                <p class="text-white/70 text-sm">Inventory Management System</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Headline -->
                    <h2 class="text-4xl font-bold leading-tight mb-6">
                        Kelola Inventaris<br>
                        <span class="text-brand-yellow">Lebih Mudah & Efisien</span>
                    </h2>
                    
                    <p class="text-white/80 text-lg mb-10 max-w-md">
                        Sistem manajemen inventaris modern untuk tracking aset, laporan kerusakan, dan riwayat perbaikan.
                    </p>
                    
                    <!-- Features -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <span class="text-lg">✓</span>
                            </div>
                            <span class="text-white/90">Tracking aset real-time</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <span class="text-lg">✓</span>
                            </div>
                            <span class="text-white/90">Laporan kerusakan instan</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <span class="text-lg">✓</span>
                            </div>
                            <span class="text-white/90">Export laporan PDF</span>
                        </div>
                    </div>
                </div>
                
                <!-- Bottom decoration -->
                <div class="absolute bottom-8 left-16 text-white/50 text-sm">
                    © {{ date('Y') }} E-SIMS. All rights reserved.
                </div>
            </div>
            
            <!-- Right Panel - Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-12 bg-brand-cream">
                <!-- Mobile Logo -->
                <div class="lg:hidden mb-8 text-center">
                    <div class="flex items-center justify-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-brand-blue rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📦</span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-brand-blue">E-SIMS</h1>
                        </div>
                    </div>
                </div>
                
                <!-- Form Card -->
                <div class="w-full max-w-md">
                    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8">
                        {{ $slot }}
                    </div>
                    
                    <!-- Footer -->
                    <p class="text-center text-gray-500 text-sm mt-8 lg:hidden">
                        © {{ date('Y') }} E-SIMS. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
