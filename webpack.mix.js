const mix = require('laravel-mix');

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

mix.setPublicPath('public')
	.setResourceRoot('../')
	.js('resources/js/vendor.js', 'public/js/vendor.bundle.js')
    .js('resources/js/scripts.js', 'public/js/scripts.bundle.js')
    .sass('resources/scss/vendor.scss', 'public/css/vendor.bundle.css')
    .sass('resources/scss/style.scss', 'public/css/style.bundle.css');
