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
                sans: ['Manrope', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    light: '#7F9CF5',
                    DEFAULT: '#3B82F6',
                    dark: '#1E3A8A',
                },
                accent: {
                    light: '#A78BFA',
                    DEFAULT: '#8B5CF6',
                    dark: '#6D28D9',
                },
                glass: 'rgba(255,255,255,0.7)',
                darkglass: 'rgba(30,41,59,0.7)',
                gradient1: '#3B82F6',
                gradient2: '#8B5CF6',
                gradient3: '#F472B6',
            },
        },
    },

    plugins: [forms],
};
