import axios from './axios'
import bus from './bus'

export default function (Vue, options) {
    Vue.prototype.$axios = axios
    Vue.prototype.$bus = bus
}
