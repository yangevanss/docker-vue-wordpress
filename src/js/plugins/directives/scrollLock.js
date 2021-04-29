import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default function (Vue, options) {
    Vue.directive('lock', {
        inserted (el, { value, ...binding }) {
            if (value) {
                disableBodyScroll(el, {
                    reserveScrollBarGap: true,
                })
            }
        },
        componentUpdated (el, { value, ...binding }) {
            if (value) {
                disableBodyScroll(el, {
                    reserveScrollBarGap: true,
                })
                return
            }
            enableBodyScroll(el)
        },
        unbind (el) {
            enableBodyScroll(el)
        },
    })
}
