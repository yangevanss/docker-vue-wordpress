import { ref, readonly, provide, computed } from '@vue/composition-api'

const LOADING = Object.freeze({
    MIN_LOAD_TIME: 1000,
    LOADING_TYPE_DEFAULT: 'default',
    LOADING_TYPE_AJAX: 'ajax',
})

export default () => {
    const loadingConfig = ref({
        minTime: LOADING.MIN_LOAD_TIME,
        type: LOADING.LOADING_TYPE_DEFAULT,
    })
    const loadingStack = ref([])

    const isLoading = computed(() => !!loadingStack.value.length)

    const changeLoadingType = (payload) => {
        const type = LOADING[payload]
        if (type && typeof type === 'string') {
            loadingConfig.value.type = type
        }
    }
    const addLoadingStack = (payload) => {
        if (payload instanceof Promise) {
            loadingStack.value.push(payload)
        }
    }
    const delLoadingStack = () => {
        loadingStack.value.shift()
    }
    const waitLoading = () => {
        const startTime = Date.now()
        return Promise.all(loadingStack.value).then(results => {
            const endTime = Date.now()
            setTimeout(() => {
                results.forEach(result => delLoadingStack())
            }, loadingConfig.value.minTime - (endTime - startTime))
        })
    }

    provide('changeLoadingType', changeLoadingType)
    provide('addLoadingStack', addLoadingStack)
    provide('waitLoading', waitLoading)

    return {
        loadingConfig: readonly(loadingConfig),
        isLoading,
    }
}
