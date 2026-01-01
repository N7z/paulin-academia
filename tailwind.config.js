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
            colors: {
                brand: {
                    DEFAULT: '#6366f1',      // bg-brand
                    strong: '#4f46e5',       // bg-brand-strong
                    medium: '#818cf8',       // ring-brand-medium
                },

                fg: {
                    brand: '#6366f1',        // text-fg-brand
                },

                neutral: {
                    'primary-soft': '#f5f5f5',
                    'secondary-medium': '#e5e5e5',
                },

                dark: '#1f2937',
            },
        },
    },

    plugins: [forms],
};
