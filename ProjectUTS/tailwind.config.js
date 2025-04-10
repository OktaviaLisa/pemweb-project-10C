/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./*.html'],
  theme: {
    container:{
      center: true,
      padding: '16px',
    },
    extend: {
      colors: {
        primary : '#c2410c',
        secondary : '#164e63'
      },
      screens: {
        '2xl' : '1320px',
      },
      
    },
  },
  plugins: [],
}

