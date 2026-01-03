<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-brand-blue">Selamat Datang! 👋</h2>
        <p class="text-gray-500 mt-2">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                Email
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-blue focus:ring-brand-blue transition"
                       placeholder="nama@email.com"
                       required 
                       autofocus 
                       autocomplete="username">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="password" 
                       type="password" 
                       name="password"
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-blue focus:ring-brand-blue transition"
                       placeholder="••••••••"
                       required 
                       autocomplete="current-password">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-5">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       class="w-4 h-4 rounded border-gray-300 text-brand-blue shadow-sm focus:ring-brand-blue" 
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-brand-blue hover:text-brand-blue/80 font-medium transition" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-8">
            <button type="submit" 
                    class="w-full py-3.5 px-4 bg-brand-blue hover:bg-brand-blue/90 text-white font-semibold rounded-xl shadow-lg shadow-brand-blue/30 transition transform hover:scale-[1.02] active:scale-[0.98]">
                Masuk
            </button>
        </div>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-brand-blue hover:text-brand-blue/80 font-semibold transition">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
