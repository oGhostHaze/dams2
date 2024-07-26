const colors = require("tailwindcss/colors");
const {
    toRGB,
    withOpacityValue,
} = require("@left4code/tw-starter/dist/js/tailwind-config-helper");

module.exports = {
    mode: "jit",
    content: [
        "./src/**/*.{php,html,js,jsx,ts,tsx,vue}",
        "./resources/**/*.{php,html,js,jsx,ts,tsx,vue}",
        "./node_modules/@left4code/tw-starter/**/*.js",
        // ".//*.html",
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                rgb: toRGB(colors),
                primary: withOpacityValue("--color-primary"),
                secondary: withOpacityValue("--color-secondary"),
                success: withOpacityValue("--color-success"),
                info: withOpacityValue("--color-info"),
                warning: withOpacityValue("--color-warning"),
                pending: withOpacityValue("--color-pending"),
                danger: withOpacityValue("--color-danger"),
                light: withOpacityValue("--color-light"),
                dark: withOpacityValue("--color-dark"),
                slate: {
                    50: withOpacityValue("--color-slate-50"),
                    100: withOpacityValue("--color-slate-100"),
                    200: withOpacityValue("--color-slate-200"),
                    300: withOpacityValue("--color-slate-300"),
                    400: withOpacityValue("--color-slate-400"),
                    500: withOpacityValue("--color-slate-500"),
                    600: withOpacityValue("--color-slate-600"),
                    700: withOpacityValue("--color-slate-700"),
                    800: withOpacityValue("--color-slate-800"),
                    900: withOpacityValue("--color-slate-900"),
                },
                darkmode: {
                    50: withOpacityValue("--color-darkmode-50"),
                    100: withOpacityValue("--color-darkmode-100"),
                    200: withOpacityValue("--color-darkmode-200"),
                    300: withOpacityValue("--color-darkmode-300"),
                    400: withOpacityValue("--color-darkmode-400"),
                    500: withOpacityValue("--color-darkmode-500"),
                    600: withOpacityValue("--color-darkmode-600"),
                    700: withOpacityValue("--color-darkmode-700"),
                    800: withOpacityValue("--color-darkmode-800"),
                    900: withOpacityValue("--color-darkmode-900"),
                },
            },
            fontFamily: {
                roboto: ["Roboto"],
            },
            container: {
                center: true,
            },
            maxWidth: {
                "1/4": "25%",
                "1/2": "50%",
                "3/4": "75%",
            },
            strokeWidth: {
                0.5: 0.5,
                1.5: 1.5,
                2.5: 2.5,
            },
        },
    },

    safelist: [
        'bg-slate-500', 'bg-red-500', 'bg-blue-500', 'bg-green-500',
        'toggle', 'w-full', 'flex', 'space-x-3', 'overflow-x-auto',
        'px-4', 'py-8', 'flex-1', 'bg-white', 'rounded-lg', 'p-2', 'flex-col', 'mx-2',
        'text-sm', 'font-medium', 'py-2', 'text-gray-700', 'bg-info', 'h-14', 'my-auto', 'align-middle',
        'cursor-grab', 'h-screen', 'space-y-2', 'text-success', 'text-danger', 'text-error'
    ],

    daisyui: {
        themes: false, // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
        darkTheme: "forest", // name of one of the included themes for dark mode
        base: false, // applies background color and foreground color for root element by default
        styled: true, // include daisyUI colors and design decisions for all components
        utils: true, // adds responsive and modifier utility classes
        prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
        logs: false, // Shows info about daisyUI version and used config in the console when building your CSS
        themeRoot: ":root",
    },
    plugins: [require("daisyui"), require("@tailwindcss/forms")],
    variants: {
        extend: {
            boxShadow: ["dark"],
        },
    },
};
