import '@/style/_main.scss'
import Vue from 'vue'

// plugins
import directive from '@/js/plugins/directives/index'
import icon from '@/js/plugins/svgIcon.js'
import bus from '@/js/plugins/bus'
import globalComponent from '@/js/plugins/globalComponent'

Vue.use(directive)
Vue.use(icon)
Vue.use(bus)
Vue.use(globalComponent)

Vue.config.productionTip = false

new Vue({
    el: '#wrapper',
})

if (module.hot) {
    module.hot.accept('@/js/plugins/globalComponent')
}
