import { inject, onMounted } from '@vue/composition-api'
import Vue from '@/js/main.js'
import defaultComposition from '@/js/compositions/default'

// component
import LoadingDefault from '@/js/components/LoadingDefault.vue'
import LoadingAjax from '@/js/components/LoadingAjax.vue'

new Vue({
    el: '#wrapper',
    delimiters: ['{$', '$}'],
    components: {
        LoadingDefault,
        LoadingAjax,
    },
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
