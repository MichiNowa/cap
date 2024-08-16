/** @type {import('tailwindcss').Config} */
module.exports = {
  prefix: 'tw-',
  content: {
    relative: true,
    files: [
    "./assets/public/js/**/*.{html,js,mjs}",
    "./assets/public/vendor/**/*.{html,js,mjs,html}",
    "./assets/components/**/*.{php,html}",
    "./assets/layouts/**/*.{php,html}",
    "./assets/pages/**/*.{php,html}",
    "./assets/php/**/*.{php,html}",
    "./index.php",
    ],
  },
  theme: {
    extend: {},
  },
  plugins: [],
}

