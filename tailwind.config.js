import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import flowbite from 'flowbite/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
        "./node_modules/flowbite-datepicker/**/*.js",
       

    ],
darkMode: 'selector',
    theme: {
        extend: {
            fontFamily: {
                Rubik: ['Rubik', ...defaultTheme.fontFamily.sans],
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'Cairo': 'url(/resources/image/Cairo.jpg)',
                'Alexandria': 'url(/resources/image/Alexandria.jpg)',
                'Aswan': 'url(/resources/image/Aswan.jpg)',
                'Giza': 'url(/resources/image/Giza.jpg)',
                'Luxor': 'url(/resources/image/Luxor.jpg)',
                'PortSaid': 'url(/resources/image/PortSaid.jpg)',
                'SharmElSheikh': 'url(/resources/image/SharmElSheikh.jpg)',
                'Suez': 'url(/resources/image/Suez.jpg)',
             
            },
        },
    },

    plugins: [forms,flowbite],
};
