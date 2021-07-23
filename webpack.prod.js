const path = require('path')
const { merge } = require('webpack-merge')
const common = require('./webpack.common.js')
const DotenvWebpack = require('dotenv-webpack')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const FaviconsWebpackPlugin = require('favicons-webpack-plugin')

module.exports = merge(common, {
    mode: 'production',
    output: {
        publicPath: '../',
    },
    optimization: {
        minimizer: [
            new TerserPlugin({
                parallel: true,
            }),
        ],
    },
    plugins: [
        new DotenvWebpack({
            path: './.env.production',
            defaults: '.env',
        }),
        new CleanWebpackPlugin(),
        new MiniCssExtractPlugin({
            filename: 'css/[name].css',
        }),
        new FaviconsWebpackPlugin({
            logo: path.resolve(__dirname, 'static/favicon.svg'),
            prefix: 'favicon/',
            cache: true,
            inject: false,
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.min.js',
        },
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'postcss-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            implementation: require('sass'),
                        },
                    },
                    {
                        loader: 'sass-resources-loader',
                        options: {
                            resources: [path.resolve(__dirname, 'src/style/mixins/_mixin.scss')],
                        },
                    },
                ],
            },
        ],
    },
})
