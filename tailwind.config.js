/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  darkMode: 'class',
  theme: {
    colors: {
      primary: {
        DEFAULT: "#001f3d",
        "50": "#e6eef4",
        "100": "#cddde9",
        "200": "#9ab8d3",
        "300": "#6792bc",
        "400": "#336ca5",
        "500": "#00458f",
        "600": "#003970",
        "700": "#002c56",
        "800": "#001f3d",
        "900": "#001528",
        "950": "#000b16"
      }
    },
    fontFamily: {
      sans: ['Lato', 'sans-serif'],
      heading: ['Raleway', 'sans-serif'],
      light: ['Lato', 'sans-serif'],
      medium: ['Lato', 'sans-serif'],
    },
    fontWeight: {
      light: 300,
      normal: 400,
      semibold: 600,
      bold: 700,
      bolder: 900,
    },
    extend: {},
  },
  plugins: [],
}
