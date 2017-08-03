//const { mix } = require('laravel-mix');
let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------	
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 

mix.combine(['vendor/creativetimofficial/paper-kit/assets/js/*'], 'resources/assets/js/paper.js')
	.js(['resources/assets/js/app.js',
		'resources/assets/js/paper.js',
		'node_modules/bootstrap-material-design/dist/js/material.min.js',
		'node_modules/bootstrap-material-design/dist/js/ripples.min.js'
		], 'public/js')

		*/
		
mix.js(['resources/assets/js/app.js',
	'node_modules/bootstrap-material-design/dist/js/material.min.js',
	'node_modules/bootstrap-material-design/dist/js/ripples.min.js',
	'node_modules/selectize/dist/js/selectize.min.js'
	], 'public/js/config.min.js')
.sass('resources/assets/sass/app.scss', 'public/css')
.sass('resources/assets/sass/config.scss', 'public/css')
.less('node_modules/selectize/dist/css/selectize.bootstrap3.css', 'public/css');
