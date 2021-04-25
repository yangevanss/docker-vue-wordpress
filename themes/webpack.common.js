const Webpack = require('webpack')
const path = require('path')
const DotenvWebpack = require('dotenv-webpack')
const CopyPlugin = require('copy-webpack-plugin')
const { VueLoaderPlugin } = require('vue-loader')
const ESLintPlugin = require('eslint-webpack-plugin')
const StylelintPlugin = require('stylelint-webpack-plugin')

module.exports = {
    entry: {
        admin: './src/style/admin/_admin.scss',
        default: './src/js/main.js',
        index: ['./src/js/pages/index.js', './src/style/pages/index.scss'],
    },
    output: {
        filename: 'js/[name].bundle.js',
        path: path.resolve(__dirname, '../wp-content/themes/project-theme/src'),
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
        new DotenvWebpack(),
        new Webpack.ProvidePlugin({}),
        new CopyPlugin({
            patterns: [{ from: path.resolve(__dirname, 'static') }],
        }),
        new VueLoaderPlugin(),
        new ESLintPlugin(),
        new StylelintPlugin({
            files: ['**/*.{vue,htm,html,css,sss,less,scss,sass}'],
        }),
    ],
    module: {
        rules: [
            {
                test: /\.(jpe?g|png|gif|svg)$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'img/[hash][ext][query]',
                },
            },
            {
                test: /\.m?js$/,
                exclude: file => (
                    /node_modules/.test(file) &&
                    !/\.vue\.js/.test(file)
                ),
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
