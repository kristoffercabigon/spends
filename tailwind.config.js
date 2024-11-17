import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import animations from "@midudev/tailwind-animations";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#eff6ff",
                    100: "#dbeafe",
                    200: "#bfdbfe",
                    300: "#93c5fd",
                    400: "#60a5fa",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                    900: "#1e3a8a",
                    950: "#172554",
                },
                customGreen: "#1AA514",
                customOrange: "#FF4802",
            },
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
                body: [
                    "Inter",
                    "ui-sans-serif",
                    "system-ui",
                    "-apple-system",
                    "system-ui",
                    "Segoe UI",
                    "Roboto",
                    "Helvetica Neue",
                    "Arial",
                    "Noto Sans",
                    "sans-serif",
                    "Apple Color Emoji",
                    "Segoe UI Emoji",
                    "Segoe UI Symbol",
                    "Noto Color Emoji",
                ],
                sans: [
                    "Inter",
                    "ui-sans-serif",
                    "system-ui",
                    "-apple-system",
                    "system-ui",
                    "Segoe UI",
                    "Roboto",
                    "Helvetica Neue",
                    "Arial",
                    "Noto Sans",
                    "sans-serif",
                    "Apple Color Emoji",
                    "Segoe UI Emoji",
                    "Segoe UI Symbol",
                    "Noto Color Emoji",
                ],
            },
            fontSize: {
                "30px": "30px",
                "16px": "16px",
            },
            animation: {
                spin: "spin 1s linear infinite",
                "scale-up": "scaleUp 0.3s ease-in-out",
                "slide-out-right": "slideOutRight 2s ease-out forwards",
                "fade-in-up": "fadeInUp 2.5s ease-out",
                "custom-fade-in-right": "fadeInRight 150ms ease-in-out",
                "fade-in-bounce-right": "fadeInBounceRight .8s ease-in-out",
                "fly-in-left": "flyInLeft .5s ease-out",
            },
            keyframes: {
                spin: {
                    "0%": { transform: "rotate(0deg)" },
                    "100%": { transform: "rotate(360deg)" },
                },
                scaleUp: {
                    "0%": { transform: "scale(1)" },
                    "100%": { transform: "scale(1.05)" },
                },
                slideOutRight: {
                    "0%": { opacity: 1, transform: "translateX(0)" },
                    "100%": { opacity: 0, transform: "translateX(100%)" },
                },
                fadeInUp: {
                    "0%": { opacity: 0, transform: "translateY(70px)" },
                    "100%": { opacity: 1, transform: "translateY(0)" },
                },
                fadeInRight: {
                    "0%": { transform: "translateX(-100%)", opacity: "0" },
                    "100%": { transform: "translateX(0)", opacity: "1" },
                },
                fadeInBounceRight: {
                    "0%": {
                        opacity: 0,
                        transform: "translate3d(100%, 0%, 0)",
                    },
                    "33%": {
                        opacity: 0.5,
                        transform: "translate3d(0%, 0%, 0)",
                    },
                    "66%": {
                        opacity: 0.7,
                        transform: "translate3d(20%, 0%, 0)",
                    },
                    "100%": {
                        opacity: 1,
                        transform: "translate3d(0, 0, 0)",
                    },
                },
                flyInLeft: {
                    "0%": {
                        opacity: "0",
                        transform: "translate3d(1500px, 0, 0)",
                        transitionTimingFunction:
                            "cubic-bezier(0.215, 0.61, 0.355, 1)",
                    },
                    "60%": {
                        opacity: "1",
                        transform: "translate3d(-25px, 0, 0)",
                    },
                    "75%": {
                        transform: "translate3d(10px, 0, 0)",
                    },
                    "90%": {
                        transform: "translate3d(-5px, 0, 0)",
                    },
                    "100%": {
                        transform: "none",
                    },
                },
            },
        },
    },
    plugins: [forms, animations],
};
