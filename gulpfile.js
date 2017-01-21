const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.copy(
        'vendor/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'resources/assets/css/journal.css'
    );
    mix.copy(
        'vendor/bower_components/jquery-validation/dist/jquery.validate.min.js',
        'resources/assets/js/jquery.validate.min.js'
    );
    mix.webpack(['jquery.validate.min.js','app.js']);
    mix.styles(['journal.css','style.css'],'public/css/app.css');
})
