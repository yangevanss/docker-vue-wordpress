import '@/style/_main.scss'
import Vue from 'vue'

// plugins
import VueLazyload from 'vue-lazyload'
import VueCompositionAPI from '@vue/composition-api'
import directive from '@/js/plugins/directives/index'
import prototype from '@/js/plugins/prototype/index'
import globalComponent from '@/js/plugins/globalComponent'

Vue.use(VueLazyload, {
    observer: true,
    attempt: 1,
    silent: process.env.NODE_ENV === 'production',
})
Vue.use(VueCompositionAPI)
Vue.use(directive)
Vue.use(prototype)
Vue.use(globalComponent)

Vue.config.productionTip = false

const requireAll = requireContext => requireContext.keys().map(requireContext)
const req = require.context('@/assets', true, /^(?!.*(?:icons)).*/)
requireAll(req)

export default Vue
