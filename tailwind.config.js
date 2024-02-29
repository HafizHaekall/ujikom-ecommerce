/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    container: {
      center: true,
      padding: "11.5rem",
      screens: {
          "2xl": "1440px",
      },
    },
    extend: {
      colors: {
        primary: {
            // 10: "#A9DEF9",
            10: "#DCE6FF",
            20: "#274C77",
        },
        secondary: {
            10: "#F9FFE8",
            20: "#FFF212",
            30: '#E80F0F',
        },
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

