import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ], safelist: [
        'bg-green-600',
        'hover:bg-green-700',
        'bg-red-600',
        'hover:bg-red-700',
        'text-green-600',
        'text-red-600',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            } , fontWeight: {
        'extraheavy': 950,
      }
        },
    },

    plugins: [forms, typography],
};
