const path = require("path");

module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: [
    "eslint:recommended",
    "airbnb-base",
    "plugin:vue/vue3-recommended",
  ],
  overrides: [
  ],
  parserOptions: {
    ecmaVersion: "latest",
    sourceType: "module",
  },
  plugins: [
    "vue",
  ],
  settings: {
    "import/resolver": {
      node: {
        paths: ["."],
      },
      alias: {
        map: [
          ["@", path.resolve(__dirname, "wordpress/wp-content/themes/custom-theme/src")],
        ],
        extensions: [".vue", ".js", ".css", ".scss", ".json"],
      },
    },
  },
  rules: {
    indent: [
      "error",
      2,
    ],
    "linebreak-style": [
      "error",
      "unix",
    ],
    quotes: [
      "error",
      "double",
    ],
    semi: [
      "error",
      "always",
    ],
    "import/no-extraneous-dependencies": ["error", { devDependencies: true, optionalDependencies: true, peerDependencies: true }],
    "no-console": process.env.NODE_ENV === "production" ? "error" : "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
    "vue/html-indent": ["error", 2, { baseIndent: 1 }],
    "vue/multi-word-component-names": "off",
    "vue/script-setup-uses-vars": "error",
    "comma-dangle": [
      "error",
      {
        arrays: "always-multiline",
        objects: "always-multiline",
        imports: "never",
        exports: "never",
        functions: "never",
      },
    ],
    "no-unused-vars": "warn",
    "no-new": "off",
    "import/no-cycle": "off",
    "no-restricted-syntax": "off",
    "max-classes-per-file": "off",
    "no-constructor-return": "off",
    "no-param-reassign": ["error", { props: false }],
    "no-shadow": "off",
  },
};
