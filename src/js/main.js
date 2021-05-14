import '@/style/_main.scss'
import Vue from 'vue'

// plugins
import VueCompositionAPI from '@vue/composition-api'
import directive from '@/js/plugins/directives/index'
import prototype from '@/js/plugins/prototype/index'
import globalComponent from '@/js/plugins/globalComponent'

Vue.use(VueCompositionAPI)
Vue.use(directive)
Vue.use(prototype)
Vue.use(globalComponent)

Vue.config.productionTip = false

export default Vue
