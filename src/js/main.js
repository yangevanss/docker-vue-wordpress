import '@/style/_main.scss'
import Vue from 'vue'

// compositions
import global from '@/js/compositions/global'

// plugins
import VueCompositionAPI, {} from '@vue/composition-api'
import directive from '@/js/plugins/directives/index'
import icon from '@/js/plugins/svgIcon'
import bus from '@/js/plugins/bus'
import globalComponent from '@/js/plugins/globalComponent'

Vue.use(VueCompositionAPI)
Vue.use(directive)
Vue.use(icon)
Vue.use(bus)
Vue.use(globalComponent)

Vue.config.productionTip = false

new Vue({
    el: '#wrapper',
    delimiters: ['{$', '$}'],
    setup () {
        const { isLoading, viewportInfo, globalStyle } = global()
        return {
            isLoading,
            viewportInfo,
            globalStyle,
        }
    },
})

if (module.hot) {
    module.hot.accept([
        '@/js/compositions/global.js',
    ])
}
