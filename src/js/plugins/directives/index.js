import bg from './bgStyle'
import lock from './scrollLock'
import blur from './blur'

export default function (Vue, options) {
    Vue.use(bg)
    Vue.use(lock)
    Vue.use(blur)
}
