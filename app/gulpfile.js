process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

var bowerFullPath = './bower_components/';
var resourceDir = './resources/';
var assetsDir = './public/assets/';

elixir(function (mix) {
    mix.scripts([
        bowerFullPath + 'jquery/dist/jquery.min.js',
        bowerFullPath + 'bootstrap-sass/assets/javascripts/bootstrap.min.js'
    ], assetsDir + 'js/libs.js');

    mix.scripts([
        resourceDir + 'js/app.js'
    ], assetsDir + 'js/app.js');

    mix.sass([
        resourceDir + 'scss/app.scss'
    ], assetsDir + 'css/style.css');
});