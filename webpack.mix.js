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



 const postCssConfig = [require('tailwindcss')('./tailwind.config.js')];

 if (process.env.NODE_ENV === 'production') {
     postCssConfig.push(
         require('@fullhuman/postcss-purgecss')({
             content: [
                 './resources/assets/js/**/*.vue',
                 './resources/assets/js/**/*.js',
                 './resources/sass/**/*.scss',
                 './resources/views/**/*.php'
             ],
             defaultExtractor: content =>
                 content.match(/[A-Za-z0-9-_:/]+/g) || []
         })
     );
 }

 mix.webpackConfig({
     module: {
         rules: [
             {
                 test: /\.jsx?$/,
                 exclude: /(node_modules\/(?!(strict-uri-encode|query-string)\/).*|bower_components)/,
                 use: [
                     {
                         loader: 'babel-loader',
                         options: Config.babel()
                     }
                 ]
             }
         ]
     }
 });



 mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: postCssConfig
    })
    .sourceMaps()
    .version();
