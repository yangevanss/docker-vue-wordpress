export default function (Vue, options) {
    Vue.directive('bg', function (el, binding) {
        const { contain, lazy } = binding.modifiers
        const size = contain ? 'contain' : 'cover'

        const value = binding.value
        if (!lazy) {
            el.setAttribute('data-background', '')
            el.style.background = `url('${value}') no-repeat center / ${size}`
            return
        }
        el.style.backgroundPosition = 'center'
        el.style.backgroundSize = size
    })
}
