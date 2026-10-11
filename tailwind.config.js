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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#0D0D0D',
                background: '#FFFFFF',
                neutral: '#F5F5F7',
                border: '#E5E5EA',
                success: '#34C759',
                warning: '#FF9500',
                error: '#FF3B30',
                stabilo: '#c2fa0a',
            },
            boxShadow: {
                'card': '0 8px 24px rgba(0, 0, 0, 0.06)',
                'stabilo': '0 4px 12px rgba(194, 250, 10, 0.3)',
            },
        },
    },

    plugins: [forms],
};
