const path = require('path')
const { merge } = require('webpack-merge')
const common = require('./webpack.common.js')
const DotenvWebpack = require('dotenv-webpack')
const dotenv = require('dotenv').config({ path: './.env' }).parsed
const chokidar = require('chokidar')
const ESLintPlugin = require('eslint-webpack-plugin')
const StylelintPlugin = require('stylelint-webpack-plugin')

module.exports = merge(common, {
    mode: 'development',
    devtool: 'inline-source-map',
    devServer: {
        onBeforeSetupMiddleware (devServer) {
            chokidar
                .watch([
                    path.resolve(__dirname, 'wordpress/wp-content/themes/blockstudio-theme/'),
                ])
                .on('all', function () {
                    devServer.sendMessage(devServer.webSocketServer.clients, 'content-changed')
                })
        },
        port: dotenv.WEBPACK_PORT,
        compress: true,
        hot: 'only',
        // open: true,
        allowedHosts: 'all',
        // host: 'local-ip',
        static: {
            directory: path.resolve(__dirname, 'wordpress/wp-content/themes/blockstudio-theme/src'),
        },
        client: {
            overlay: {
                errors: true,
                warnings: false,
            },
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
        new DotenvWebpack({
            path: './.env.development',
            defaults: '.env',
        }),
        new ESLintPlugin(),
        new StylelintPlugin({
            files: ['**/*.{vue,htm,html,css,sss,less,scss,sass}'],
        }),
    ],
    module: {
        rules: [
            {
                test: /\.(s[ac]ss|css)$/i,
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
