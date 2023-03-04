import path from "path";
import { defineConfig, loadEnv, splitVendorChunkPlugin } from "vite";
import vue from "@vitejs/plugin-vue";
import postcssPresetEnv from "postcss-preset-env";

import { createSvgIconsPlugin } from "vite-plugin-svg-icons";

export default ({ mode }) => {
  process.env = {
    ...process.env,
    ...loadEnv(mode, process.cwd(), ["VITE_", "WP_"]),
  };

  return defineConfig({
    envPrefix: ["VITE_", "WP_"],
    publicDir: false,
    base: "./",
    server: {
      host: "0.0.0.0",
      origin: `http://localhost:${process.env.VITE_PORT}`,
      port: process.env.VITE_PORT,
    },
    build: {
      outDir: "wordpress/wp-content/themes/custom-theme/dist/",
      manifest: true,
      rollupOptions: {
        input: [
          "wordpress/wp-content/themes/custom-theme/src/main.js",
          "wordpress/wp-content/themes/custom-theme/src/views/index/index.js",
        ],
      },
    },
    resolve: {
      alias: [
        { find: "vue", replacement: "vue/dist/vue.esm-bundler.js" },
        { find: "@", replacement: path.resolve(__dirname, "wordpress/wp-content/themes/custom-theme/src") },
      ],
    },
    plugins: [
      vue(),
      splitVendorChunkPlugin(),
      createSvgIconsPlugin({
        iconDirs: [path.resolve(__dirname, "wordpress/wp-content/themes/custom-theme/src/assets/icons")],
        symbolId: "[name]",
      }),
      {
        name: "wordpress-hmr",
        enforce: "post",
        handleHotUpdate({ file, server }) {
          if (file.endsWith(".php") || file.endsWith(".twig")) {
            server.ws.send({
              type: "full-reload",
              path: "*",
            });
          }
        },
      },
    ],
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: `
              @use "sass:color";
              @use "sass:list";
              @use "sass:map";
              @use "sass:math";
              @use "sass:meta";
              @use "sass:selector";
              @use "sass:string";
              @import 'wordpress/wp-content/themes/custom-theme/src/styles/_variables.scss';
              @import 'wordpress/wp-content/themes/custom-theme/src/styles/mixins/_mixins.scss';
          `,
        },
      },
      postcss: {
        plugins: [postcssPresetEnv({
          browsers: "last 2 versions",
          autoprefixer: { grid: true },
        })],
      },
    },
  });
};
