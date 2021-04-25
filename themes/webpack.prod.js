const path = require('path')
const { merge } = require('webpack-merge')
const common = require('./webpack.common.js')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')

module.exports = merge(common, {
    mode: 'production',
    optimization: {
        minimizer: [
            new TerserPlugin({
                parallel: true,
            }),
        ],
    },
    plugins: [
        new CleanWebpackPlugin(),
        new MiniCssExtractPlugin({
            filename: 'css/[name].css',
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
