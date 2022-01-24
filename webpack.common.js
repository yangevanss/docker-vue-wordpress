const Webpack = require('webpack')
const path = require('path')
const CopyPlugin = require('copy-webpack-plugin')
const { VueLoaderPlugin } = require('vue-loader')

const transpileDependencies = []

module.exports = {
    entry: {
        admin: './src/style/admin/_admin.scss',
        default: './src/js/pages/default.js',
        'page-index': './src/js/pages/page-index.js',
        'page-search': './src/style/pages/page-search.scss',
        'page-tax': './src/style/pages/page-tax.scss',
        'page-404': './src/style/pages/page-404.scss',
        'archive-news': './src/style/pages/archive-news.scss',
        'single-news': './src/style/pages/single-news.scss',
    },
    output: {
        filename: 'js/[name].bundle.js',
        path: path.resolve(__dirname, 'wordpress/wp-content/themes/blockstudio-theme/src'),
        pathinfo: false,
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'src'),
        },
    },
    optimization: {
        moduleIds: 'deterministic',
        runtimeChunk: 'single',
        usedExports: true,
        sideEffects: true,
        innerGraph: true,
        splitChunks: {
            cacheGroups: {
                vendor: {
                    test: /[\\/]node_modules[\\/]/,
                    name: 'vendors',
                    chunks: 'all',
                },
            },
        },
    },
    plugins: [
        new Webpack.ProvidePlugin({}),
        new CopyPlugin({
            patterns: [{ from: path.resolve(__dirname, 'static') }],
        }),
        new VueLoaderPlugin(),
    ],
    module: {
        rules: [
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                type: 'asset/resource',
                include: path.resolve(__dirname, 'src/assets/font'),
                generator: {
                    filename: 'font/[name][ext]',
                },
            },
            {
                test: /\.svg$/,
                include: path.resolve(__dirname, 'src/assets/icons'),
                use: [
                    { loader: 'svg-sprite-loader', options: { symbolId: '[name]' } },
                    {
                        loader: 'svgo-loader',
                        options: {
                            plugins: [
                                {
                                    name: 'removeAttrs',
                                    params: {
                                        attrs: '(fill|stroke)',
                                    },
                                },
                            ],
                        },
                    },
                ],
            },
            {
                test: /\.(jpe?g|png|gif|svg)$/i,
                type: 'asset/resource',
                exclude: [
                    path.resolve(__dirname, 'src/assets/icons'),
                    path.resolve(__dirname, 'src/assets/font'),
                ],
                generator: {
                    filename: (e) => {
                        const fileName = e.filename.replace('src/assets/img/', '')
                        return `img/${fileName}`
                    },
                },
            },
            {
                test: /\.m?js$/,
                exclude: new RegExp(`node_modules/(?!(${transpileDependencies.join('|')})/).*`),
                use: {
                    loader: 'babel-loader?cacheDirectory',
                },
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            },
        ],
    },
}
