<template>
    <div class="hello-world" />
</template>

<script>
import { inject } from '@vue/composition-api'

export default {
    name: 'HelloWorld',
    setup () {
        const viewportInfo = inject('viewportInfo')
        const addLoadingStack = inject('addLoadingStack')

        addLoadingStack(new Promise(resolve => {
            setTimeout(() => {
                resolve()
            }, Math.random() * 1000)
        }))

        return {
            viewportInfo,
        }
    },
}
</script>

<style lang="scss">
.hello-world {
    background: url('https://source.unsplash.com/random/400x400') no-repeat center / cover;

    &::before {
        content: '';
        display: block;
        padding-bottom: 56.25%;
    }
}
</style>
