<template>
    <div class="test">
        test
    </div>
</template>

<script>
import { inject } from '@vue/composition-api'

export default {
    name: 'Test',
    setup () {
        const viewportInfo = inject('viewportInfo')
        const addLoadingStack = inject('addLoadingStack')
        addLoadingStack(new Promise(resolve => {
            setTimeout(() => {
                resolve()
            }, 2000)
        }))
        return {
            viewportInfo,
        }
    },
}
</script>

<style lang="scss">
.test {
    @include size(500px);

    background-color: red;
}
</style>
