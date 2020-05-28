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

mix.sass('resources/assets/scss/app.scss', 'public/web/css');
   

mix.copy('resources/assets/webfonts', 'public/web/webfonts');

mix.js('resources/assets/js/app.js', 'public/web/js')
.js('resources/assets/js/checkout.js', 'public/web/js')
.js('resources/assets/js/ecommerce.js', 'public/web/js')
.js('resources/assets/js/stripe.js', 'public/web/js')
.js('resources/assets/js/scripts.js', 'public/web/js')
.js('resources/assets/js/setup.js', 'public/web/js')
