import '@/style/_main.scss'
import Vue from 'vue'
import Test from '@/js/components/Test.vue'

Vue.component('Test', Test)

Vue.config.productionTip = false

const app = new Vue({
    el: '#wrapper',
})

export default Vue
