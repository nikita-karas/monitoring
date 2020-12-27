const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js("resources/js/app.js", "public/js")
    .js("resources/js/main.js", "public/js")
    .sass("resources/scss/app.scss", "public/css")
    .sass("resources/scss/bootstrap.scss", "public/css");

mix.js("resources/js/vendor/apexcharts.js", "public/js/vendor")
    .js("resources/js/vendor/feather-icons.js", "public/js/vendor")
    .js("resources/js/vendor/chartjs.js", "public/js/vendor");

mix.minify([
    'public/js/app.js',
    'public/js/main.js',

    'public/css/app.css',
    'public/css/bootstrap.css',

    'public/js/vendor/apexcharts.js',
    'public/js/vendor/feather-icons.js',
    'public/js/vendor/chartjs.js'
]);



if (mix.inProduction()) {
    mix.version();
}
