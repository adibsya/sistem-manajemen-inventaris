{{-- Theme Toggle Button --}}
<button 
    x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true',
        init() {
            this.$watch('darkMode', val => {
                localStorage.setItem('darkMode', val);
                document.documentElement.classList.toggle('dark', val);
            });
            document.documentElement.classList.toggle('dark', this.darkMode);
        }
    }"
    @click="darkMode = !darkMode"
    class="p-2 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-700 dark:hover:text-slate-200 transition-all duration-200"
    title="Toggle Dark Mode"
>
    {{-- Sun Icon (shown in dark mode) --}}
    <svg x-show="darkMode" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 rotate-90 scale-0" x-transition:enter-end="opacity-100 rotate-0 scale-100" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
    </svg>
    
    {{-- Moon Icon (shown in light mode) --}}
    <svg x-show="!darkMode" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -rotate-90 scale-0" x-transition:enter-end="opacity-100 rotate-0 scale-100" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
    </svg>
</button>
