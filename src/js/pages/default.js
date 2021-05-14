import { inject, onMounted } from '@vue/composition-api'
import Vue from '@/js/main.js'
import defaultComposition from '@/js/compositions/default'

new Vue({
    el: '#wrapper',
    delimiters: ['{$', '$}'],
    setup () {
        const { loadingConfig, isLoading, viewportInfo, globalStyle } = defaultComposition()
        const waitLoading = inject('waitLoading')

        onMounted(() => {
            waitLoading()
        })

        return {
            loadingConfig,
            isLoading,
            viewportInfo,
            globalStyle,
        }
    },
})

if (module.hot) {
    module.hot.accept([
        '@/js/compositions/default.js',
    ])
}
