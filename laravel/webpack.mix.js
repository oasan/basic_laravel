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


mix.setPublicPath('./../');

mix.js('resources/js/app.js', 'assets/js')
   .sass('resources/sass/app.scss', 'assets/css')
   .version();


mix.js('resources/js/admin.js', 'assets/js')
   .sass('resources/sass/admin.scss', 'assets/css')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts', '../assets/fonts/fontawesome-free')
   .copy('node_modules/tinymce', '../assets/tinymce')
   .copy('node_modules/tinymce-lang/', '../assets/tinymce')
   .version();
