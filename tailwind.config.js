/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors');

module.exports = {
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./vendor/laravel/jetstream/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.vue',
		'./node_modules/flowbite/**/*.js',
	],
	safelist: [
    {
      pattern: /text-+/,
      variants: ['hover', 'focus'],
    },
  ],
	plugins: [
		require('flowbite/plugin'),
		require('@tailwindcss/forms'),
		require('@tailwindcss/typography'),
	],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Ubuntu, system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Noto Sans, Cantarell, Helvetica Neue, Oxygen, Fira Sans, Droid Sans, sans-serif'],
			},
		},
		colors: {
			transparent: 'transparent',
			current: 'currentColor',
			green: colors.green,
			slate: colors.slate,
			gray: colors.gray,
			zinc: colors.zinc,
			neutral: colors.neutral,
			stone: colors.stone,
			red: colors.red,
			orange: colors.orange,
			amber: colors.amber,
			yellow: colors.yellow,
			lime: colors.lime,
			emerald: colors.emerald,
			teal: colors.teal,
			cyan: colors.cyan,
			sky: colors.sky,
			blue: colors.blue,
			indigo: colors.indigo,
			violet: colors.violet,
			purple: colors.purple,
			fuchsia: colors.fuchsia,
			pink: colors.pink,
			rose: colors.rose,
			shade: '#e5ecf5',
			primary: '#07193f',
			accent: '#00449f',
			warning: '#ff0033',
			success: '#22c55e',
		},
	},
};
