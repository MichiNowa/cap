/** @type {import('tailwindcss').Config} */
module.exports = {
  prefix: 'tw-',
  content: [
    "./assets/public/js/**/*.{js,mjs}",
    "./assets/public/vendor/**/*.{js,mjs,html}",
    "./assets/components/**/*.{php,html}",
    "./assets/layouts/**/*.{php,html}",
    "./assets/pages/**/*.{php,html}",
    "./assets/php/**/*.{php,html}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

