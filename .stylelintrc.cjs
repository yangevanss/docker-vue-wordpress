module.exports = {
  extends: [
    'stylelint-config-standard-scss',
    'stylelint-config-recommended-vue/scss',
    'stylelint-config-recess-order',
  ],
  rules: {
    'value-no-vendor-prefix': [true, { ignoreValues: ['box'] }],
    'selector-class-pattern': [
      '^([-a-z0-9]*)(-[a-z0-9]+)*$',
      {
        message: 'Selector class names should be written in kebab-case',
      },
    ],
    'color-function-notation': 'legacy',
    'alpha-value-notation': 'number',
  },
}
