import Vue from 'vue'

const bus = new Vue()

export default function (Vue) {
    Vue.prototype.$bus = bus
}
