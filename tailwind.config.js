import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                'sans_serif': ['Inter']
            },
            colors: {
                primary             : '#F7EC66',
                secondary           : '#1F254A',
                terciary            : '#C9A33D',

                black               : '#0D0D0D',

                violet              : '#6E5073',

                yellow_light        : '#FEFFF9',
                blue_light          : '#F4F4F6',

                blue_hover          : '#3F4464',

                gray_50             : '#F5F7FA',
                gray_100            : '#EEF1F6',
                gray_200            : '#E0E5EB',
                gray_300            : '#CAD0D9',
                gray_400            : '#9CA3AF',
                gray_500            : '#6C727F',
                gray_600            : '#4E5562',
                gray_700            : '#333D4C',
                gray_800            : '#1D2735',
                gray_900            : '#030712',
                gray_950            : '#030712',
            },
            backgroundImage: {
                'custom_gradient': 'linear-gradient(141deg, rgba(247,236,102,1) 40%, rgba(201,163,61,0.5) 100%)',
            },
            fontSize: {
                mobile_h1           : '2.5rem',
                tablet_h1           : '3.5rem',
                desktop_h1          : '4rem',
                mobile_h2           : '2rem',
                tablet_h2           : '2.5rem',
                mobile_h3           : '1.75rem',
                tablet_h3           : '2rem',
                desktop_h3          : '2.5rem',
                tablet_h4           : '1.75rem',
                desktop_h4          : '2rem',
                text_small          : '0.625rem',
            },
            boxShadow: {
                cookie: '0 2px 4px 6px rgb(0 0 0 / 0.1)',
            }
        },
    },
    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
