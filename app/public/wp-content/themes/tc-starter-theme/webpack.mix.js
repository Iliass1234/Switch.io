const themeVars = require('./theme.config');
const mix = require('laravel-mix');

const tcConfig = {
    src: {
        img: './src/images/',
        scss: './src/scss/',
        css: './src/css/',
        js: './src/js/',
    },
    assets: {
        css: './assets/css',
        js: './assets/js',
        cssVendors: './assets/css/vendors/',
        jsVendors: './assets/js/vendors/',
        img: './assets/images/',
    }
};
/**----------------------------------------------------------
 JS
 ---------------------------------------------------------**/
mix.js(tcConfig.src.js + '/themeCritical.js', tcConfig.assets.js).minify(tcConfig.assets.js + '/themeCritical.js').browserSync(themeVars.URL);
mix.js(tcConfig.src.js + '/theme.js', tcConfig.assets.js).minify(tcConfig.assets.js + '/theme.js')

/**----------------------------------------------------------
 SCSS
 ---------------------------------------------------------**/
mix.sass(tcConfig.src.scss + '/bootstrap.scss', tcConfig.assets.cssVendors).minify(tcConfig.assets.cssVendors + '/bootstrap.css')
mix.sass(tcConfig.src.scss + '/themeCritical.scss', tcConfig.assets.css).minify(tcConfig.assets.css + '/themeCritical.css')
mix.sass(tcConfig.src.scss + '/theme.scss', tcConfig.assets.css).minify(tcConfig.assets.css + '/theme.css')

mix.browserSync({
    proxy: {
        target: themeVars.URL,
        ws: true,
    },
    open: themeVars.URL,
    watch: true,
    files: [
        tcConfig.src.js,
        tcConfig.src.scss + '/**/*',

    ],
});
mix.webpackConfig({
    output: {
        chunkFilename: 'assets/js/chunks/[name].js',
        publicPath: '/wp-content/themes/tc-starter-theme/',
    },
});
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

module.exports = {
    plugins: [
        new BundleAnalyzerPlugin()
    ]
}
