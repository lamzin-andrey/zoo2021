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

//Страницы сайта
mix.js('sources/app.js', 'output.js');


/*mix.styles([
		'./../s/vendor/bootstrap4.2.1.min.css',
		'./../s/vendor/fontawesome5/all.css',
		'./../s/sources/site/app.css'
	], './../s/app.css');
*/

