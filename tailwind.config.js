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
                // New Professional Color Palette (Cream & Blue Theme)
                'primary': {
                    50: '#f0f3f9',
                    100: '#dde6f2',
                    200: '#bfd0e8',
                    300: '#94b3db',
                    400: '#6491cc',
                    500: '#4a70a9', // Main Brand Blue
                    600: '#38578a',
                    700: '#2e456e',
                    800: '#283c5c',
                    900: '#24334d',
                    950: '#182131',
                },
                'secondary': {
                    50: '#f4f7fb',
                    100: '#e5ecf6',
                    200: '#cddbee',
                    300: '#a8c2e2',
                    400: '#8fabd4', // Secondary Blue
                    500: '#6a8dbb',
                    600: '#5272a0',
                    700: '#435c82',
                    800: '#3a4c6a',
                    900: '#334057',
                    950: '#222938',
                },
                'cream': {
                    50: '#fbfbf9',
                    100: '#f7f6f1',
                    200: '#efece3', // Main Background Cream
                    300: '#e3dfcd',
                    400: '#d0c9a9',
                    500: '#b6ad87',
                    600: '#9a906b',
                    700: '#7d7456',
                    800: '#675f48',
                    900: '#554f3d',
                    950: '#2d2a20',
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

