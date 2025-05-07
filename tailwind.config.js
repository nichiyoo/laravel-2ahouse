import { fontFamily } from 'tailwindcss/defaultTheme';

import colors from 'tailwindcss/colors';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss/plugin';


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
        sans: ['var(--font-sans)', ...fontFamily.sans],
      },
      container: {
        center: true,
      },
      padding: {
        content: '2rem'
      },
      colors: {
        // primary: colors.rose,
        primary: {
          '50': '#fffbea',
          '100': '#fff2c5',
          '200': '#ffe685',
          '300': '#ffd246',
          '400': '#ffbd1b',
          '500': '#ff9900',
          '600': '#e27200',
          '700': '#bb4d02',
          '800': '#983b08',
          '900': '#7c310b',
          '950': '#481700',
        },
      },
      aspectRatio: {
        thumbnail: '3/2'
      }
    },
  },

  plugins: [
    forms,
    plugin(({ addVariant }) => {
      addVariant("both", ["&:focus", "&:hover"])
    })
  ],
};
