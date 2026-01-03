import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
                // Custom E-SIMS Brand Colors
                'brand': {
                    'blue': '#134686',      // Primary - Sidebar, Headers
                    'red': '#ed3f27',       // Secondary - CTA, Danger
                    'yellow': '#feb21a',    // Accent - Warnings, Highlights
                    'cream': '#fdf4e3',     // Background
                },
            },
        },
    },

    plugins: [forms],
};

