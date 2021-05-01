export default function (Vue, options) {
    Vue.directive('bg', function (el, binding) {
        el.setAttribute('data-background', '')
        const value = binding.value
        if (typeof value === 'string') {
            el.style.background = `url('${value}') no-repeat center / cover`
            return
        }
        const { url, size } = value
        el.style.background = `url('${url}') no-repeat center / ${size}`
    })
}
