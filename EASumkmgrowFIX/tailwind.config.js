/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#c2410c',     // contoh warna
        secondary: '#164e63',   // contoh warna
      }
    },
  },
  plugins: [],
}
