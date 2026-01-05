import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Professional E-SIMS Color Palette
                'primary': {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                },
                'surface': {
                    // Light mode surfaces
                    'light': '#ffffff',
                    'light-alt': '#f8fafc',
                    'light-hover': '#f1f5f9',
                    // Dark mode surfaces
                    'dark': '#0f172a',
                    'dark-alt': '#1e293b',
                    'dark-hover': '#334155',
                },
                // Legacy brand colors (for backwards compatibility)
                'brand': {
                    'blue': '#1e40af',
                    'red': '#e11d48',
                    'yellow': '#f59e0b',
                    'cream': '#f8fafc',
                },
            },
        },
    },

    plugins: [forms],
};

