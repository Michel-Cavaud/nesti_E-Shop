module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    fontFamily: {
       'croissant': ['Croissant One', 'cursive']
    },
    colors: {
      noir: '#000',
      blanc: '#fff',
      fond: "#F9D195",
      cyanclair: '#99E3EC',
      cyanfonce: '#6BBFC8',
      vert:'rgb(16,185,129)',
      rouge: 'rgb(239,68,68)',
      bleue: 'rgb(59,130,246)'
    },
    zIndex: {
        '0': 0,
       '10': 10,
       '20': 20,
       '30': 30,
       '40': 40,
       '50': 50,
       '60': 60,
       '70': 70,
       '80': 80,
       '90': 90,
       '100': 100,
       'auto': 'auto',
    }
  },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/aspect-ratio')],
}


