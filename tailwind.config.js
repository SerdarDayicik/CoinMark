/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/**/*.{html,js,php}', // Kaynak dosyalarını tanımla
    './*.{html,js,php}',       // Ana dizindeki dosyalar
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

