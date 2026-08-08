import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // Permet de basculer entre mode clair et sombre avec la classe "dark"
    darkMode: 'class', 

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Mode Sombre (Bleu Nuit WhatsApp + Pierre de France)
                night: {
                    DEFAULT: '#0b141a', // Bleu de nuit principal
                    card: '#111b21',    // Bleu de nuit secondaire
                },
                pierre: {
                    DEFAULT: '#e3d1be', // Jaune Pierre de France
                    light: '#f0e2d0',
                },

                // Mode Clair (Casablanca + Blanc)
                casablanca: {
                    DEFAULT: '#f4a261', // Casablanca
                    light: '#e9c46a',
                },

                // Couleur Neutre Fixe (Cocoa / Brune)
                cocoa: {
                    DEFAULT: '#4a2c2a', // Brune / Cocoa neutre
                    light: '#6d4c41',
                },
            },
        },
    },

    plugins: [forms],
};