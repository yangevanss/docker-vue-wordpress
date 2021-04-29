export default function (Vue, options) {
    Vue.directive('bg', function (el, binding) {
        el.setAttribute('data-background', '')
        el.style.background = `url('${binding.value}') no-repeat center / cover`
    })
}
