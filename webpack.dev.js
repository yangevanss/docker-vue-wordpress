const path = require('path')
const { merge } = require('webpack-merge')
const common = require('./webpack.common.js')
const dotenv = require('dotenv').config({ path: './.env' }).parsed
const chokidar = require('chokidar')
const ESLintPlugin = require('eslint-webpack-plugin')
const StylelintPlugin = require('stylelint-webpack-plugin')

module.exports = merge(common, {
    mode: 'development',
    devtool: 'inline-source-map',
    devServer: {
        before (app, server) {
            chokidar
                .watch([
                    path.resolve(__dirname, 'wp-content/themes/project-theme/'),
                    path.resolve(__dirname, 'src/js/pages/*.js'),
                    path.resolve(__dirname, 'src/js/plugins/**/*.js'),
                    path.resolve(__dirname, 'src/js/main.js'),
                ])
                .on('all', function () {
                    server.sockWrite(server.sockets, 'content-changed')
                })
        },
        port: dotenv.WEBPACK_PORT,
        contentBase: path.resolve(__dirname, 'wp-content/themes/project-theme/src'),
        compress: true,
        hot: true,
        open: false,
        // host: '0.0.0.0',
        // disableHostCheck: true,
        // useLocalIp: true,
        // https: true,
        overlay: {
            warnings: false,
            errors: true,
        },
        proxy: {
            '/': {
                target: `http://localhost:${dotenv.WP_PORT}`,
                secure: false,
                changeOrigin: true,
            },
        },
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
            'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization',
        },
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.js',
        },
    },
    plugins: [
        new ESLintPlugin(),
        new StylelintPlugin({
            files: ['**/*.{vue,htm,html,css,sss,less,scss,sass}'],
        }),
    ],
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    'vue-style-loader',
                    'css-loader',
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
