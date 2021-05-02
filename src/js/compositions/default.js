import { ref, provide, inject, computed, onMounted, onBeforeUnmount } from '@vue/composition-api'
import WebFont from 'webfontloader'
import ImagesLoaded from 'imagesloaded'
import loading from '@/js/compositions/loading'
import viewport from '@/js/plugins/functions/viewport'

export default () => {
    const { loadingConfig, isLoading } = loading()
    const addLoadingStack = inject('addLoadingStack')
    const vp = ref(viewport)

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

    onMounted(() => {
        addLoadingStack(loadFont())
        addLoadingStack(loadImage())
    })
    onBeforeUnmount(() => {
        vp.value.destroy()
    })

    provide('viewportInfo', viewportInfo)

    return {
        loadingConfig,
        isLoading,
        viewportInfo,
        globalStyle,
    }
}
