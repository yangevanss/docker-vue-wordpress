import { ref, readonly, computed } from '@vue/composition-api'

const LOADING = Object.freeze({
    MIN_LOAD_TIME: 500,
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
        if (Array.isArray(payload)) {
            const promise = Promise.all(payload.filter(p => p instanceof Promise))
            loadingStack.value.push(promise)
            return promise
        }
        if (payload instanceof Promise) {
            loadingStack.value.push(payload)
            return payload
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

    return {
        loadingConfig: readonly(loadingConfig),
        isLoading,
        changeLoadingType,
        addLoadingStack,
        waitLoading,
    }
}
