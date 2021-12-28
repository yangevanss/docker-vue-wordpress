module.exports = {
    root: true,
    env: {
        node: true,
    },
    parser: 'vue-eslint-parser',
    parserOptions: {
        parser: '@babel/eslint-parser',
        ecmaVersion: 'latest',
        sourceType: 'module',
    },
    extends: [
        'eslint:recommended',
        'standard',
        'plugin:vue/recommended',
    ],
    rules: {
        'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        indent: ['error', 4, { SwitchCase: 1 }],
        'vue/html-indent': ['error', 4, { baseIndent: 1 }],
        'comma-dangle': ['error', {
            arrays: 'always-multiline',
            objects: 'always-multiline',
            imports: 'never',
            exports: 'never',
            functions: 'never',
        }],
        'no-unused-vars': 'warn',
        'no-new': 'off',
        'vue/multi-word-component-names': 'off',
        'vue/multiline-html-element-content-newline': 'off',
        'vue/singleline-html-element-content-newline': 'off',
    },
}
