import { inject, onMounted } from '@vue/composition-api'
import Vue from '@/js/main.js'

new Vue({
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
