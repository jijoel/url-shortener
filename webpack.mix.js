let mix = require('laravel-mix');
let webpack = require('webpack');

let BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

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

plugins = [
    new webpack.ContextReplacementPlugin(/moment[\/\\]locale$/, /en/)
];

if (process.env.ARG == 'detail') {
    plugins.push(
        new BundleAnalyzerPlugin({
            analyzerMode: 'static',
            reportFilename: '../storage/app/public/report.html',
            generateStatsFile: true,
            statsFilename: '../storage/app/public/stats.json',
        })
    );
}

mix.webpackConfig({
    plugins: plugins,
    resolve: { symlinks: false },
})
mix.options({
    extractVueStyles: true,
})

if (mix.inProduction()) {
    mix.version();
    mix.webpackConfig({
        plugins: plugins,
        module: {
            rules: [{
                test: /\.js?$/,
                exclude: /(bower_components)/,
                use: [{
                    loader: 'babel-loader',
                    options: mix.config.babel()
                }]
            }]
        }
    });
}


mix.js('resources/assets/js/app.js', 'public/js')
   .stylus('resources/assets/stylus/app.styl', 'public/css');

