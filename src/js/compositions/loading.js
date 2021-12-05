import { provide, ref, computed } from '@vue/composition-api'

export default () => {
    const loadingConfig = ref({
        isShow: true,
        waiting: false,
    })
    const loadingStack = ref([])

    const isLoading = computed(() => !!loadingStack.value.length)

    const addLoadingStack = (payload) => {
        if (payload instanceof Array) {
            const promise = Promise.allSettled(payload.filter(p => p instanceof Promise)).then((results) => {
                results.forEach(({ status, reason }) => {
                    if (status === 'rejected') {
                        console.warn(`Loading Rejected: ${reason}`)
                    }
                })
                return results
            })
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
        if (!loadingConfig.value.waiting) {
            loadingConfig.value.waiting = true
            return Promise.allSettled(loadingStack.value).then((results) => {
                results.forEach(({ status, reason }) => {
                    delLoadingStack()
                    if (status === 'rejected') {
                        console.warn(`Loading Rejected: ${reason}`)
                    }
                })
                loadingConfig.value.waiting = false
                if (isLoading.value) {
                    waitLoading()
                }
                return results
            })
        }
    }

    provide('isLoading', isLoading)
    provide('addLoadingStack', addLoadingStack)
    provide('waitLoading', waitLoading)
}
