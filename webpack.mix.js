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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/ajaxPost.js', 'public/js')  //追加。作成したajaxPost.jsファイルを、public/jsディレクトリにつなげる。
    .autoload( {"jquery": [ '$', 'window.jQuery' ],} ) //追加。jQueryを使えるようにするため
    .vue()
    .sass('resources/sass/app.scss', 'public/css');
