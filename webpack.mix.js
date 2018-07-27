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
*/
		
mix.js(['resources/assets/js/app.js',
    'node_modules/bootstrap-material-design/dist/js/material.min.js',
	'node_modules/bootstrap-material-design/dist/js/ripples.min.js'
	], 'public/js/config.min.js')
    .js(['resources/assets/js/app.js',
    'node_modules/bootstrap-material-design/dist/js/material.min.js',
    'node_modules/bootstrap-material-design/dist/js/ripples.min.js'
], 'public/js/app.js')
.sass('resources/assets/sass/app.scss', 'public/css')
.sass('resources/assets/sass/config.scss', 'public/css')
.combine(['public/css/app.css','node_modules/datatables/css/jquery.dataTables.min.css', 'node_modules/selectize/dist/css/selectize.bootstrap3.css'], 'public/css/app.css');
