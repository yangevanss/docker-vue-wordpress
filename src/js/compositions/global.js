import { ref, provide, computed, onMounted, onBeforeUnmount } from '@vue/composition-api'
import WebFont from 'webfontloader'
import ImagesLoaded from 'imagesloaded'
import viewport from '@/js/plugins/functions/viewport'

export default () => {
    const vp = ref(viewport)
    const isLoading = ref(true)

    const viewportInfo = computed(() => vp.value.info)
    const globalStyle = computed(() => {
        const style = {
            '--vh': `${window.innerHeight / viewportInfo.value.vpHeight}vh`,
        }
        return style
    })

    const loadFont = () => {
        return new Promise(resolve => {
            WebFont.load({
                google: {
                    families: ['Noto Sans TC:300,400,700'],
                },
                active () {
                    resolve()
                },
            })
        })
    }

    const loadImage = () => {
        return new Promise(resolve => {
            new ImagesLoaded('#wrapper', { background: '[data-background]' }, (instance) => {
                resolve()
            })
        })
    }

    onMounted(async () => {
        if (process.env.NODE_ENV === 'development') {
            document.body.classList.remove('-loading')
        }

        await Promise.all([
            loadFont(),
            loadImage(),
        ])
        isLoading.value = false
    })
    onBeforeUnmount(() => {
        vp.value.destroy()
    })

    provide('viewportInfo', viewportInfo)

    return {
        isLoading,
        viewportInfo,
        globalStyle,
    }
}
