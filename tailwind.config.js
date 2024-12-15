/** @type {import('tailwindcss').Config} */

const { addDynamicIconSelectors } = require('@iconify/tailwind');
const { iconsPlugin, getIconCollections } = require("@egoist/tailwindcss-icons")
const plugin = require('tailwindcss/plugin')

export default {
    darkMode: 'false',
    content: [
        "./resources/**/*.blade.php",
        "./app/View/**/*.php",
    ],
    theme: {
        extend: {
            backgroundImage: {
                'auth-background': "url('../images/default-auth.jpg')",
                'pattern': "url('../images/pattern-1.png')",
                'pattern-2': "url('../images/pattern-2.jpg')",
                'pattern-3': "url('../images/pattern-3.png')",
                'pattern-4': "url('../images/pattern-4.png')",
                'cloud': "url('../images/cloud.png')",
                'hill': "url('../images/hill.png')",
            },
            zIndex: {
                'header': '990',
                'sidebar': '991',
                'dropdown': '992',
                'modal': '993',
                'loading-state': '994',
                'loading-screen': '995',
            },
            fontFamily: {
                'body': ['QuickSand', 'sans-serif'],
                'hero': ['DMSerifDisplay', 'QuickSand', 'sans-serif']
            },
            colors: {
                primary: {
                    50: "#EBF3FF",
                    100: "#DBEAFF",
                    200: "#ADCEFF",
                    300: "#7AAFFF",
                    400: "#247BFF",
                    500: "#002A69",
                    600: "#00255C",
                    700: "#00255C",
                    800: "#00183D",
                    900: "#00183D",
                    950: "#000000"
                },
                secondary: {
                    '50': '#fff6f0',
                    '100': '#ffecdb',
                    '200': '#ffd6b6',
                    '300': '#feb988',
                    '400': '#fc9259',
                    '500': '#fb773c',
                    '600': '#f55825',
                    '700': '#e0350d',
                    '800': '#b22c14',
                    '900': '#8f2714',
                    '950': '#4d1108',
                },
            },
            textShadow: {
                sm: '0 1px 2px var(--tw-shadow-color)',
                DEFAULT: '0 2px 4px var(--tw-shadow-color)',
                lg: '0 8px 16px var(--tw-shadow-color)',
            },
            keyframes: {
                refine: {
                    "0%": {
                        top: "0%",
                    },
                    "50%": {
                        top: "-5%",
                    },
                    "100%": {
                        top: "0%",
                    },
                },
            },
            animation: {
                "refine-vertical": "refine 5s infinite",
            },
        },
    },
    safelist: [
        'swal2-container'
    ],
    plugins: [
        // Iconify plugin
        addDynamicIconSelectors(),
        iconsPlugin({
            // Select the icon collections you want to use
            // You can also ignore this option to automatically discover all individual icon packages you have installed
            // If you install @iconify/json, you should explicitly specify the collections you want to use, like this:
            collections: getIconCollections(['solar', 'ph', 'fluent-emoji-flat']),
            // If you want to use all icons from @iconify/json, you can do this:
            // collections: getIconCollections("all"),
            // and the more recommended way is to use `dynamicIconsPlugin`, see below.
        }),
        plugin(function ({ matchUtilities, theme }) {
            matchUtilities(
                {
                    'text-shadow': (value) => ({
                        textShadow: value,
                    }),
                },
                { values: theme('textShadow') }
            )
        }),
    ],
}

