import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // No 'darkMode' setting needed for a single fixed theme.

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans], // Changed to Inter font
            },
            colors: {
                // Main backgrounds and text for a dark theme
                'deep-black': '#000000', // Pure black
                'dark-gray': '#1a1a1d',  // Very dark grey for main containers
                'medium-gray': '#2b2b2e', // Slightly lighter dark grey for cards/sections
                'light-gray-text': '#d4d4d4', // Light grey for primary text
                'faded-gray-text': '#a0a0a0', // Faded grey for secondary text/descriptions

                // Primary Blue for accents, buttons, links, highlights
                'accent-blue': {
                    50: '#e0f2fe',
                    100: '#bae6fd',
                    200: '#7dd3fc',
                    300: '#38bdf8',
                    400: '#0ea5e9',
                    500: '#007bff', // Main accent blue
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                    950: '#082f49',
                },
                // A slightly different blue for subtle variations or secondary actions
                'secondary-accent-blue': {
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
            },
        },
    },

    plugins: [forms],
};
