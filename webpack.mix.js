const mix = require('laravel-mix');
const pathRes = require('path');
const webpack = require('webpack');
let productionSourceMaps = false;

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

mix.webpackConfig({
    devtool: "source-map",
    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            Cookies: "js-cookie",
            Popper: ['popper.js', 'default'],

            Carousel: 'exports-loader?Carousel!bootstrap/js/dist/carousel',
            Collapse: 'exports-loader?Collapse!bootstrap/js/dist/collapse',
            Popover: 'exports-loader?Popover!bootstrap/js/dist/popover',
            Tooltip: 'exports-loader?Tooltip!bootstrap/js/dist/tooltip',
            Modal: 'exports-loader?Modal!bootstrap/js/dist/modal',


        })
    ],
});

//Copy all the images that are used on the Web Application to the right folder ( public/images )
mix.copyDirectory('resources/images', 'public/images');
mix.copyDirectory('resources/video', 'public/video');
mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/downloads', 'public/downloads');
mix.copy('node_modules/stickybits/dist/stickybits.min.js', 'public/js/stickybits.js');

mix.copyDirectory('node_modules/slick-carousel/slick/', 'public/slick');
// mix.copyDirectory('node_modules/slick-carousel/slick/fonts/', 'public/slick/fonts');
// mix.copy('node_modules/slick-carousel/slick/slick.js', 'public/slick/slick.js');

mix.options({
    autoprefixer: false,
    postCss: [
        require('autoprefixer')({
            remove: false,
            // browsers: ['last 2 version', 'safari 5', 'ie 6', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'ios 7', 'ios 8', 'ios 9', 'android 4'],
        }),
        require('postcss-flexbugs-fixes')(),
    ],
    processCssUrls: false
})
    .sass('resources/scss/common.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .js(['resources/js/app.js'], 'public/js')
    .js(['resources/es6/common.js'], 'public/js')
    .js(['resources/es6/components/search-form.js'], 'public/js/components/')
    .js(['resources/es6/components/compare-brokers-modal.js'], 'public/js/components/')
    .sourceMaps(productionSourceMaps,"source-map")
    .version();


// Reload browser when something changes
mix.browserSync({
    host: '192.168.10.10',
    open: false,
    injectChanges: true,
    proxy: 'hcstaging.test' || process.env.APP_URL,
    files: [
        'resources/scss/**/*.scss',
        'resources/sass/**/*.scss',
        'resources/es6/**/*.js',
        'resources/js/**/*.js',
        'resources/views/**/*.blade.php',
        'public/images/**/*'
    ],
    logSnippet: true,
    port: 8080,
    ghostMode: false
})
    //Disable notification sounds
    .disableSuccessNotifications();
