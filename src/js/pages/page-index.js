import '@/style/pages/page-index.scss'
import { inject, onMounted } from '@vue/composition-api'
import Vue from '@/js/main.js'

// component
import HelloWorld from '@/js/components/HelloWorld.vue'

new Vue({
    components: {
        HelloWorld,
    },
    setup () {
        const waitLoading = inject('waitLoading')

        onMounted(() => {
            waitLoading()
        })
    },
}).$mount('#wrapper')

if (module.hot) {
    module.hot.accept()
}
