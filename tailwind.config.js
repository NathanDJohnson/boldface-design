/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './includes/**/*.php',
    './template-parts/**/*.php',
    './assets/js/src/**/*.js',
  ],
  safelist: [
    '.is-layout-flex',
    'bg-gradient-abyss',
		'bg-denim',
		'bg-mine-shaft',
		'bg-observatory',
    'text-white',
    'text-mine-shaft',
  ],
  theme: {
    extend: {
      backgroundImage: {
        'gradient-abyss': 'linear-gradient(to right, #007E9B 0%, #164D56 75%)',
      },
      colors: {
        'ocean-blue': '#0073aa',
        'denim': '#005a87',
        'observatory': '#07A599',
        'cyprus': '#058279',
        'sulfur': '#c7da3a',
        'conifer': '#afc22a',
        'whisper': '#f5f5f5',
        'mine-shaft': '#333333',
        'abbey': '#454545',
        'steel': '#7a7a7a',
      },
      fontFamily: {
        heading: ['Calistoga', 'serif'],
        sans: ['Montserrat', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'h1': ['clamp(2rem, 5vw, 3.5rem)', { lineHeight: '1.2', fontFamily: 'Calistoga' }],
        'h2': ['clamp(1.75rem, 4.25vw, 3rem)', { lineHeight: '1.2', fontFamily: 'Calistoga' }],
        'h3': ['clamp(1.375rem, 3.25vw, 2.25rem)', { lineHeight: '1.3', fontFamily: 'Calistoga' }],
        'h4': ['clamp(1.125rem, 2.5vw, 1.75rem)', { lineHeight: '1.3', fontFamily: 'Calistoga' }],
        'body': ['clamp(1rem, 2.5vw, 1.25rem)', { lineHeight: '1.6', fontFamily: 'Montserrat' }],
        'lead': ['clamp(1.125rem, 2.75vw, 1.5rem)', { lineHeight: '1.5', fontFamily: 'Montserrat' }],
        'display': ['clamp(1rem, 3vw, 1.875rem)', { lineHeight: '1.4', fontFamily: 'Calistoga' }],
        'caption': ['clamp(0.875rem, 1.25vw, 1.125rem)', { lineHeight: '1.5', fontFamily: 'Montserrat' }],
        'footer': ['clamp(0.875rem, 1vw, 1rem)', { lineHeight: '1.5', fontFamily: 'Montserrat' }],
      },
      height: {
        '24px': '24px',
        '32px': '32px',
        '48px': '48px',
        '100px': '100px',
        '125px': '125px',
        '200px': '200px',
        '300px': '300px',
      },
      spacing: {
        'xxs': '0.5rem',
        'xs': '0.75rem',
        'sm': '1rem',
        'md': '1.25rem',
        'lg': '1.5rem',
        'xl': '2rem',
        '2xl': '3rem',
        'safe-top': 'env(safe-area-inset-top)',
        'safe-right': 'env(safe-area-inset-right)',
        'safe-bottom': 'env(safe-area-inset-bottom)',
        'safe-left': 'env(safe-area-inset-left)',
      },
      maxWidth: {
        '1100px': '1100px',
        '1280px': '1280px',
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            color: theme('colors.abbey'),
            h1: { fontFamily: 'Calistoga' },
            h2: { fontFamily: 'Calistoga' },
            h3: { fontFamily: 'Calistoga' },
            h4: { fontFamily: 'Calistoga' },
          },
        },
      }),
      width: {
        '24px': '24px',
        '32px': '32px',
        '48px': '48px',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
  corePlugins: {
    preflight: true,
  },
};