import '@/style/_main.scss'
import Vue from 'vue'
import HelloWorld from '@/js/components/HelloWorld.vue'

// compositions
import defaultComposition from '@/js/compositions/default'

// plugins
import VueCompositionAPI, { inject, onMounted } from '@vue/composition-api'
import directive from '@/js/plugins/directives/index'
import prototype from '@/js/plugins/prototype/index'
import globalComponent from '@/js/plugins/globalComponent'

Vue.use(VueCompositionAPI)
Vue.use(directive)
Vue.use(prototype)
Vue.use(globalComponent)

Vue.config.productionTip = false

new Vue({
    el: '#wrapper',
    delimiters: ['{$', '$}'],
    components: {
        HelloWorld,
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
