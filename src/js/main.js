import '@/style/_main.scss'
import Vue from 'vue'
import VueCompositionAPI, { inject, computed, onMounted } from '@vue/composition-api'

// composition
import loading from '@/js/compositions/loading'
import viewport from '@/js/compositions/viewport'
import functions from '@/js/compositions/functions'

// plugins
import VueLazyload from 'vue-lazyload'
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

// TODO Webpack plugin
const requireAll = requireContext => requireContext.keys().map(requireContext)
const req = require.context('@/assets', true, /^(?!.*(?:icons)).*/)
requireAll(req)

export default Vue.extend({
    delimiters: ['{$', '$}'],
    setup () {
        loading()
        viewport()
        const { loadFont, loadImage } = functions()

        const isLoading = inject('isLoading')
        const addLoadingStack = inject('addLoadingStack')
        const viewportInfo = inject('viewportInfo')

        const globalStyle = computed(() => {
            const style = {
                '--vh': `${window.innerHeight / viewportInfo.value.vpHeight}vh`,
                '--loading-delay': 500,
            }
            return style
        })

        onMounted(() => {
            addLoadingStack([
                loadFont(),
                loadImage(),
            ])
        })

        return {
            isLoading,
            viewportInfo,
            globalStyle,
        }
    },
})
