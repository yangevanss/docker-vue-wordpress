import { provide, ref, computed, onBeforeUnmount } from '@vue/composition-api'
import viewport from '@/js/plugins/functions/viewport'

export default () => {
    const vp = ref(viewport)

    const viewportInfo = computed(() => vp.value.info)

    onBeforeUnmount(() => {
        vp.value.destroy()
    })

    provide('viewportInfo', viewportInfo)
}
