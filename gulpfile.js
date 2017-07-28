var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
// Important to render the vue component with laravel elixir
require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.styles([
        'libs/bootstrap.min.css',
        'libs/font-awesome.min.css',
        'libs/alertify.core.css',
        'libs/alertify.default.css',
        'libs/alertify.css',
        'app.css',
        'chat.css',
    ], 'public/css/app.css');

    mix.scripts([
        'libs/jquery-2.1.1.js',
        'libs/bootstrap.min.js',
        'libs/alertify.js',
    ], 'public/js/libs.js');

    mix.browserify([
        'app.js',
    ], 'public/js/app.js');
});
