export default function (Vue, options) {
    Vue.directive('bg', function (el, binding) {
        const { contain, lazy, transparent } = binding.modifiers
        const size = contain ? 'contain' : 'cover'
        const value = binding.value
        const color = transparent ? '' : '#f8f8f8'
        if (value) {
            if (!lazy) {
                el.setAttribute('data-background', '')
                el.style.background = `${color} url('${value}') no-repeat center / ${size}`
                return
            }
        }
        el.style.backgroundPosition = 'center'
        el.style.backgroundSize = size
        el.style.background = color
    })
}
