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
    .js('resources/js/admin-tinymce.js', 'public/js')
    .js('resources/js/admin-vue-body.js', 'public/js')
    .js('resources/js/main-vue-body.js', 'public/js')
    .js('resources/js/scrollToTop.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sourceMaps(false, 'source-map')
    .browserSync({
        proxy: 'localhost:8000',
        files: [
            'public/**/*',
            'resources/views/**/*',
            'resources/lang/**/*',
            'routes/**/*'
        ],
        notify: false,
        watchOptions: {
            ignored: '/node_modules'
        },

    })
// .options({
//     watchOptions: {
//         ignored: '/node_modules'
//     },
// })

;
