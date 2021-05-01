import { debounce } from 'lodash'
import { detect } from 'detect-browser'
import mobileInnerHeight from './mobileInnerHeight'

const innerHeight = mobileInnerHeight()
const getterKeys = ['vpWidth', 'vpHeight', 'device', 'mediaType', 'isDesktop', 'isTablet', 'isMobile', 'isPc', 'isIE']

class Viewport {
    constructor () {
        this.information = {
            width: window.innerWidth,
            height: innerHeight(),
            device: detect(),
            media: {
                mobile: '(max-width: 767px)',
                tablet: '(max-width: 1199px) and (min-width: 768px)',
                desktop: '(min-width:1200px)',
            },
        }

        window.addEventListener('resize', this.refresh)
    }

    refresh = debounce(() => {
        this.vpWidth = window.innerWidth
        this.vpHeight = innerHeight(true)
        this.device = detect()

        this.onResize?.()
    }, 200)

    destroy () {
        window.removeEventListener('resize', this.refresh)
    }

    get info () {
        return getterKeys.reduce((acc, curr) => {
            acc[curr] = this[curr]
            return acc
        }, {})
    }

    set vpWidth (value) {
        this.information.width = value
    }

    get vpWidth () {
        return this.information.width
    }

    set vpHeight (value) {
        this.information.height = value
    }

    get vpHeight () {
        return this.information.height
    }

    set device (value) {
        this.information.device = value
    }

    get device () {
        return this.information.device
    }

    get mediaType () {
        const map = this.information.media
        for (const key in map) {
            if (window.matchMedia(map[key]).matches) {
                return key
            }
        }
    }

    get isDesktop () {
        return this.mediaType === 'desktop'
    }

    get isTablet () {
        return this.mediaType === 'tablet'
    }

    get isMobile () {
        return this.mediaType === 'mobile'
    }

    get isPc () {
        const { os } = this.device
        return os !== 'iOS' && os !== 'Android OS'
    }

    get isIE () {
        const { name } = this.device
        return name === 'ie'
    }
}

const viewport = new Viewport()

export default viewport
